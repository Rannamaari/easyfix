<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class DhiraaguSmsClient
{
    public function normalizeDestination(string $phone): ?string
    {
        $phone = trim($phone);

        if ($phone === '' || preg_match('/[[:alpha:]]/u', $phone)) {
            return null;
        }

        if (! preg_match('/^[0-9\\s()+-]+$/', $phone)) {
            return null;
        }

        $digits = preg_replace('/\\D+/', '', $phone) ?? '';

        if (strlen($digits) === 7) {
            $digits = '960' . $digits;
        }

        if (strlen($digits) === 10 && str_starts_with($digits, '960')) {
            return $digits;
        }

        return null;
    }

    /**
     * @param array<int,string> $destinations
     * @return array{ok:bool,responses:array<int,array<string,mixed>>,sent:int,failed:int}
     */
    public function send(array $destinations, string $content, ?string $source = null): array
    {
        $destinations = array_values(array_unique(array_filter($destinations)));

        if ($destinations === []) {
            throw new \InvalidArgumentException('No valid destinations to send.');
        }

        $baseUrl = rtrim((string) config('services.dhiraagu_sms.base_url'), '/');
        $authKey = (string) config('services.dhiraagu_sms.authorization_key');
        $defaultSource = (string) config('services.dhiraagu_sms.source');
        $dryRun = (bool) config('services.dhiraagu_sms.dry_run');
        $chunkSize = max(1, (int) config('services.dhiraagu_sms.chunk_size', 200));
        $timeout = (int) config('services.dhiraagu_sms.timeout', 20);

        if (! $dryRun && trim($authKey) === '') {
            throw new \RuntimeException('Dhiraagu SMS is not configured.');
        }

        $source = $source ?: $defaultSource;
        $responses = [];
        $sent = 0;
        $failed = 0;

        foreach (array_chunk($destinations, $chunkSize) as $chunk) {
            if ($dryRun) {
                $responses[] = [
                    'transactionId' => 'dry-run-' . bin2hex(random_bytes(6)),
                    'transactionStatus' => 'true',
                    'transactionDescription' => 'DRY RUN: message accepted.',
                    'referenceNumber' => '',
                    '_chunk_size' => count($chunk),
                ];
                $sent += count($chunk);
                continue;
            }

            try {
                $response = Http::timeout($timeout)
                    ->acceptJson()
                    ->asJson()
                    ->post($baseUrl . '/sms', [
                        'destination' => $chunk,
                        'content' => $content,
                        'source' => $source,
                        'authorizationKey' => $authKey,
                    ]);
            } catch (ConnectionException $exception) {
                $responses[] = [
                    'transactionId' => null,
                    'transactionStatus' => 'false',
                    'transactionDescription' => 'Connection error: ' . $exception->getMessage(),
                    'referenceNumber' => '',
                    '_chunk_size' => count($chunk),
                ];
                $failed += count($chunk);
                continue;
            }

            $payload = $response->json();
            if (! is_array($payload)) {
                $payload = [
                    'transactionId' => null,
                    'transactionStatus' => 'false',
                    'transactionDescription' => 'Invalid response from SMS gateway.',
                    'referenceNumber' => '',
                ];
            }

            $payload['_http_status'] = $response->status();
            $payload['_chunk_size'] = count($chunk);
            $responses[] = $payload;

            $ok = (string) ($payload['transactionStatus'] ?? '') === 'true' && $response->successful();

            if ($ok) {
                $sent += count($chunk);
            } else {
                $failed += count($chunk);
            }
        }

        return [
            'ok' => $failed === 0 && $sent > 0,
            'responses' => $responses,
            'sent' => $sent,
            'failed' => $failed,
        ];
    }
}
