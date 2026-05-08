<?php

namespace App\Services;

use App\Models\JobRequest;
use App\Models\User;
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
}
