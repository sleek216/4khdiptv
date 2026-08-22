@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<div class="mb-5" data-aos="fade-in">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
        <div>
            <h1 class="xai-display">ORDER HISTORY</h1>
            <p class="xai-subheading">A complete history of all user orders, subscriptions, and platform transactions.</p>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.orders.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="btn-xai-secondary">
                    <i class="ph ph-check-double"></i>
                    <span>MARK ALL READ</span>
                </button>
            </form>
            <a href="{{ route('admin.orders.create') }}" class="btn-xai-primary">
                <span>CREATE ORDER</span>
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger mb-4">{{ session('error') }}</div>
@endif

<!-- Live Filters -->
<div class="xai-card-dark mb-4">
    <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-4 align-items-end">
        <div class="col-lg-6">
            <label style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">SEARCH</label>
            <div class="search-input w-100" style="max-width: none;">
                <i class="ph ph-magnifying-glass" style="color: var(--xai-text-muted);"></i>
                <input type="text" name="search" placeholder="Search by email or order ID..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-lg-3">
            <label style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">FILTER STATUS</label>
            <select name="status" class="w-100" style="background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 8px; padding: 8px 16px; color: var(--xai-text-primary); font-family: var(--font-main); font-size: 14px; appearance: none; cursor: pointer; outline: none;" onchange="this.form.submit()">
                <option value="">All States</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>
        <div class="col-lg-3">
            <button type="submit" class="btn-xai-dark w-100 py-2 justify-content-center">
                <span>SEARCH</span>
            </button>
        </div>
    </form>
</div>

<form action="{{ route('admin.orders.index') }}" method="POST" id="bulkOrdersForm">
    @csrf
    <input type="hidden" name="search" value="{{ request('search') }}">
    <input type="hidden" name="status" value="{{ request('status') }}">
    <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">

    <div class="xai-card-dark mb-4">
        <div class="d-flex flex-wrap align-items-end gap-3">
            <div style="min-width: 220px;">
                <label class="bulk-label">BULK ACTION</label>
                <select name="bulk_action" id="bulkAction" class="bulk-select" required>
                    <option value="both_status">Change Both (Order & Payment)</option>
                    <option value="order_status">Change Order Status Only</option>
                    <option value="payment_status">Change Payment Status Only</option>
                    <option value="delete">Delete Selected</option>
                </select>
            </div>
            <div style="min-width: 180px;" id="orderStatusWrap">
                <label class="bulk-label">ORDER STATUS</label>
                <select name="bulk_order_status" id="bulkOrderStatus" class="bulk-select">
                    <option value="">Select Order Status...</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="expired">Expired</option>
                </select>
            </div>
            <div style="min-width: 180px;" id="paymentStatusWrap">
                <label class="bulk-label">PAYMENT STATUS</label>
                <select name="bulk_payment_status" id="bulkPaymentStatus" class="bulk-select">
                    <option value="">Select Payment Status...</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>
            <button type="submit" class="btn-xai-primary" onclick="return confirmBulk()">
                <i class="ph ph-check-circle"></i>
                <span>Apply to selected</span>
            </button>
            <div style="margin-left: auto; color: var(--xai-text-muted); font-size: 13px;">
                <span id="selectedCount" style="font-weight: 700; color: var(--xai-text-primary);">0</span> selected
            </div>
        </div>
    </div>

    <div class="xai-card-light p-0">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 48px;">
                            <input type="checkbox" id="selectAllOrders" title="Select all">
                        </th>
                        <th>CUSTOMER</th>
                        <th>PACKAGE</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                        <th>PAYMENT</th>
                        <th>DATE</th>
                        <th class="text-end pe-4">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <input type="checkbox" class="order-checkbox" name="order_ids[]" value="{{ $order->id }}">
                            </td>
                            <td>
                                <div style="font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">{{ $order->user->name ?? ($order->customer_name ?? 'Transient') }}</div>
                                <div style="font-size: 12px; color: var(--xai-text-muted);">{{ $order->user->email ?? ($order->customer_email ?? '-') }}</div>
                            </td>
                            <td>
                                <span style="font-family: var(--font-display); font-size: 12px; padding: 4px 8px; border: 1px solid var(--xai-border-strong); border-radius: 6px; color: var(--xai-text-primary);">
                                    {{ $order->package->name ?? 'CUSTOM PACKAGE' }}
                                </span>
                            </td>
                            <td style="font-weight: 600;">${{ number_format($order->amount, 2) }}</td>
                            <td>
                                @if($order->order_status == 'completed')
                                    <span class="status-pill ok">COMPLETED</span>
                                @elseif($order->order_status == 'pending')
                                    <span class="status-pill wait">PENDING</span>
                                @else
                                    <span class="status-pill">{{ strtoupper($order->order_status) }}</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 12px; color: var(--xai-text-muted); text-transform: uppercase;">
                                    {{ $order->payment_status ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <div style="font-size: 12px; color: var(--xai-text-primary); font-weight: 500;">
                                    {{ $order->created_at->format('M d, Y') }}
                                </div>
                                @if($order->expires_at)
                                    @php
                                        $isExp = $order->expires_at->isPast();
                                        $isSoon = !$isExp && $order->expires_at->diffInDays(now()) <= 3;
                                    @endphp
                                    <div style="font-size: 11px; margin-top: 2px;">
                                        @if($isExp)
                                            <span style="color: #ef4444; font-weight: 700;">Expired ({{ $order->expires_at->format('M d') }})</span>
                                        @elseif($isSoon)
                                            <span style="color: #d97706; font-weight: 700;">Expiring in {{ $order->expires_at->diffForHumans(null, true) }}</span>
                                        @else
                                            <span style="color: #059669;">Exp: {{ $order->expires_at->format('M d, Y') }}</span>
                                        @endif
                                    </div>
                                @else
                                    <div style="font-size: 11px; color: var(--xai-text-muted);">Lifetime / Trial</div>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px;">VIEW</a>
                                    <button type="button" class="btn-xai-dark" style="padding: 6px 12px; font-size: 12px; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);" onclick="deleteSingleOrder('{{ route('admin.orders.destroy', $order) }}')">DELETE</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div style="color: var(--xai-text-muted); font-family: var(--font-display); font-size: 12px; letter-spacing: 1px;">NO ORDERS FOUND</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-top" style="border-color: var(--xai-border) !important;">
            {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</form>

<form id="deleteSingleOrderForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<style>
    .bulk-label {
        font-family: var(--font-display);
        font-size: 11px;
        color: var(--xai-text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 8px;
    }
    .bulk-select {
        width: 100%;
        background: transparent;
        border: 1px solid var(--xai-border-strong);
        border-radius: 8px;
        padding: 8px 12px;
        color: var(--xai-text-primary);
        outline: none;
    }
    .pagination { gap: 6px; margin: 0; }
    .page-link {
        border-radius: 8px !important;
        border: 1px solid var(--xai-border-strong) !important;
        color: var(--xai-text-primary) !important;
        background: transparent !important;
        padding: 8px 16px;
        font-family: var(--font-display);
        font-size: 12px;
    }
    .page-item.active .page-link {
        background: var(--xai-surface) !important;
        border-color: var(--xai-text-primary) !important;
    }
</style>
@endpush

@push('scripts')
<script>
(() => {
    const selectAll = document.getElementById('selectAllOrders');
    const boxes = () => [...document.querySelectorAll('.order-checkbox')];
    const countEl = document.getElementById('selectedCount');
    const bulkAction = document.getElementById('bulkAction');
    const orderWrap = document.getElementById('orderStatusWrap');
    const payWrap = document.getElementById('paymentStatusWrap');

    function refreshCount() {
        const checkedList = boxes().filter(b => b.checked);
        const n = checkedList.length;
        const total = boxes().length;
        if (countEl) {
            countEl.textContent = n;
        }
        if (selectAll) {
            selectAll.checked = n > 0 && n === total;
            selectAll.indeterminate = n > 0 && n < total;
        }
    }

    selectAll?.addEventListener('change', () => {
        boxes().forEach(b => b.checked = selectAll.checked);
        refreshCount();
    });

    document.addEventListener('change', (e) => {
        if (e.target && e.target.classList.contains('order-checkbox')) {
            refreshCount();
        }
    });

    function syncAction() {
        const action = bulkAction ? bulkAction.value : 'both_status';
        if (action === 'both_status') {
            if (orderWrap) orderWrap.style.display = '';
            if (payWrap) payWrap.style.display = '';
        } else if (action === 'order_status') {
            if (orderWrap) orderWrap.style.display = '';
            if (payWrap) payWrap.style.display = 'none';
        } else if (action === 'payment_status') {
            if (orderWrap) orderWrap.style.display = 'none';
            if (payWrap) payWrap.style.display = '';
        } else if (action === 'delete') {
            if (orderWrap) orderWrap.style.display = 'none';
            if (payWrap) payWrap.style.display = 'none';
        }
    }

    bulkAction?.addEventListener('change', syncAction);
    syncAction();
    refreshCount();

    window.confirmBulk = function () {
        const n = boxes().filter(b => b.checked).length;
        if (!n) {
            alert('Please select at least one order using the checkboxes.');
            return false;
        }

        const action = bulkAction ? bulkAction.value : 'both_status';

        if (action === 'delete') {
            return confirm(`Are you sure you want to permanently DELETE ${n} selected order(s)? This action cannot be undone.`);
        }

        const orderStatus = document.getElementById('bulkOrderStatus')?.value;
        const payStatus = document.getElementById('bulkPaymentStatus')?.value;

        if (action === 'order_status' && !orderStatus) {
            alert('Please choose an Order Status to apply.');
            return false;
        }

        if (action === 'payment_status' && !payStatus) {
            alert('Please choose a Payment Status to apply.');
            return false;
        }

        if (action === 'both_status' && !orderStatus && !payStatus) {
            alert('Please choose at least one status (Order Status or Payment Status) to apply.');
            return false;
        }

        return confirm(`Apply bulk changes to ${n} selected order(s)?`);
    };

    window.deleteSingleOrder = function (url) {
        if (confirm('Are you sure you want to delete this order?')) {
            const form = document.getElementById('deleteSingleOrderForm');
            form.action = url;
            form.submit();
        }
    };
})();
</script>
@endpush
