<?php

namespace App\Filament\Resources\JobQuoteResource\Pages;

use App\Enums\JobStatus;
use App\Filament\Resources\JobQuoteResource;
use App\Models\BookingSetting;
use App\Models\JobQuote;
use App\Models\JobRequest;
use App\Services\SmsNotifier;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditJobQuote extends EditRecord
{
    protected static string $resource = JobQuoteResource::class;

    protected array $originalQuoteSignature = [];
    protected bool $quoteChanged = false;
    protected bool $notifyCustomerAfterSave = true;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var JobQuote $quote */
        $quote = $this->record->loadMissing('items', 'jobRequest');
        $data['notify_customer_after_save'] = true;
        $data['include_urgent_surcharge'] = $quote->items->contains(fn ($item) => $item->description === 'Urgent Support Surcharge');
        $data['include_visit_charge'] = $quote->items->contains(fn ($item) => $item->description === 'Site Visit / Diagnosis Charge');

        $this->originalQuoteSignature = $this->signatureFromData([
            'items' => $quote->items->map(fn ($item) => [
                'description' => $item->description,
                'amount' => (float) $item->amount,
            ])->all(),
            'tax_enabled' => (bool) $quote->tax_enabled,
            'notes' => (string) $quote->notes,
        ]);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
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

        $newSignature = $this->signatureFromData([
            'items' => $items,
            'tax_enabled' => $taxEnabled,
            'notes' => (string) ($data['notes'] ?? ''),
        ]);

        $quoteChanged = $newSignature !== $this->originalQuoteSignature;
        $this->quoteChanged = $quoteChanged;

        if ($quoteChanged && $this->record->isApproved()) {
            $data['status'] = 'sent';
            $data['approved_at'] = null;
            $data['invoice_number'] = null;
            $data['invoiced_at'] = null;
        }

        unset($data['notify_customer_after_save'], $data['include_urgent_surcharge'], $data['include_visit_charge']);

        return $data;
    }

    protected function afterSave(): void
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
        $shouldResetApproval = $this->quoteChanged && $quote->status === 'sent';

        if ($job && $this->quoteChanged && $shouldResetApproval) {
            $note = 'Quote updated: MVR ' . number_format((float) ($quote->total ?? $quote->amount), 2) . '. Customer approval required again.';

            $job->updateStatus(JobStatus::Quoted, $note, auth()->id());
        } elseif ($job && $this->quoteChanged) {
            $job->markCustomerUpdate();
            $job->statusUpdates()->create([
                'status' => $job->status->value,
                'note' => 'Quote updated: MVR ' . number_format((float) ($quote->total ?? $quote->amount), 2) . '.',
                'user_id' => auth()->id(),
            ]);
        }

        if ($job && $this->quoteChanged && $this->notifyCustomerAfterSave) {
            app(SmsNotifier::class)->sendUpdatedQuote($job->fresh(['customer', 'service', 'category']), $quote->fresh());
            Notification::make()->title('Updated quote sent for customer approval')->success()->send();
            return;
        }

        if ($job && $this->quoteChanged && $shouldResetApproval) {
            Notification::make()->title('Quote updated and approval reset')->warning()->send();
            return;
        }

        if ($job && $this->quoteChanged) {
            Notification::make()->title('Quote updated')->success()->send();
        }
    }

    protected function applyOptionalCharges(array $data): array
    {
        $job = isset($data['job_request_id']) ? JobRequest::find($data['job_request_id']) : $this->record->jobRequest;
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

    protected function signatureFromData(array $data): array
    {
        $items = collect($data['items'] ?? [])
            ->map(fn ($item) => [
                'description' => trim((string) ($item['description'] ?? '')),
                'amount' => round((float) ($item['amount'] ?? 0), 2),
            ])
            ->sortBy(fn ($item) => $item['description'] . ':' . $item['amount'])
            ->values()
            ->all();

        return [
            'items' => $items,
            'tax_enabled' => (bool) ($data['tax_enabled'] ?? false),
            'notes' => trim((string) ($data['notes'] ?? '')),
        ];
    }
}
