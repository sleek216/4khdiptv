<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookNotificationService
{
    /**
     * Send webhook notification for a newly created Order.
     */
    public static function notifyNewOrder(Order $order): void
    {
        $payload = [
            'event' => 'order.created',
            'timestamp' => now()->toIso8601String(),
            'data' => [
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'customer_email' => $order->customer_email,
                'customer_phone' => $order->customer_phone ?? 'N/A',
                'package_name' => $order->package->name ?? 'Custom Package',
                'amount' => (float) $order->amount,
                'payment_method' => $order->payment_method ?? 'N/A',
                'payment_status' => $order->payment_status,
                'order_status' => $order->order_status,
                'created_at' => $order->created_at->format('Y-m-d H:i:s'),
            ],
        ];

        // Format Discord Embed
        $discordData = [
            'embeds' => [[
                'title' => '🛒 New Order Received! #' . $order->order_number,
                'description' => "A new order has been placed on **" . config('app.name', '4khdiptv') . "**",
                'color' => 0x10b981, // Emerald Green
                'fields' => [
                    ['name' => '👤 Customer', 'value' => "{$order->customer_name} ({$order->customer_email})", 'inline' => false],
                    ['name' => '📦 Package', 'value' => $order->package->name ?? 'N/A', 'inline' => true],
                    ['name' => '💵 Amount', 'value' => '$' . number_format((float) $order->amount, 2), 'inline' => true],
                    ['name' => '💳 Payment Method', 'value' => strtoupper($order->payment_method ?? 'N/A'), 'inline' => true],
                    ['name' => '📊 Payment Status', 'value' => strtoupper($order->payment_status), 'inline' => true],
                ],
                'footer' => ['text' => '4khdiptv Real-Time Order Notification'],
                'timestamp' => now()->toIso8601String(),
            ]],
        ];

        // Format Telegram Message
        $telegramText = "🛒 *NEW ORDER RECEIVED!* \n\n"
            . "📄 *Order #:* `{$order->order_number}`\n"
            . "👤 *Customer:* {$order->customer_name}\n"
            . "✉️ *Email:* {$order->customer_email}\n"
            . "📦 *Package:* " . ($order->package->name ?? 'N/A') . "\n"
            . "💵 *Amount:* $" . number_format((float) $order->amount, 2) . "\n"
            . "💳 *Payment:* " . strtoupper($order->payment_method ?? 'N/A') . "\n"
            . "📊 *Status:* " . strtoupper($order->payment_status) . "\n"
            . "⏰ *Time:* " . now()->format('Y-m-d H:i:s');

        self::dispatch($payload, $discordData, $telegramText);
    }

    /**
     * Send webhook notification for a new User registration.
     */
    public static function notifyNewUser(User $user): void
    {
        if ($user->isAdmin()) {
            return;
        }

        $payload = [
            'event' => 'user.registered',
            'timestamp' => now()->toIso8601String(),
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? 'N/A',
                'country' => $user->country ?? 'N/A',
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
            ],
        ];

        $discordData = [
            'embeds' => [[
                'title' => '👤 New User Registered!',
                'description' => "A new customer account was created on **" . config('app.name', '4khdiptv') . "**",
                'color' => 0x3b82f6, // Blue
                'fields' => [
                    ['name' => 'Name', 'value' => $user->name, 'inline' => true],
                    ['name' => 'Email', 'value' => $user->email, 'inline' => true],
                    ['name' => 'Country', 'value' => $user->country ?? 'N/A', 'inline' => true],
                ],
                'footer' => ['text' => '4khdiptv User Notification'],
                'timestamp' => now()->toIso8601String(),
            ]],
        ];

        $telegramText = "👤 *NEW USER REGISTERED!*\n\n"
            . "👤 *Name:* {$user->name}\n"
            . "✉️ *Email:* {$user->email}\n"
            . "🌍 *Country:* " . ($user->country ?? 'N/A') . "\n"
            . "⏰ *Time:* " . now()->format('Y-m-d H:i:s');

        self::dispatch($payload, $discordData, $telegramText);
    }

    /**
     * Send webhook notification for a new Contact Inquiry.
     */
    public static function notifyNewContact(Contact $contact): void
    {
        $payload = [
            'event' => 'contact.created',
            'timestamp' => now()->toIso8601String(),
            'data' => [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'subject' => $contact->subject ?? 'General Inquiry',
                'message' => $contact->message,
                'created_at' => $contact->created_at->format('Y-m-d H:i:s'),
            ],
        ];

        $discordData = [
            'embeds' => [[
                'title' => '📩 New Support / Contact Message!',
                'description' => "A customer sent a message via the website contact form",
                'color' => 0xf59e0b, // Amber
                'fields' => [
                    ['name' => 'From', 'value' => "{$contact->name} ({$contact->email})", 'inline' => false],
                    ['name' => 'Subject', 'value' => $contact->subject ?? 'General Inquiry', 'inline' => false],
                    ['name' => 'Message', 'value' => mb_substr((string) $contact->message, 0, 500), 'inline' => false],
                ],
                'footer' => ['text' => '4khdiptv Contact Notification'],
                'timestamp' => now()->toIso8601String(),
            ]],
        ];

        $telegramText = "📩 *NEW SUPPORT MESSAGE!*\n\n"
            . "👤 *From:* {$contact->name} ({$contact->email})\n"
            . "📌 *Subject:* " . ($contact->subject ?? 'General Inquiry') . "\n"
            . "💬 *Message:* " . mb_substr((string) $contact->message, 0, 300) . "\n"
            . "⏰ *Time:* " . now()->format('Y-m-d H:i:s');

        self::dispatch($payload, $discordData, $telegramText);
    }

    /**
     * Dispatch the payloads to configured webhook endpoints.
     */
    protected static function dispatch(array $genericPayload, array $discordPayload, string $telegramText): void
    {
        try {
            $enabled = Setting::get('webhook_enabled', '1') === '1';
            if (!$enabled) {
                return;
            }

            // 1. Discord Webhook
            $discordUrl = Setting::get('webhook_discord_url');
            if (!empty($discordUrl) && filter_var($discordUrl, FILTER_VALIDATE_URL)) {
                Http::timeout(5)->post($discordUrl, $discordPayload);
            }

            // 2. Telegram Bot Webhook
            $botToken = Setting::get('webhook_telegram_bot_token');
            $chatId = Setting::get('webhook_telegram_chat_id');
            if (!empty($botToken) && !empty($chatId)) {
                Http::timeout(5)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $telegramText,
                    'parse_mode' => 'Markdown',
                ]);
            }

            // 3. Custom Generic Webhook URL
            $customUrl = Setting::get('webhook_custom_url');
            if (!empty($customUrl) && filter_var($customUrl, FILTER_VALIDATE_URL)) {
                Http::timeout(5)->post($customUrl, $genericPayload);
            }
        } catch (\Throwable $e) {
            Log::warning('Webhook dispatch error: ' . $e->getMessage());
        }
    }

    /**
     * Send a test webhook notification.
     */
    public static function sendTest(): array
    {
        $results = [];

        // Discord
        $discordUrl = Setting::get('webhook_discord_url');
        if (!empty($discordUrl)) {
            try {
                $res = Http::timeout(5)->post($discordUrl, [
                    'content' => '🟢 **4khdiptv Webhook Test Successful!** Real-time notifications are working properly.'
                ]);
                $results['discord'] = $res->successful() ? 'Success' : 'Failed (' . $res->status() . ')';
            } catch (\Exception $e) {
                $results['discord'] = 'Error: ' . $e->getMessage();
            }
        }

        // Telegram
        $botToken = Setting::get('webhook_telegram_bot_token');
        $chatId = Setting::get('webhook_telegram_chat_id');
        if (!empty($botToken) && !empty($chatId)) {
            try {
                $res = Http::timeout(5)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => "🟢 *4khdiptv Telegram Webhook Test Successful!*\nReal-time notifications are active.",
                    'parse_mode' => 'Markdown'
                ]);
                $results['telegram'] = $res->successful() ? 'Success' : 'Failed (' . $res->status() . ')';
            } catch (\Exception $e) {
                $results['telegram'] = 'Error: ' . $e->getMessage();
            }
        }

        // Custom URL
        $customUrl = Setting::get('webhook_custom_url');
        if (!empty($customUrl)) {
            try {
                $res = Http::timeout(5)->post($customUrl, [
                    'event' => 'test',
                    'message' => '4khdiptv webhook test ping',
                    'timestamp' => now()->toIso8601String()
                ]);
                $results['custom'] = $res->successful() ? 'Success' : 'Failed (' . $res->status() . ')';
            } catch (\Exception $e) {
                $results['custom'] = 'Error: ' . $e->getMessage();
            }
        }

        return $results;
    }
}
