<?php

namespace App\Observers;

use App\Jobs\SyncMicronetApprovedQuoteJob;
use App\Jobs\SyncMicronetQuoteItemsJob;
use App\Models\JobQuote;
use App\Services\MicronetSyncService;

class JobQuoteObserver
{
    public function created(JobQuote $quote): void
    {
        if (! app(MicronetSyncService::class)->enabled()) {
            return;
        }

        if ($quote->status === 'sent') {
            SyncMicronetQuoteItemsJob::dispatch($quote->id);
        }

        if ($quote->isApproved()) {
            SyncMicronetApprovedQuoteJob::dispatch($quote->id);
        }
    }

    public function updated(JobQuote $quote): void
    {
        if (! app(MicronetSyncService::class)->enabled()) {
            return;
        }

        if (
            $quote->micronet_items_synced_at
            && ! $quote->micronet_invoice_synced_at
            && (
                $quote->wasChanged('amount')
                || $quote->wasChanged('subtotal')
                || $quote->wasChanged('tax_amount')
                || $quote->wasChanged('total')
                || $quote->wasChanged('notes')
            )
        ) {
            $quote->forceFill([
                'micronet_sync_error' => 'Quote changed after Micronet quotation sync. Review the Micronet quotation before invoice conversion.',
            ])->saveQuietly();
        }

        if ($quote->status === 'sent' && $quote->wasChanged('status') && ! $quote->micronet_items_synced_at) {
            SyncMicronetQuoteItemsJob::dispatch($quote->id);
        }

        if (
            $quote->isApproved()
            && ($quote->wasChanged('status') || $quote->wasChanged('approved_at'))
        ) {
            SyncMicronetApprovedQuoteJob::dispatch($quote->id);
        }
    }
}
