<?php

namespace App\Observers;

use App\Jobs\SyncMicronetPaymentJob;
use App\Models\Payment;
use App\Services\MicronetSyncService;

class PaymentObserver
{
    public function created(Payment $payment): void
    {
        if ($payment->isConfirmed() && app(MicronetSyncService::class)->enabled()) {
            SyncMicronetPaymentJob::dispatch($payment->id);
        }
    }

    public function updated(Payment $payment): void
    {
        if (
            app(MicronetSyncService::class)->enabled()
            && $payment->isConfirmed()
            && ($payment->wasChanged('status') || $payment->wasChanged('confirmed_at'))
        ) {
            SyncMicronetPaymentJob::dispatch($payment->id);
        }
    }
}
