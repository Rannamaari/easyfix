<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Models\BookingSetting;
use App\Models\JobQuote;
use App\Models\JobRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SmsNotifier
{
    public function __construct(
        protected DhiraaguSmsClient $smsClient,
    ) {}

    public function sendQuoteReady(JobRequest $jobRequest, JobQuote $quote): void
    {
        $this->sendQuoteMessage($jobRequest, $quote, 'quote_ready');
    }

    public function sendUpdatedQuote(JobRequest $jobRequest, JobQuote $quote): void
    {
        $this->sendQuoteMessage($jobRequest, $quote, 'quote_updated');
    }

    protected function sendQuoteMessage(JobRequest $jobRequest, JobQuote $quote, string $type): void
    {
        $phone = $jobRequest->contact_phone;

        if (! $phone) {
            return;
        }

        $destination = $this->smsClient->normalizeDestination($phone);

        if (! $destination) {
            return;
        }

        $quoteVersion = md5(implode('|', [
            $quote->id,
            (string) ($quote->updated_at?->timestamp ?? $quote->created_at?->timestamp ?? now()->timestamp),
            (string) ($quote->total ?? $quote->amount),
            (string) $quote->status,
        ]));
        $fingerprint = 'sms:' . $type . ':' . $jobRequest->id . ':' . $quoteVersion;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $settings = BookingSetting::current();
        $amount = number_format((float) ($quote->total ?? $quote->amount), 2);
        $url = $this->dashboardUrl($jobRequest);
        $message = $this->renderTemplate($settings->smsTemplate($type), [
            ':amount' => $amount,
            ':includes_tax' => $quote->tax_enabled ? ' incl. GST' : '',
            ':bank_name' => $settings->micronet_bank_name ?: '[Bank Name]',
            ':account_name' => $settings->micronet_account_name ?: 'Micronet MVR',
            ':account_number' => $settings->micronet_account_number ?: '7730000140010',
            ':url' => $url,
            ':hotline' => $settings->support_hotline ?: '9996210',
        ]);

        $this->send([$destination], $message, [
            'user_id' => $jobRequest->customer_id,
            'job_request_id' => $jobRequest->id,
            'job_quote_id' => $quote->id,
            'type' => $type,
        ]);
    }

    public function sendStatusUpdate(JobRequest $jobRequest, JobStatus $status, ?string $note = null): void
    {
        if (in_array($status, [JobStatus::Requested, JobStatus::Quoted, JobStatus::Approved], true)) {
            return;
        }

        $phone = $jobRequest->contact_phone;

        if (! $phone) {
            return;
        }

        $destination = $this->smsClient->normalizeDestination($phone);

        if (! $destination) {
            return;
        }

        $fingerprint = 'sms:status-update:' . $jobRequest->id . ':' . $status->value . ':' . md5((string) $note);

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $settings = BookingSetting::current();
        $url = $this->dashboardUrl($jobRequest);
        $trimmedNote = trim((string) preg_replace('/\s+/', ' ', (string) $note));

        if ($status === JobStatus::VisitChargeRequired) {
            $message = $this->renderTemplate($settings->smsTemplate('visit_charge_required'), [
                ':visit_charge' => number_format((float) ($jobRequest->visit_charge_amount ?? $settings->visit_charge_amount), 2),
                ':bank_name' => $settings->micronet_bank_name ?: '[Bank Name]',
                ':account_name' => $settings->micronet_account_name ?: '[Account Name]',
                ':account_number' => $settings->micronet_account_number ?: '[Account Number]',
                ':url' => $url,
            ]);
        } else {
            $message = $this->renderTemplate($settings->smsTemplate('status_update'), [
                ':status' => $status->label(),
                ':note' => $trimmedNote !== '' ? ' ' . rtrim($trimmedNote, '.') . '.' : '',
                ':url' => $url,
                ':hotline' => $settings->support_hotline ?: '9996210',
            ]);
        }

        $this->send([$destination], $message, [
            'user_id' => $jobRequest->customer_id,
            'job_request_id' => $jobRequest->id,
            'type' => $status === JobStatus::VisitChargeRequired ? 'visit_charge_required' : 'status_update',
            'status' => $status->value,
        ]);
    }

    public function sendRequestReceived(JobRequest $jobRequest): void
    {
        $phone = $jobRequest->contact_phone;

        if (! $phone) {
            return;
        }

        $destination = $this->smsClient->normalizeDestination($phone);

        if (! $destination) {
            return;
        }

        $fingerprint = 'sms:request-received:' . $jobRequest->id;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $settings = BookingSetting::current();
        $url = $this->dashboardUrl($jobRequest);
        $message = $this->renderTemplate($settings->smsTemplate('request_received'), [
            ':url' => $url,
            ':hotline' => $settings->support_hotline ?: '9996210',
        ]);

        $this->send([$destination], $message, [
            'user_id' => $jobRequest->customer_id,
            'job_request_id' => $jobRequest->id,
            'type' => 'request_received',
        ]);
    }

    public function sendQuoteApprovedPaymentDetails(JobRequest $jobRequest, JobQuote $quote): void
    {
        $phone = $jobRequest->contact_phone;

        if (! $phone) {
            return;
        }

        $destination = $this->smsClient->normalizeDestination($phone);

        if (! $destination) {
            return;
        }

        $fingerprint = 'sms:quote-approved-payment:' . $jobRequest->id . ':' . $quote->id;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $settings = BookingSetting::current();
        $amount = number_format((float) ($quote->total ?? $quote->amount), 2);
        $url = $this->dashboardUrl($jobRequest);
        $message = $this->renderTemplate($settings->smsTemplate('quote_approved_payment'), [
            ':amount' => $amount,
            ':bank_name' => $settings->micronet_bank_name ?: '[Bank Name]',
            ':account_name' => $settings->micronet_account_name ?: 'Micronet MVR',
            ':account_number' => $settings->micronet_account_number ?: '7730000140010',
            ':url' => $url,
            ':hotline' => $settings->support_hotline ?: '9996210',
        ]);

        $this->send([$destination], $message, [
            'user_id' => $jobRequest->customer_id,
            'job_request_id' => $jobRequest->id,
            'job_quote_id' => $quote->id,
            'type' => 'quote_approved_payment_details',
        ]);
    }

    protected function dashboardUrl(JobRequest $jobRequest): string
    {
        if ($jobRequest->customer_id) {
            return route('dashboard', absolute: true);
        }

        return $jobRequest->tracking_url ?? url('/');
    }

    protected function renderTemplate(string $template, array $replacements): string
    {
        $message = strtr($template, $replacements);

        return trim(preg_replace('/\s+/', ' ', $message) ?? $message);
    }

    /**
     * @param array<int, string> $destinations
     * @param array<string, mixed> $context
     */
    protected function send(array $destinations, string $message, array $context = []): void
    {
        try {
            $this->smsClient->send($destinations, $message, null, $context);
        } catch (\Throwable $exception) {
            Log::warning('SMS notification failed: ' . $exception->getMessage(), $context);
        }
    }
}
