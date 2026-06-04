<?php

namespace App\Services;

use App\Enums\JobStatus;
use App\Models\JobQuote;
use App\Models\JobRequest;
use App\Models\Payment;
use App\Models\User;

class MicronetSyncService
{
    public function __construct(
        protected MicronetApiClient $client,
    ) {}

    public function enabled(): bool
    {
        return $this->client->enabled();
    }

    public function syncCustomer(User $user): void
    {
        if (! $this->enabled() || ! $user->isCustomer()) {
            return;
        }

        $address = $user->addresses()->orderByDesc('is_default')->value('address')
            ?: trim(implode(', ', array_filter([$user->address_line1, $user->address_line2])));

        $response = $this->client->createCustomer([
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'address' => $address,
            'notes' => 'EasyFix customer',
            'category' => 'easyfix',
            'easyfix_user_id' => 'ef_user_' . $user->id,
        ]);

        $user->forceFill([
            'micronet_customer_id' => data_get($response, 'data.id'),
            'micronet_last_synced_at' => now(),
            'micronet_sync_error' => null,
        ])->save();
    }

    public function syncJob(JobRequest $job): void
    {
        if (! $this->enabled()) {
            return;
        }

        if ($job->customer && ! $job->customer->micronet_customer_id) {
            $this->syncCustomer($job->customer);
            $job->refresh();
        }

        if ($job->micronet_job_id) {
            return;
        }

        $job->loadMissing(['customer', 'category', 'service']);

        $priority = $job->urgent_requested ? 'urgent' : 'normal';
        $title = $job->service?->name ?: $job->category?->name ?: 'EasyFix Service Request';
        $scheduledAt = $job->preferred_time?->format('Y-m-d H:i:s');
        $dueDate = optional($job->preferred_time ?: $job->created_at)->copy()->addDays(7)->format('Y-m-d');

        $response = $this->client->createJob([
            'job_type' => 'easyfix',
            'customer_id' => $job->customer?->micronet_customer_id,
            'customer_name' => $job->contact_name,
            'customer_phone' => $job->contact_phone,
            'easyfix_user_id' => $job->customer_id ? 'ef_user_' . $job->customer_id : null,
            'easyfix_job_id' => 'ef_job_' . $job->id,
            'title' => $title,
            'problem_description' => $job->description,
            'customer_notes' => $job->admin_notes,
            'search_note' => null,
            'location' => $job->address,
            'priority' => $priority,
            'scheduled_at' => $scheduledAt,
            'due_date' => $dueDate,
        ]);

        $job->forceFill([
            'micronet_job_id' => data_get($response, 'job_id'),
            'micronet_last_synced_at' => now(),
            'micronet_sync_error' => null,
        ])->save();
    }

    public function syncApprovedQuote(JobQuote $quote): void
    {
        if (! $this->enabled() || ! $quote->isApproved()) {
            return;
        }

        $quote->loadMissing(['jobRequest.customer', 'items']);
        $job = $quote->jobRequest;

        if (! $job) {
            return;
        }

        if (! $job->micronet_job_id) {
            $this->syncJob($job);
            $job->refresh();
        }

        if (! $job->micronet_job_id) {
            throw new \RuntimeException('Micronet job ID missing after job sync.');
        }

        $this->syncQuoteItems($quote);

        if ($quote->micronet_invoice_synced_at) {
            return;
        }

        $response = $this->client->convertInvoice((int) $job->micronet_job_id, [
            'due_date' => optional($quote->invoiced_at ?: now())->copy()->addDays(7)->format('Y-m-d'),
            'approval_method' => 'signed_copy',
            'customer_notes' => 'Approved by customer from EasyFix dashboard',
            'search_note' => null,
            'easyfix_quote_id' => 'ef_quote_' . $quote->id,
            'easyfix_invoice_id' => 'ef_invoice_' . ($quote->invoice_number ?: $quote->id),
        ]);

        $quote->forceFill([
            'micronet_invoice_synced_at' => now(),
            'micronet_invoice_number' => data_get($response, 'invoice_number'),
            'micronet_sync_error' => null,
        ])->save();
    }

    public function syncQuoteDraft(JobQuote $quote): void
    {
        if (! $this->enabled() || ! in_array($quote->status, ['sent', 'approved'], true)) {
            return;
        }

        $this->syncQuoteItems($quote);
    }

    public function syncQuoteItems(JobQuote $quote): void
    {
        if (! $this->enabled()) {
            return;
        }

        $quote->loadMissing(['jobRequest.customer', 'items']);
        $job = $quote->jobRequest;

        if (! $job) {
            return;
        }

        if (! $job->micronet_job_id) {
            $this->syncJob($job);
            $job->refresh();
        }

        if (! $job->micronet_job_id || $quote->micronet_items_synced_at) {
            return;
        }

        foreach ($quote->items as $item) {
            $this->client->addJobItem((int) $job->micronet_job_id, [
                'identifier' => 'EASYFIX-' . $item->id,
                'quantity' => 1,
                'unit_price' => (float) $item->amount,
            ]);
        }

        $quote->forceFill([
            'micronet_items_synced_at' => now(),
            'micronet_sync_error' => null,
        ])->save();
    }

    public function syncJobStatus(JobRequest $job): void
    {
        if (! $this->enabled() || ! $job->micronet_job_id) {
            return;
        }

        $remoteStatus = $this->mapStatus($job->status);

        if (! $remoteStatus) {
            return;
        }

        $this->client->updateJobStatus((int) $job->micronet_job_id, [
            'status' => $remoteStatus,
            'notes' => 'Updated from EasyFix',
        ]);

        $job->forceFill([
            'micronet_status_synced_at' => now(),
            'micronet_sync_error' => null,
        ])->save();
    }

    public function syncPayment(Payment $payment): void
    {
        if (! $this->enabled() || $payment->micronet_payment_id || ! $payment->isConfirmed()) {
            return;
        }

        $payment->loadMissing('jobRequest');
        $job = $payment->jobRequest;

        if (! $job?->micronet_job_id) {
            return;
        }

        $response = $this->client->recordPayment((int) $job->micronet_job_id, [
            'amount' => (float) $payment->amount,
            'method' => $payment->isBankTransfer() ? 'transfer' : 'cash',
            'reference' => $payment->notes ?: 'EasyFix payment #' . $payment->id,
        ]);

        $payment->forceFill([
            'micronet_payment_id' => data_get($response, 'payment_id'),
            'micronet_payment_synced_at' => now(),
            'micronet_sync_error' => null,
        ])->save();
    }

    protected function mapStatus(JobStatus $status): ?string
    {
        return match ($status) {
            JobStatus::Requested, JobStatus::UnderReview => 'new',
            JobStatus::Approved, JobStatus::Assigned, JobStatus::InspectionScheduled, JobStatus::VisitChargePaid => 'scheduled',
            JobStatus::DiagnosisInProgress, JobStatus::EnRoute, JobStatus::InProgress => 'in_progress',
            JobStatus::Completed => 'completed',
            JobStatus::Cancelled => 'cancelled',
            default => null,
        };
    }
}
