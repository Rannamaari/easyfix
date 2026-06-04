<?php

namespace App\Jobs;

use App\Models\JobQuote;
use App\Services\MicronetSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMicronetApprovedQuoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $quoteId)
    {
    }

    public function handle(MicronetSyncService $syncService): void
    {
        $quote = JobQuote::find($this->quoteId);

        if (! $quote) {
            return;
        }

        try {
            $syncService->syncApprovedQuote($quote);
        } catch (\Throwable $exception) {
            $quote->forceFill(['micronet_sync_error' => $exception->getMessage()])->save();
            Log::warning('Micronet approved quote sync failed: ' . $exception->getMessage(), ['job_quote_id' => $quote->id]);
            throw $exception;
        }
    }
}
