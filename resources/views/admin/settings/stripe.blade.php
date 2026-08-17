@extends('admin.layouts.app')

@section('title', 'Stripe Configuration')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Stripe</h1>
        <p class="xai-subheading">Card payments via Stripe — keys, mode, and webhooks.</p>
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

    <div class="row g-4">
        <div class="col-lg-8">
            <form action="{{ route('admin.settings.update-stripe') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Payment settings</h2>

                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="stripe_enabled" name="stripe_enabled" value="1" {{ ($stripeSettings['stripe_enabled'] ?? '1') == '1' ? 'checked' : '' }} style="accent-color: var(--atlas-teal); width: 16px; height: 16px; margin-right: 12px;">
                            <label for="stripe_enabled" style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary); cursor: pointer;">Enable Stripe payments</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">Mode</label>
                        <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                            <select class="w-100" name="stripe_mode" required style="background: transparent; border: none; color: var(--xai-text-primary); outline: none; appearance: none; cursor: pointer; font-family: var(--font-display); font-size: 13px;">
                                <option value="test" {{ ($stripeSettings['stripe_mode'] ?? 'test') == 'test' ? 'selected' : '' }} style="background: var(--xai-bg);">Test (sandbox)</option>
                                <option value="live" {{ ($stripeSettings['stripe_mode'] ?? '') == 'live' ? 'selected' : '' }} style="background: var(--xai-bg);">Live (production)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">Publishable key</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-share-network" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="@error('stripe_publishable_key') is-invalid @enderror"
                                name="stripe_publishable_key"
                                value="{{ $stripeSettings['stripe_publishable_key'] ?? '' }}"
                                placeholder="pk_test_...">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">Secret key</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-lock-key" style="color: var(--xai-text-muted);"></i>
                            <input type="password" class="@error('stripe_secret_key') is-invalid @enderror"
                                name="stripe_secret_key"
                                value="{{ $stripeSettings['stripe_secret_key'] ?? '' }}"
                                placeholder="sk_test_...">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">Webhook signing secret</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-shield-check" style="color: var(--xai-text-muted);"></i>
                            <input type="password" class="@error('stripe_webhook_secret') is-invalid @enderror"
                                name="stripe_webhook_secret"
                                value="{{ $stripeSettings['stripe_webhook_secret'] ?? '' }}"
                                placeholder="whsec_...">
                        </div>
                    </div>

                    <button type="submit" class="btn-xai-primary py-3 px-5 justify-content-center">
                        <span>Save Stripe settings</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="xai-card-dark p-4 mb-4">
                <div class="stat-tile-label mb-3">Webhook URL</div>
                <div class="p-3 mb-3" style="border: 1px solid var(--xai-border-strong);">
                    <code style="font-size: 11px; color: var(--xai-text-primary); word-break: break-all; font-family: var(--font-display);">{{ route('stripe.webhook') }}</code>
                </div>
                <button type="button" onclick="navigator.clipboard.writeText('{{ route('stripe.webhook') }}')" class="btn-xai-secondary w-100 py-2 justify-content-center" style="font-size: 12px;">
                    <span>Copy webhook URL</span>
                </button>
            </div>

            <div class="xai-card-dark p-4">
                <div class="stat-tile-label mb-3">Setup tips</div>
                <div style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.7;">
                    1. Open <a href="https://dashboard.stripe.com/apikeys" target="_blank" style="color: var(--atlas-teal);">Stripe API keys</a><br>
                    2. Copy your publishable and secret keys<br>
                    3. Add the webhook URL in Stripe<br>
                    4. Subscribe to <code>checkout.session.completed</code> and <code>payment_intent.payment_failed</code><br>
                    5. Paste the signing secret here
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .xai-label {
        font-family: var(--font-display);
        font-size: 11px;
        font-weight: 400;
        color: var(--xai-text-secondary);
        margin-bottom: 8px;
        display: block;
    }
</style>
@endpush
