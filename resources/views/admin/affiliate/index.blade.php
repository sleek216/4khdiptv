@extends('admin.layouts.app')

@section('title', 'Affiliate Overview')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Affiliate program</h1>
        <p class="xai-subheading">Track performance, manage payouts, and see how the network is growing.</p>
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

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-teal);">
                <span class="stat-tile-label">Total affiliates</span>
                <div class="stat-tile-value">{{ $stats['total_affiliates'] }}</div>
                <div class="stat-tile-foot">{{ $stats['active_affiliates'] }} active</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-amber);">
                <span class="stat-tile-label">Total sales</span>
                <div class="stat-tile-value">${{ number_format($stats['total_sales'], 2) }}</div>
                <div class="stat-tile-foot">{{ $stats['total_referrals'] }} referrals</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-amber);">
                <span class="stat-tile-label">Pending payouts</span>
                <div class="stat-tile-value" style="color: var(--atlas-amber);">${{ number_format($stats['pending_earnings'], 2) }}</div>
                <div class="stat-tile-foot">{{ $stats['pending_payouts'] }} pending</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-success);">
                <span class="stat-tile-label">Total paid</span>
                <div class="stat-tile-value" style="color: var(--atlas-success);">${{ number_format($stats['paid_earnings'], 2) }}</div>
                <div class="stat-tile-foot">Completed payouts</div>
            </div>
        </div>
    </div>

    <div class="xai-card-light p-0 overflow-hidden">
        <div class="p-4 d-flex justify-content-between align-items-center border-bottom" style="border-color: var(--xai-border) !important;">
            <h2 style="font-family: var(--font-display); font-size: 18px; font-weight: 700; margin: 0; color: var(--xai-text-primary);">Top performers</h2>
            <a href="{{ route('admin.affiliate.affiliates') }}" class="btn-xai-secondary">
                <span>View all</span>
                <i class="ph ph-arrow-right"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Affiliate</th>
                        <th>Sales</th>
                        <th>Total revenue</th>
                        <th>Commissions</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topAffiliates as $affiliate)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">
                                        {{ substr($affiliate->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">{{ $affiliate->user->name ?? 'Unknown' }}</div>
                                        <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">{{ $affiliate->user->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-family: var(--font-display); font-size: 13px;">{{ $affiliate->total_referrals }}</td>
                            <td style="font-weight: 400; color: var(--xai-text-primary); font-family: var(--font-display);">${{ number_format($affiliate->total_sales, 2) }}</td>
                            <td style="font-family: var(--font-display); font-weight: 400; color: var(--atlas-success); font-size: 14px;">
                                ${{ number_format($affiliate->total_earnings, 2) }}
                            </td>
                            <td>
                                @if($affiliate->is_active)
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-success); letter-spacing: 0.5px; border: 1px solid var(--atlas-success); padding: 2px 8px;">Active</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); letter-spacing: 0.5px; border: 1px solid var(--xai-border-strong); padding: 2px 8px;">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <p style="font-family: var(--font-display); font-size: 12px;">No affiliates found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
