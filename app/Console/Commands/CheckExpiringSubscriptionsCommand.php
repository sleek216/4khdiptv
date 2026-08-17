<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckExpiringSubscriptionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for subscriptions expiring in the next 3 days and notify admin via email and webhooks';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking expiring subscriptions...');

        // Find active orders expiring in next 3 days
        $expiringOrders = Order::with(['user', 'package'])
            ->whereNotNull('expires_at')
            ->where('expires_at', '>=', now())
            ->where('expires_at', '<=', now()->addDays(3))
            ->orderBy('expires_at', 'asc')
            ->get();

        if ($expiringOrders->isEmpty()) {
            $this->info('No subscriptions expiring in the next 3 days.');
            return self::SUCCESS;
        }

        $this->info("Found {$expiringOrders->count()} subscriptions expiring soon.");

        // 1. Send Discord / Telegram webhook alert
        $this->sendExpiringWebhook($expiringOrders);

        return self::SUCCESS;
    }

    protected function sendExpiringWebhook($orders): void
    {
        try {
            $count = $orders->count();
            $discordUrl = Setting::get('webhook_discord_url');
            $telegramBot = Setting::get('webhook_telegram_bot_token');
            $telegramChat = Setting::get('webhook_telegram_chat_id');

            $list = [];
            foreach ($orders->take(10) as $order) {
                $daysLeft = $order->expires_at->diffForHumans(null, true);
                $list[] = "• #{$order->order_number} - {$order->customer_name} ({$order->customer_email}) - Expiring in {$daysLeft}";
            }
            $listText = implode("\n", $list);

            // Discord
            if (!empty($discordUrl)) {
                Http::timeout(5)->post($discordUrl, [
                    'embeds' => [[
                        'title' => "⚠️ {$count} Subscriptions Expiring Soon!",
                        'description' => "The following customers have subscriptions expiring within 3 days:\n\n{$listText}",
                        'color' => 0xf59e0b, // Amber
                        'footer' => ['text' => '4khdiptv Expiry Monitor'],
                        'timestamp' => now()->toIso8601String(),
                    ]]
                ]);
            }

            // Telegram
            if (!empty($telegramBot) && !empty($telegramChat)) {
                $tgMsg = "⚠️ *{$count} SUBSCRIPTIONS EXPIRING SOON!*\n\n" . $listText;
                Http::timeout(5)->post("https://api.telegram.org/bot{$telegramBot}/sendMessage", [
                    'chat_id' => $telegramChat,
                    'text' => $tgMsg,
                    'parse_mode' => 'Markdown',
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to dispatch expiring subscription alert: ' . $e->getMessage());
        }
    }
}
