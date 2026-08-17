@extends('admin.layouts.app')

@section('title', 'Crypto Payments')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Crypto payments</h1>
        <p class="xai-subheading">NOWPayments API key, IPN secret, and default currency.</p>
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
            <form action="{{ route('admin.settings.update-nowpayments') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">NOWPayments</h2>

                    <div class="mb-4 d-flex flex-wrap gap-4">
                        <div class="d-flex align-items-center">
                            <input type="hidden" name="nowpayments_enabled" value="0">
                            <input type="checkbox" id="nowpayments_enabled" name="nowpayments_enabled" value="1" {{ ($nowpaymentsSettings['nowpayments_enabled'] ?? '0') == '1' ? 'checked' : '' }} style="accent-color: var(--atlas-teal); width: 16px; height: 16px; margin-right: 12px;">
                            <label for="nowpayments_enabled" style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary); cursor: pointer;">Enable crypto payments</label>
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="nowpayments_sandbox" name="nowpayments_sandbox" value="1" {{ ($nowpaymentsSettings['nowpayments_sandbox'] ?? '1') == '1' ? 'checked' : '' }} style="accent-color: var(--atlas-amber); width: 16px; height: 16px; margin-right: 12px;">
                            <label for="nowpayments_sandbox" style="font-family: var(--font-display); font-size: 13px; color: var(--atlas-amber); cursor: pointer;">Sandbox mode</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">API key</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-key" style="color: var(--xai-text-muted);"></i>
                            <input type="password" class="@error('nowpayments_api_key') is-invalid @enderror"
                                name="nowpayments_api_key"
                                value="{{ $nowpaymentsSettings['nowpayments_api_key'] ?? '' }}"
                                placeholder="Your NOWPayments API key">
                        </div>
                        @error('nowpayments_api_key')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 12px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">IPN secret</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-shield-check" style="color: var(--xai-text-muted);"></i>
                            <input type="password" class="@error('nowpayments_ipn_secret') is-invalid @enderror"
                                name="nowpayments_ipn_secret"
                                value="{{ $nowpaymentsSettings['nowpayments_ipn_secret'] ?? '' }}"
                                placeholder="IPN secret from NOWPayments">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">Default currency</label>
                        <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                            <select class="w-100" name="nowpayments_default_currency" style="background: transparent; border: none; color: var(--xai-text-primary); outline: none; appearance: none; cursor: pointer; font-family: var(--font-display); font-size: 13px;">
                                <option value="btc" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'btc' ? 'selected' : '' }} style="background: var(--xai-bg);">Bitcoin (BTC)</option>
                                <option value="eth" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'eth' ? 'selected' : '' }} style="background: var(--xai-bg);">Ethereum (ETH)</option>
                                <option value="usdttrc20" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? 'usdttrc20') == 'usdttrc20' ? 'selected' : '' }} style="background: var(--xai-bg);">USDT (TRC20)</option>
                                <option value="usdterc20" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'usdterc20' ? 'selected' : '' }} style="background: var(--xai-bg);">USDT (ERC20)</option>
                                <option value="ltc" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'ltc' ? 'selected' : '' }} style="background: var(--xai-bg);">Litecoin (LTC)</option>
                                <option value="trx" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'trx' ? 'selected' : '' }} style="background: var(--xai-bg);">Tron (TRX)</option>
                                <option value="bnbbsc" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'bnbbsc' ? 'selected' : '' }} style="background: var(--xai-bg);">BNB (BSC)</option>
                                <option value="xrp" {{ ($nowpaymentsSettings['nowpayments_default_currency'] ?? '') == 'xrp' ? 'selected' : '' }} style="background: var(--xai-bg);">Ripple (XRP)</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <button type="submit" class="btn-xai-primary py-3 px-5 justify-content-center">
                            <span>Save settings</span>
                        </button>
                        <button type="button" class="btn-xai-secondary py-3 px-4 justify-content-center" onclick="testConnection()">
                            <span>Test connection</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="xai-card-dark p-4 mb-4">
                <div class="stat-tile-label mb-3">IPN callback URL</div>
                <div class="p-3 mb-3" style="border: 1px solid var(--xai-border-strong);">
                    <code style="font-size: 11px; color: var(--xai-text-primary); word-break: break-all; font-family: var(--font-display);">{{ route('nowpayments.ipn') }}</code>
                </div>
                <button type="button" onclick="navigator.clipboard.writeText('{{ route('nowpayments.ipn') }}')" class="btn-xai-secondary w-100 py-2 justify-content-center" style="font-size: 12px;">
                    <span>Copy callback URL</span>
                </button>
            </div>

            <div class="xai-card-dark p-4 mb-4">
                <div class="stat-tile-label mb-3">Supported assets</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach(['BTC', 'ETH', 'USDT', 'LTC', 'TRX', 'BNB', 'XRP', '300+'] as $crypto)
                        <span style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 4px 10px;">{{ $crypto }}</span>
                    @endforeach
                </div>
                <p style="font-size: 12px; color: var(--xai-text-muted); margin-top: 16px; margin-bottom: 0;">NOWPayments supports 300+ digital assets.</p>
            </div>

            <div class="xai-card-dark p-4">
                <div class="stat-tile-label mb-3">Setup tips</div>
                <div style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.7;">
                    1. Create an account at <a href="https://nowpayments.io/" target="_blank" style="color: var(--atlas-teal);">nowpayments.io</a><br>
                    2. Copy your API key<br>
                    3. Create an IPN secret<br>
                    4. Paste the callback URL in NOWPayments<br>
                    5. Test the connection here
                </div>
            </div>
        </div>
    </div>

    <script>
        function testConnection() {
            const btn = event.currentTarget;
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span>Testing…</span>';

            fetch('{{ route('admin.settings.test-nowpayments') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = originalHTML;

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Connected',
                        text: 'NOWPayments connection verified.',
                        background: 'var(--xai-surface)',
                        color: 'var(--xai-text-primary)',
                        confirmButtonColor: 'var(--atlas-teal)',
                        customClass: {
                            confirmButton: 'btn-xai-primary'
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Connection failed',
                        text: data.error || 'Could not connect. Check your API key.',
                        background: 'var(--xai-surface)',
                        color: 'var(--xai-text-primary)',
                        confirmButtonColor: '#ef4444'
                    });
                }
            })
            .catch(error => {
                btn.disabled = false;
                btn.innerHTML = originalHTML;
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong while testing the connection.',
                    background: 'var(--xai-surface)',
                    color: 'var(--xai-text-primary)',
                    confirmButtonColor: '#ef4444'
                });
            });
        }
    </script>
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
