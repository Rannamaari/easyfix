<?php

namespace App\Filament\Resources\JobQuoteResource\Pages;

use App\Filament\Resources\JobQuoteResource;
use Filament\Resources\Pages\EditRecord;

class EditJobQuote extends EditRecord
{
    protected static string $resource = JobQuoteResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
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
    }
}
