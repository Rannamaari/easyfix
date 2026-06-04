<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Services\MicronetSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMicronetPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $paymentId)
    {
    }

    public function handle(MicronetSyncService $syncService): void
    {
        $payment = Payment::find($this->paymentId);

        if (! $payment) {
            return;
        }

        try {
            $syncService->syncPayment($payment);
        } catch (\Throwable $exception) {
            $payment->forceFill(['micronet_sync_error' => $exception->getMessage()])->save();
            Log::warning('Micronet payment sync failed: ' . $exception->getMessage(), ['payment_id' => $payment->id]);
            throw $exception;
        }
    }
}
