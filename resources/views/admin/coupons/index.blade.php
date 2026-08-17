@extends('admin.layouts.app')

@section('title', 'Promo Codes')

@section('content')
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
            <div>
                <h1 class="xai-display">Promo codes</h1>
                <p class="xai-subheading">Discount codes and promotional campaigns.</p>
            </div>
            <a href="{{ route('admin.coupons.create') }}" class="btn-xai-primary">
                <span>Create promo</span>
            </a>
        </div>
    </div>

    <div class="xai-card-dark mb-4">
        <div style="font-family: var(--font-display); font-size: 14px; color: var(--xai-text-primary);">
            <span style="font-size: 18px; font-weight: 700;">{{ $coupons->total() }}</span> promo codes
        </div>
    </div>

    @if(session('success'))
        <div class="xai-card-dark mb-4 py-3 px-4" style="border-color: var(--atlas-success) !important;">
            <div style="font-family: var(--font-display); font-size: 13px; color: var(--atlas-success);">{{ session('success') }}</div>
        </div>
    @endif

    <div class="xai-card-light p-0">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Code</th>
                        <th>Discount</th>
                        <th>Usage</th>
                        <th>Expires</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div style="font-family: var(--font-display); font-weight: 400; font-size: 14px; color: var(--xai-text-primary);">
                                    {{ $coupon->code }}
                                </div>
                                <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 4px;">
                                    {{ ucfirst($coupon->type) }}
                                </div>
                            </td>
                            <td>
                                <div style="font-family: var(--font-display); font-size: 16px; font-weight: 400; color: var(--xai-text-primary);">
                                    @if($coupon->type === 'percentage')
                                        {{ $coupon->value }}%
                                    @else
                                        ${{ number_format($coupon->value, 2) }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary);">
                                    {{ $coupon->usage_count }} / {{ $coupon->usage_limit ?? '∞' }}
                                </div>
                                <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted);">Used / limit</div>
                            </td>
                            <td>
                                @if($coupon->expires_at)
                                    <div style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary);">{{ $coupon->expires_at->format('Y-m-d') }}</div>
                                @else
                                    <span style="font-family: var(--font-display); color: var(--xai-text-muted); font-size: 12px;">No expiry</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->is_active)
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--atlas-success); color: var(--atlas-success);">Active</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-border-strong); color: var(--xai-text-secondary);">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn-xai-secondary" style="padding: 6px 12px; font-size: 12px;" title="Edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.coupons.toggle-active', $coupon) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-xai-secondary" style="padding: 6px 12px; font-size: 12px;" title="{{ $coupon->is_active ? 'Deactivate' : 'Activate' }}">
                                            {{ $coupon->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this coupon code?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-xai-secondary" style="padding: 6px 12px; font-size: 12px; border-color: #ef4444; color: #ef4444;" title="Delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <div style="font-family: var(--font-display); font-size: 12px;">No coupons found</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($coupons->hasPages())
        <div class="p-4 border-top" style="border-color: var(--xai-border) !important;">
            <div class="d-flex justify-content-center">
                {{ $coupons->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
@endsection
