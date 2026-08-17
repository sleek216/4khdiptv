@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4 d-flex flex-wrap justify-content-between align-items-end gap-3">
    <div>
        <h1 class="xai-display">Dashboard</h1>
        <p class="xai-subheading">Quick view of revenue, orders, users, and what’s happening on the platform.</p>
    </div>
    <a href="{{ route('admin.export.system-backup') }}" class="btn-xai-secondary">
        <i class="ph ph-download-simple"></i>
        <span>Download system backup (CSV)</span>
    </a>
</div>

<div class="xai-card-dark mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <div class="stat-tile-label mb-1">Revenue period</div>
            <div style="font-weight: 700; color: var(--xai-text-primary);">Filter paid sales by time range</div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.dashboard', ['revenue_period' => '1_month']) }}"
               class="btn-xai-dark {{ ($period ?? 'all') === '1_month' ? 'active-period' : '' }}"
               style="padding: 8px 14px; {{ ($period ?? 'all') === '1_month' ? 'background: var(--atlas-teal); color: #fff; border-color: var(--atlas-teal);' : '' }}">
                1 Month
            </a>
            <a href="{{ route('admin.dashboard', ['revenue_period' => '12_months']) }}"
               class="btn-xai-dark"
               style="padding: 8px 14px; {{ ($period ?? 'all') === '12_months' ? 'background: var(--atlas-teal); color: #fff; border-color: var(--atlas-teal);' : '' }}">
                12 Months
            </a>
            <a href="{{ route('admin.dashboard', ['revenue_period' => 'all']) }}"
               class="btn-xai-dark"
               style="padding: 8px 14px; {{ ($period ?? 'all') === 'all' ? 'background: var(--atlas-teal); color: #fff; border-color: var(--atlas-teal);' : '' }}">
                All Time
            </a>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-teal);">
            <div class="d-flex justify-content-between align-items-start">
                <span class="stat-tile-label">Total revenue</span>
                <i class="ph ph-currency-dollar" style="color: var(--atlas-teal); font-size: 20px;"></i>
            </div>
            <div class="stat-tile-value">${{ number_format($stats['filtered_revenue'] ?? $stats['total_revenue'], 2) }}</div>
            <div class="stat-tile-foot">{{ $stats['period_label'] ?? 'All-time paid sales' }}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-amber);">
            <div class="d-flex justify-content-between align-items-start">
                <span class="stat-tile-label">Orders</span>
                <i class="ph ph-receipt" style="color: var(--atlas-amber); font-size: 20px;"></i>
            </div>
            <div class="stat-tile-value">{{ $stats['period_orders'] ?? $stats['total_orders'] }}</div>
            <div class="stat-tile-foot">
                @if(($period ?? 'all') === 'all')
                    Total transactions
                @else
                    Orders in selected period (all-time: {{ $stats['total_orders'] }})
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="xai-card-dark h-100" style="border-top: 3px solid #2F6FED;">
            <div class="d-flex justify-content-between align-items-start">
                <span class="stat-tile-label">Users</span>
                <i class="ph ph-users-three" style="color: #2F6FED; font-size: 20px;"></i>
            </div>
            <div class="stat-tile-value">{{ $stats['total_users'] }}</div>
            <div class="stat-tile-foot">Registered accounts</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-success);">
            <div class="d-flex justify-content-between align-items-start">
                <span class="stat-tile-label">Active packages</span>
                <i class="ph ph-package" style="color: var(--atlas-success); font-size: 20px;"></i>
            </div>
            <div class="stat-tile-value">{{ $stats['active_packages'] }}</div>
            <div class="stat-tile-foot">Plans available to buy</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="xai-card-dark">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <div class="stat-tile-label mb-1">Latest activity</div>
                    <h2 style="font-family: var(--font-display); font-size: 22px; font-weight: 700; margin: 0;">Recent orders</h2>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="btn-xai-secondary">
                    <span>View all orders</span>
                    <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="xai-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Package</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-end">When</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $order->user->name ?? 'Guest' }}</div>
                                    <div style="font-size: 12px; color: var(--xai-text-muted);">{{ $order->user->email ?? '—' }}</div>
                                </td>
                                <td>
                                    <span style="display:inline-block; padding: 4px 10px; background: var(--atlas-teal-soft); color: var(--atlas-teal); border-radius: 999px; font-size: 12px; font-weight: 600;">
                                        {{ $order->package->name ?? 'Custom' }}
                                    </span>
                                </td>
                                <td style="font-weight: 600;">${{ number_format($order->amount, 2) }}</td>
                                <td>
                                    @if($order->order_status == 'completed')
                                        <span class="status-pill ok">Completed</span>
                                    @else
                                        <span class="status-pill wait">{{ ucfirst($order->order_status ?? 'Pending') }}</span>
                                    @endif
                                </td>
                                <td class="text-end" style="color: var(--xai-text-muted); font-size: 13px;">
                                    {{ $order->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="color: var(--xai-text-muted);">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="xai-card-dark h-100">
            <div class="stat-tile-label mb-1">Shortcuts</div>
            <h3 style="font-family: var(--font-display); font-size: 22px; font-weight: 700; margin-bottom: 20px;">Quick actions</h3>

            <div class="d-grid gap-2">
                <a href="{{ route('admin.orders.create') }}" class="btn-xai-primary">
                    <i class="ph ph-plus"></i>
                    <span>Create order</span>
                </a>
                <a href="{{ route('admin.export.system-backup') }}" class="btn-xai-secondary">
                    <i class="ph ph-file-csv"></i>
                    <span>Backup CSV (Excel)</span>
                </a>
                <a href="{{ route('admin.packages.index') }}" class="btn-xai-secondary">
                    <i class="ph ph-package"></i>
                    <span>Manage packages</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="btn-xai-secondary">
                    <i class="ph ph-sliders-horizontal"></i>
                    <span>Open settings</span>
                </a>
            </div>

            <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--xai-border);">
                <div class="stat-tile-label mb-2">All-time revenue</div>
                <div style="font-size: 28px; font-weight: 800; color: var(--xai-text-primary);">
                    ${{ number_format($stats['total_revenue'], 2) }}
                </div>
                <p style="margin: 8px 0 0; font-size: 13px; color: var(--xai-text-secondary);">
                    This month: ${{ number_format($monthlyRevenue, 2) }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
