<?php

namespace App\Jobs;

use App\Models\JobRequest;
use App\Services\MicronetSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMicronetJobRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $jobRequestId)
    {
    }

    public function handle(MicronetSyncService $syncService): void
    {
        $job = JobRequest::find($this->jobRequestId);

        if (! $job) {
            return;
        }

        try {
            $syncService->syncJob($job);
        } catch (\Throwable $exception) {
            $job->forceFill(['micronet_sync_error' => $exception->getMessage()])->save();
            Log::warning('Micronet job sync failed: ' . $exception->getMessage(), ['job_request_id' => $job->id]);
            throw $exception;
        }
    }
}
