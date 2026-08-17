@extends('admin.layouts.app')

@section('title', 'Real-Time Webhook Notifications')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Real-Time Webhooks</h1>
        <p class="xai-subheading">Push instant live alerts to Discord, Telegram, or custom endpoints whenever orders, users, or messages are created in the database.</p>
    </div>

    <div class="xai-tabs mb-4">
        <a href="{{ route('admin.settings.index') }}" class="xai-tab {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
            <span>General</span>
        </a>
        <a href="{{ route('admin.settings.stripe') }}" class="xai-tab {{ request()->routeIs('admin.settings.stripe') ? 'active' : '' }}">
            <span>Stripe</span>
        </a>
        <a href="{{ route('admin.settings.nowpayments') }}" class="xai-tab {{ request()->routeIs('admin.settings.nowpayments') ? 'active' : '' }}">
            <span>Crypto</span>
        </a>
        <a href="{{ route('admin.settings.email') }}" class="xai-tab {{ request()->routeIs('admin.settings.email') ? 'active' : '' }}">
            <span>Email</span>
        </a>
        <a href="{{ route('admin.settings.backup') }}" class="xai-tab {{ request()->routeIs('admin.settings.backup') ? 'active' : '' }}">
            <span>Backup &amp; Export</span>
        </a>
        <a href="{{ route('admin.settings.webhooks') }}" class="xai-tab {{ request()->routeIs('admin.settings.webhooks') ? 'active' : '' }}">
            <span>Webhooks</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4 p-3" style="border-radius: var(--radius); background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; font-weight: 600; font-size: 13px;">
            <i class="ph-fill ph-check-circle" style="font-size: 20px; color: #10b981;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <form action="{{ route('admin.settings.update-webhooks') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="xai-card-dark p-4 mb-4" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3" style="border-bottom: 1px solid var(--xai-border);">
                        <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; color: var(--xai-text-primary);">
                            <i class="ph-bold ph-broadcast" style="color: #0B6E6A; margin-right: 6px;"></i>
                            Webhook Endpoints Configuration
                        </h2>
                    </div>

                    <!-- Master Webhook Toggle -->
                    <div class="mb-4 d-flex align-items-center justify-content-between p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: var(--radius);">
                        <div>
                            <label class="xai-label mb-1" style="font-weight: 700; color: var(--xai-text-primary);">Enable Outgoing Webhooks</label>
                            <div style="font-size: 12px; color: var(--xai-text-muted);">Send real-time event payloads when Orders, Users, or Messages are created.</div>
                        </div>
                        <div class="form-check form-switch mb-0 ms-3">
                            <input class="form-check-input" type="checkbox" name="webhook_enabled" value="1" id="webhook_enabled"
                                   style="width: 48px; height: 24px; cursor: pointer;"
                                   {{ ($webhookSettings['webhook_enabled'] ?? '1') === '1' ? 'checked' : '' }}>
                        </div>
                    </div>

                    <!-- 1. Discord Webhook -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="ph-fill ph-discord-logo" style="color: #5865F2; font-size: 20px;"></i>
                            <label for="webhook_discord_url" class="xai-label mb-0" style="font-weight: 700;">Discord Webhook URL</label>
                        </div>
                        <div class="search-input w-100" style="max-width: none; background: #ffffff; border: 1px solid #cbd5e1; border-radius: var(--radius); padding: 2px 12px; display: flex; align-items: center;">
                            <input type="url" name="webhook_discord_url" id="webhook_discord_url"
                                   value="{{ old('webhook_discord_url', $webhookSettings['webhook_discord_url']) }}"
                                   placeholder="https://discord.com/api/webhooks/..."
                                   style="border: none; background: transparent; width: 100%; outline: none; font-size: 13px; color: var(--xai-text-primary); padding: 10px 0;">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 4px;">
                            Sends formatted rich cards with Customer Name, Package, Price, and Status directly to your Discord channel.
                        </div>
                    </div>

                    <!-- 2. Telegram Bot Webhook -->
                    <div class="mb-4 p-3" style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: var(--radius);">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="ph-fill ph-telegram-logo" style="color: #0088cc; font-size: 20px;"></i>
                            <label class="xai-label mb-0" style="font-weight: 700; color: #0f766e;">Telegram Bot Instant Alerts</label>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-7">
                                <label for="webhook_telegram_bot_token" class="xai-label" style="font-size: 12px;">Telegram Bot Token</label>
                                <input type="text" name="webhook_telegram_bot_token" id="webhook_telegram_bot_token"
                                       class="form-control" value="{{ old('webhook_telegram_bot_token', $webhookSettings['webhook_telegram_bot_token']) }}"
                                       placeholder="123456789:ABCdefGhIJKlmNoPQRstuvw"
                                       style="background: #fff; border: 1px solid #cbd5e1; border-radius: var(--radius-sm); font-size: 13px; padding: 8px 12px;">
                            </div>
                            <div class="col-md-5">
                                <label for="webhook_telegram_chat_id" class="xai-label" style="font-size: 12px;">Telegram Chat ID / Channel ID</label>
                                <input type="text" name="webhook_telegram_chat_id" id="webhook_telegram_chat_id"
                                       class="form-control" value="{{ old('webhook_telegram_chat_id', $webhookSettings['webhook_telegram_chat_id']) }}"
                                       placeholder="e.g. 123456789 or @mychannel"
                                       style="background: #fff; border: 1px solid #cbd5e1; border-radius: var(--radius-sm); font-size: 13px; padding: 8px 12px;">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Custom Generic Webhook URL -->
                    <div class="mb-4">
                        <label for="webhook_custom_url" class="xai-label">Custom HTTP POST Webhook URL</label>
                        <div class="search-input w-100" style="max-width: none; background: #ffffff; border: 1px solid #cbd5e1; border-radius: var(--radius); padding: 2px 12px; display: flex; align-items: center;">
                            <i class="ph ph-globe" style="color: var(--xai-text-muted); font-size: 18px; margin-right: 8px;"></i>
                            <input type="url" name="webhook_custom_url" id="webhook_custom_url"
                                   value="{{ old('webhook_custom_url', $webhookSettings['webhook_custom_url']) }}"
                                   placeholder="https://your-api.com/webhooks/listener"
                                   style="border: none; background: transparent; width: 100%; outline: none; font-size: 13px; color: var(--xai-text-primary); padding: 10px 0;">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 4px;">
                            System will POST raw JSON event payloads (order.created, user.registered, contact.created).
                        </div>
                    </div>

                    <button type="submit" class="btn-xai-primary w-100 py-3 d-flex align-items-center justify-content-center gap-2" style="border-radius: var(--radius); font-weight: 700;">
                        <i class="ph-bold ph-floppy-disk"></i>
                        <span>Save Webhook Settings</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <!-- Test Webhook Trigger -->
            <div class="xai-card-dark p-4 mb-4" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h3 style="font-family: var(--font-display); font-size: 15px; font-weight: 700; margin: 0 0 12px; color: var(--xai-text-primary);">
                    <i class="ph-bold ph-paper-plane-tilt" style="color: #0B6E6A; margin-right: 6px;"></i>
                    Send Test Ping
                </h3>
                <p style="font-size: 12px; color: var(--xai-text-secondary); line-height: 1.5; margin-bottom: 16px;">
                    Send a test payload to your configured Discord, Telegram, and Custom endpoints right now to verify connectivity.
                </p>

                <form action="{{ route('admin.settings.test-webhooks') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn w-100 py-2 d-flex align-items-center justify-content-center gap-2"
                            style="background: #f8fafc; border: 1.5px solid #0B6E6A; color: #0B6E6A; font-weight: 700; border-radius: var(--radius-sm); font-size: 13px;">
                        <i class="ph-bold ph-broadcast"></i>
                        <span>Trigger Test Ping</span>
                    </button>
                </form>
            </div>

            <!-- Real-Time Desktop Feature Info -->
            <div class="xai-card-dark p-4" style="background: #ffffff; border: 1px solid var(--xai-border); border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="sidebar-status-dot" style="background: #10b981; width: 10px; height: 10px; border-radius: 50%; display: inline-block; animation: pulse 1.5s infinite;"></span>
                    <strong style="font-size: 13px; color: #0f766e;">Live Admin Desk Sync Active</strong>
                </div>
                <p style="font-size: 12px; color: var(--xai-text-secondary); line-height: 1.5; margin: 0;">
                    In addition to webhooks, your Admin Desk automatically polls and syncs database changes silently every few seconds. When a new order, user, or message arrives, you will receive a floating popup toast and badge increment without refreshing.
                </p>
            </div>
        </div>
    </div>
@endsection
