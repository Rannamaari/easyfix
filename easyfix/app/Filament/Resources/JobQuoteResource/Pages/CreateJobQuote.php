<?php

namespace App\Filament\Resources\JobQuoteResource\Pages;

use App\Enums\JobStatus;
use App\Filament\Resources\JobQuoteResource;
use App\Models\BookingSetting;
use App\Models\JobRequest;
use App\Services\SmsNotifier;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateJobQuote extends CreateRecord
{
    protected static string $resource = JobQuoteResource::class;

    protected bool $notifyCustomerAfterSave = true;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['notify_customer_after_save'] = true;

        return $data;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->notifyCustomerAfterSave = (bool) ($data['notify_customer_after_save'] ?? true);
        $data = $this->applyOptionalCharges($data);
        $items = $data['items'] ?? [];
        $taxEnabled = (bool) ($data['tax_enabled'] ?? false);

        $subtotal = collect($items)->sum(fn ($item) => (float) ($item['amount'] ?? 0));
        $taxAmount = $taxEnabled ? round($subtotal * 0.08, 2) : 0.0;
        $total = $subtotal + $taxAmount;

        $data['amount'] = $subtotal;
        $data['subtotal'] = $subtotal;
        $data['tax_amount'] = $taxAmount;
        $data['total'] = $total;
        $data['tax_rate'] = 8.0;
        unset($data['notify_customer_after_save'], $data['include_urgent_surcharge'], $data['include_visit_charge']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $quote = $this->record;
        $items = $quote->items()->get(['amount'])->map(fn ($item) => ['amount' => $item->amount])->toArray();
        $taxEnabled = (bool) ($quote->tax_enabled ?? false);

        $totals = $quote->recalculateTotals($items, $taxEnabled, 8.0);
        $updates = array_merge($totals, [
            'amount' => $totals['subtotal'],
            'tax_rate' => 8.0,
        ]);

        if ($quote->status === 'approved') {
            $updates['invoice_number'] = $quote->invoice_number ?: 'INV-' . str_pad((string) $quote->id, 6, '0', STR_PAD_LEFT);
            $updates['invoiced_at'] = $quote->invoiced_at ?? now();
        }

        $quote->update($updates);

        $job = $quote->jobRequest;

        if ($job && $quote->status === 'sent') {
            $note = 'Quote sent: MVR ' . number_format((float) ($quote->total ?? $quote->amount), 2);

            if ($job->status !== JobStatus::Quoted && $job->status !== JobStatus::Completed) {
                $job->updateStatus(JobStatus::Quoted, $note, auth()->id());
            }

            if ($this->notifyCustomerAfterSave) {
                app(SmsNotifier::class)->sendQuoteReady($job->fresh(['customer', 'service', 'category']), $quote->fresh());
                Notification::make()->title('Quote saved and customer notified')->success()->send();
                return;
            }
        }
    }

    protected function applyOptionalCharges(array $data): array
    {
        $job = isset($data['job_request_id']) ? JobRequest::find($data['job_request_id']) : null;
        $items = collect($data['items'] ?? [])
            ->reject(fn ($item) => in_array($item['description'] ?? '', [
                'Urgent Support Surcharge',
                'Site Visit / Diagnosis Charge',
            ], true))
            ->values()
            ->all();

        if ($job && ! empty($data['include_urgent_surcharge']) && $job->urgent_requested) {
            $items[] = [
                'description' => 'Urgent Support Surcharge',
                'amount' => (float) ($job->urgent_surcharge_amount ?: BookingSetting::current()->urgent_surcharge_amount),
            ];
        }

        if ($job && ! empty($data['include_visit_charge']) && $job->visit_charge_amount) {
            $items[] = [
                'description' => 'Site Visit / Diagnosis Charge',
                'amount' => (float) $job->visit_charge_amount,
            ];
        }

        $data['items'] = $items;

        return $data;
    }
}
