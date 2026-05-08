<?php

namespace App\Services;

use App\Models\JobRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotifier
{
    public function sendNewJobRequest(JobRequest $jobRequest): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (! $token || ! $chatId) {
            return;
        }

        $fingerprint = 'telegram:new-job-request:' . $jobRequest->id;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $jobRequest->loadMissing(['customer', 'category', 'service']);

        $customer = $jobRequest->customer;
        $service = $jobRequest->service?->name ?: 'General service request';
        $category = $jobRequest->category?->name ?: 'Uncategorized';
        $phone = $customer?->phone ? '+960 ' . $customer->phone : 'Not provided';
        $email = $customer?->email ?: 'Not provided';
        $preferredTime = $jobRequest->preferred_time?->timezone(config('app.timezone'))->format('M d, Y h:i A') ?: 'Not specified';
        $address = $jobRequest->address ?: 'Not provided';
        $description = trim((string) $jobRequest->description);
        $priority = $jobRequest->urgent_requested
            ? 'Urgent within 1 hour (+MVR ' . number_format((float) $jobRequest->urgent_surcharge_amount, 2) . ')'
            : 'Standard';

        if (mb_strlen($description) > 220) {
            $description = mb_substr($description, 0, 217) . '...';
        }

        $message = "🛠️ *New Service Request*\n\n"
            . "🆔 *Job ID:* #{$jobRequest->id}\n"
            . "👤 *Customer:* " . ($customer?->name ?: 'Unknown') . "\n"
            . "📱 *Phone:* {$phone}\n"
            . "📧 *Email:* {$email}\n"
            . "🧰 *Category:* {$category}\n"
            . "🔧 *Service:* {$service}\n"
            . "⚡ *Priority:* {$priority}\n"
            . "📍 *Address:* {$address}\n"
            . "🕐 *Preferred Time:* {$preferredTime}\n"
            . "📝 *Issue:* " . ($description !== '' ? $description : 'No description provided');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Throwable $exception) {
            Log::warning('Telegram job request notification failed: ' . $exception->getMessage(), [
                'job_request_id' => $jobRequest->id,
            ]);
        }
    }

    public function sendQuoteApproved(JobRequest $jobRequest): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (! $token || ! $chatId) {
            return;
        }

        $fingerprint = 'telegram:quote-approved:' . $jobRequest->id . ':' . optional($jobRequest->latestQuote)->id;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $jobRequest->loadMissing(['customer', 'category', 'service', 'latestQuote']);

        $quote = $jobRequest->latestQuote;
        $customer = $jobRequest->customer;
        $amount = number_format((float) ($quote?->total ?? $quote?->amount ?? 0), 2);
        $includesTax = $quote?->tax_enabled ? ' (incl. GST)' : '';

        $message = "✅ *Quote Approved*\n\n"
            . "🆔 *Job ID:* #{$jobRequest->id}\n"
            . "👤 *Customer:* " . ($customer?->name ?: 'Unknown') . "\n"
            . "📱 *Phone:* " . ($customer?->phone ? '+960 ' . $customer->phone : 'Not provided') . "\n"
            . "🧰 *Category:* " . ($jobRequest->category?->name ?: 'Uncategorized') . "\n"
            . "🔧 *Service:* " . ($jobRequest->service?->name ?: 'General service request') . "\n"
            . "💰 *Approved Amount:* MVR {$amount}{$includesTax}\n"
            . "📍 *Address:* " . ($jobRequest->address ?: 'Not provided');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Throwable $exception) {
            Log::warning('Telegram quote approved notification failed: ' . $exception->getMessage(), [
                'job_request_id' => $jobRequest->id,
            ]);
        }
    }
}
