<?php

namespace App\Services;

use App\Enums\JobStatus;
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
        $phone = $jobRequest->contact_phone;

        if (! $phone) {
            return;
        }

        $destination = $this->smsClient->normalizeDestination($phone);

        if (! $destination) {
            return;
        }

        $fingerprint = 'sms:quote-ready:' . $jobRequest->id . ':' . $quote->id;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $amount = number_format((float) ($quote->total ?? $quote->amount), 2);
        $includesTax = $quote->tax_enabled ? ' incl. GST' : '';
        $url = $this->jobUrl($jobRequest);

        $message = "EasyFix: Quote ready for Job #{$jobRequest->id}. Total MVR {$amount}{$includesTax}. Check dashboard: {$url}";

        $this->send([$destination], $message, [
            'job_request_id' => $jobRequest->id,
            'job_quote_id' => $quote->id,
            'type' => 'quote_ready',
        ]);
    }

    public function sendStatusUpdate(JobRequest $jobRequest, JobStatus $status, ?string $note = null): void
    {
        if ($status === JobStatus::Requested || $status === JobStatus::Quoted) {
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

        $url = $this->jobUrl($jobRequest);
        $message = "EasyFix: Job #{$jobRequest->id} status is now {$status->label()}.";

        if ($note) {
            $trimmedNote = trim((string) preg_replace('/\s+/', ' ', $note));

            if ($trimmedNote !== '') {
                $message .= " {$trimmedNote}.";
            }
        }

        $message .= " View update: {$url}";

        $this->send([$destination], $message, [
            'job_request_id' => $jobRequest->id,
            'type' => 'status_update',
            'status' => $status->value,
        ]);
    }

    protected function jobUrl(JobRequest $jobRequest): string
    {
        if ($jobRequest->customer_id) {
            return route('jobs.show', $jobRequest, true);
        }

        return $jobRequest->tracking_url ?? url('/');
    }

    /**
     * @param array<int, string> $destinations
     * @param array<string, mixed> $context
     */
    protected function send(array $destinations, string $message, array $context = []): void
    {
        try {
            $this->smsClient->send($destinations, $message);
        } catch (\Throwable $exception) {
            Log::warning('SMS notification failed: ' . $exception->getMessage(), $context);
        }
    }
}
