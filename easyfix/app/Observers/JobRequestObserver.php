<?php

namespace App\Observers;

use App\Jobs\SyncMicronetJobRequestJob;
use App\Jobs\SyncMicronetJobStatusJob;
use App\Models\JobRequest;
use App\Services\MicronetSyncService;

class JobRequestObserver
{
    public function created(JobRequest $jobRequest): void
    {
        if (app(MicronetSyncService::class)->enabled()) {
            SyncMicronetJobRequestJob::dispatch($jobRequest->id);
        }
    }

    public function updated(JobRequest $jobRequest): void
    {
        if (app(MicronetSyncService::class)->enabled() && $jobRequest->wasChanged('status')) {
            SyncMicronetJobStatusJob::dispatch($jobRequest->id);
        }
    }
}
