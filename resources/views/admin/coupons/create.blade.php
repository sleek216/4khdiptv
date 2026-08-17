@extends('admin.layouts.app')

@section('title', 'Create Promo Code')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Create promo code</h1>
        <p class="xai-subheading">Add a new discount code for customers.</p>
    </div>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Coupon details</h2>

                    <div class="mb-4">
                        <label class="xai-label">Coupon code</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-hash" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="@error('code') is-invalid @enderror"
                                name="code" value="{{ old('code') }}" required placeholder="SAVE20">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">Letters and numbers only.</div>
                        @error('code')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 12px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="xai-label">Discount type</label>
                            <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                                <select class="w-100" name="type" required style="background: transparent; border: none; color: var(--xai-text-primary); outline: none; appearance: none; cursor: pointer; font-family: var(--font-display); font-size: 13px;">
                                    <option value="percentage" {{ old('type') === 'percentage' ? 'selected' : '' }} style="background: var(--xai-bg);">Percentage (%)</option>
                                    <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }} style="background: var(--xai-bg);">Fixed amount ($)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">Discount value</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-chart-pie" style="color: var(--xai-text-muted);"></i>
                                <input type="number" step="0.01" class="@error('value') is-invalid @enderror"
                                    name="value" value="{{ old('value') }}" required placeholder="20">
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="xai-label">Usage limit</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-users-three" style="color: var(--xai-text-muted);"></i>
                                <input type="number" class="@error('usage_limit') is-invalid @enderror"
                                    name="usage_limit" value="{{ old('usage_limit') }}" placeholder="Leave blank for unlimited">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">Expiry date</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-calendar-x" style="color: var(--xai-text-muted);"></i>
                                <input type="date" class="@error('expires_at') is-invalid @enderror"
                                    name="expires_at" value="{{ old('expires_at') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Settings</h2>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="accent-color: var(--atlas-teal); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_active" style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary); cursor: pointer;">Active</label>
                    </div>
                </div>

                <div class="xai-card-dark p-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Actions</h2>
                    <button type="submit" class="btn-xai-primary w-100 py-3 mb-3 justify-content-center">
                        <span>Create coupon</span>
                    </button>
                    <a href="{{ route('admin.coupons.index') }}" class="btn-xai-secondary w-100 py-3 justify-content-center" style="text-decoration: none;">
                        <span>Cancel</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
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
