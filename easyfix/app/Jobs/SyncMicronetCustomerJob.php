<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\MicronetSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMicronetCustomerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $userId)
    {
    }

    public function handle(MicronetSyncService $syncService): void
    {
        $user = User::find($this->userId);

        if (! $user) {
            return;
        }

        try {
            $syncService->syncCustomer($user);
        } catch (\Throwable $exception) {
            $user->forceFill(['micronet_sync_error' => $exception->getMessage()])->save();
            Log::warning('Micronet customer sync failed: ' . $exception->getMessage(), ['user_id' => $user->id]);
            throw $exception;
        }
    }
}
