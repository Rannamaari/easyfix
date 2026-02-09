<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
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

        $message = "🆕 *New User Registered*\n\n"
            . "👤 *Name:* {$user->name}\n"
            . "📧 *Email:* {$user->email}\n"
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
