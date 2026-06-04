<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class MicronetApiClient
{
    protected function client(): PendingRequest
    {
        return Http::baseUrl(rtrim((string) config('services.micronet.base_url'), '/'))
            ->acceptJson()
            ->asJson()
            ->timeout((int) config('services.micronet.timeout', 20))
            ->withToken((string) config('services.micronet.token'));
    }

    public function enabled(): bool
    {
        return (bool) config('services.micronet.enabled')
            && filled(config('services.micronet.base_url'))
            && filled(config('services.micronet.token'));
    }

    public function createCustomer(array $payload): array
    {
        return $this->client()->post('/customers', $payload)->throw()->json();
    }

    public function createJob(array $payload): array
    {
        return $this->client()->post('/jobs', $payload)->throw()->json();
    }

    public function addJobItem(int $jobId, array $payload): array
    {
        return $this->client()->post("/jobs/{$jobId}/items", $payload)->throw()->json();
    }

    public function convertInvoice(int $jobId, array $payload): array
    {
        return $this->client()->post("/jobs/{$jobId}/convert-invoice", $payload)->throw()->json();
    }

    public function updateJobStatus(int $jobId, array $payload): array
    {
        return $this->client()->patch("/jobs/{$jobId}/status", $payload)->throw()->json();
    }

    public function recordPayment(int $jobId, array $payload): array
    {
        return $this->client()->post("/jobs/{$jobId}/payments", $payload)->throw()->json();
    }
}
