<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendTelegramNewUserNotification
{
    public function handle(Registered $event): void
    {
        $token = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (! $token || ! $chatId) {
            return;
        }

        $user = $event->user;
        $fingerprint = 'telegram:new-user:' . $user->id . ':' . optional($user->created_at)->timestamp;

        if (! Cache::add($fingerprint, true, now()->addMinutes(10))) {
            return;
        }

        $email = $user->email ?: 'Not provided';
        $phone = $user->phone ? '+960 ' . $user->phone : 'Not provided';

        $message = "🆕 *New User Registered*\n\n"
            . "👤 *Name:* {$user->name}\n"
            . "📱 *Phone:* {$phone}\n"
            . "📧 *Email:* {$email}\n"
            . "🕐 *Time:* " . now()->format('M d, Y h:i A');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Throwable $e) {
            Log::warning('Telegram notification failed: ' . $e->getMessage());
        }
    }
}
