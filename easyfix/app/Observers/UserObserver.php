<?php

namespace App\Observers;

use App\Jobs\SyncMicronetCustomerJob;
use App\Models\User;
use App\Services\MicronetSyncService;

class UserObserver
{
    public function created(User $user): void
    {
        if ($user->isCustomer() && app(MicronetSyncService::class)->enabled()) {
            SyncMicronetCustomerJob::dispatch($user->id);
        }
    }
}
