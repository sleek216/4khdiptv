@extends('admin.layouts.app')

@section('title', 'Commissions')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Commissions</h1>
        <p class="xai-subheading">Review and approve affiliate earnings from referred sales.</p>
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

    <div class="xai-card-light p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Affiliate</th>
                        <th>Order</th>
                        <th>Earnings</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">{{ $commission->created_at->format('M d, Y') }}</div>
                                <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">{{ $commission->created_at->format('H:i') }} UTC</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 24px; height: 24px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 10px;">
                                        {{ substr($commission->affiliate->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 13px;">{{ $commission->affiliate->user->name ?? 'Unknown' }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="mb-1">
                                    <span style="font-family: var(--font-display); color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 2px 8px; font-size: 11px;">#{{ $commission->order_id }}</span>
                                </div>
                                <div style="font-size: 10px; color: var(--xai-text-muted);">Sale: ${{ number_format($commission->order_amount, 2) }}</div>
                            </td>
                            <td>
                                <div style="font-family: var(--font-display); font-weight: 400; color: var(--atlas-success); font-size: 14px;">+${{ number_format($commission->commission_amount, 2) }}</div>
                                <div style="font-size: 10px; color: var(--xai-text-muted);">Rate: {{ $commission->commission_rate }}%</div>
                            </td>
                            <td>
                                @if($commission->status === 'paid')
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-success); letter-spacing: 0.5px; border: 1px solid var(--atlas-success); padding: 2px 8px;">Paid</span>
                                @elseif($commission->status === 'approved')
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-success); letter-spacing: 0.5px; border: 1px solid var(--atlas-success); padding: 2px 8px;">Approved</span>
                                @elseif($commission->status === 'pending')
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-amber); letter-spacing: 0.5px; border: 1px solid var(--atlas-amber); padding: 2px 8px;">Pending</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 10px; color: #ef4444; letter-spacing: 0.5px; border: 1px solid #ef4444; padding: 2px 8px;">Rejected</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($commission->status === 'pending')
                                    <div class="d-flex justify-content-end gap-2">
                                        <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px; color: var(--atlas-success); border-color: var(--atlas-success);">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.affiliate.commissions.reject', $commission) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px; color: #ef4444; border-color: #ef4444;">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <p style="font-family: var(--font-display); font-size: 12px;">No commissions found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $commissions->links('pagination::bootstrap-5') }}
    </div>
@endsection
