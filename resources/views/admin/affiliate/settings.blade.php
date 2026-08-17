@extends('admin.layouts.app')

@section('title', 'Affiliate Settings')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Affiliate settings</h1>
        <p class="xai-subheading">Set commission rates, payout minimums, and how long referral tracking lasts.</p>
    </div>

    <div class="xai-tabs mb-4">
        <a href="{{ route('admin.affiliate.index') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.index') ? 'active' : '' }}">
            <i class="ph ph-chart-line-up"></i>
            <span>Overview</span>
        </a>
        <a href="{{ route('admin.affiliate.affiliates') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.affiliates') ? 'active' : '' }}">
            <i class="ph ph-users"></i>
            <span>Affiliates</span>
        </a>
        <a href="{{ route('admin.affiliate.referrals') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.referrals') ? 'active' : '' }}">
            <i class="ph ph-arrows-merge"></i>
            <span>Referrals</span>
        </a>
        <a href="{{ route('admin.affiliate.commissions') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.commissions') ? 'active' : '' }}">
            <i class="ph ph-hand-coins"></i>
            <span>Commissions</span>
        </a>
        <a href="{{ route('admin.affiliate.payouts') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.payouts') ? 'active' : '' }}">
            <i class="ph ph-wallet"></i>
            <span>Payouts</span>
        </a>
        <a href="{{ route('admin.affiliate.settings') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.settings') ? 'active' : '' }}">
            <i class="ph ph-sliders"></i>
            <span>Settings</span>
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <form action="{{ route('admin.affiliate.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="xai-card-light p-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3" style="border-color: var(--xai-border) !important;">
                        <div>
                            <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0; color: var(--xai-text-primary);">Program status</h2>
                            <div style="font-size: 12px; color: var(--xai-text-muted); margin-top: 4px;">Turn the affiliate program on or off.</div>
                        </div>
                        <div class="form-check form-switch custom-framer-switch p-0">
                            <input class="form-check-input ms-0" type="checkbox" id="affiliate_enabled" name="affiliate_enabled" value="1" {{ \App\Models\Setting::get('affiliate_enabled', true) ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-config-label">Default commission rate (%)</label>
                        <div class="xai-input-vault">
                            <input type="number" name="affiliate_commission_rate" class="xai-config-input"
                                value="{{ \App\Models\Setting::get('affiliate_commission_rate', 20) }}"
                                min="0" max="100" step="0.1" required>
                        </div>
                        <div class="xai-config-hint">Paid once per referred user — on their first completed package purchase only (renewals do not earn commission).</div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="xai-config-label">Minimum payout ($)</label>
                            <div class="xai-input-vault">
                                <input type="number" name="affiliate_minimum_payout" class="xai-config-input"
                                    value="{{ \App\Models\Setting::get('affiliate_minimum_payout', 50) }}"
                                    min="0" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-config-label">Cookie duration (days)</label>
                            <div class="xai-input-vault">
                                <input type="number" name="affiliate_cookie_duration" class="xai-config-input"
                                    value="{{ \App\Models\Setting::get('affiliate_cookie_duration', 30) }}"
                                    min="1" max="365" step="1" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-xai-primary py-3 px-5 w-100">
                        <span>Save changes</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="xai-card-dark p-4">
                <div class="stat-tile-label mb-3">How these settings work</div>
                <div style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.7;">
                    <div class="mb-3"><strong style="color: var(--xai-text-primary);">Commission rate</strong><br><span style="color: var(--xai-text-muted);">Share of the referred user’s first package sale.</span></div>
                    <div class="mb-3"><strong style="color: var(--xai-text-primary);">One-time only</strong><br><span style="color: var(--xai-text-muted);">No commission on renewals or repeat buys from the same referred user.</span></div>
                    <div class="mb-3"><strong style="color: var(--xai-text-primary);">Minimum payout</strong><br><span style="color: var(--xai-text-muted);">Balance needed before a withdrawal can be requested.</span></div>
                    <div><strong style="color: var(--xai-text-primary);">Cookie duration</strong><br><span style="color: var(--xai-text-muted);">How long a referral click stays attributed.</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .xai-config-label {
        font-family: var(--font-display);
        font-size: 11px;
        color: var(--xai-text-muted);
        margin-bottom: 8px;
        display: block;
    }
    .xai-input-vault {
        background: transparent;
        border: 1px solid var(--xai-border-strong);
        border-radius: 0px;
        transition: all 0.2s;
    }
    .xai-config-input {
        background: transparent;
        border: none;
        width: 100%;
        padding: 12px 16px;
        color: var(--xai-text-primary);
        font-size: 14px;
        font-family: var(--font-display);
    }
    .xai-config-input:focus { outline: none; }
    .xai-input-vault:focus-within {
        border-color: var(--atlas-teal);
    }
    .xai-config-hint {
        font-size: 11px;
        color: var(--xai-text-muted);
        margin-top: 8px;
    }
    .custom-framer-switch .form-check-input {
        background-color: transparent;
        border: 1px solid var(--xai-border-strong);
        width: 40px;
        height: 20px;
        border-radius: 0px;
        cursor: pointer;
    }
    .custom-framer-switch .form-check-input:checked {
        background-color: var(--atlas-teal);
        border-color: var(--atlas-teal);
    }
</style>
@endpush
