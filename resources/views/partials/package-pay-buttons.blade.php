@php
    $isTrial = (float) $package->price <= 0
        || str_contains(strtolower($package->name ?? ''), 'trial')
        || str_contains(strtolower($package->duration_label ?? ''), 'trial');
@endphp

@if($isTrial)
    <a href="{{ route('checkout.show', $package->slug) }}" class="btn-portal btn-full">
        <span>Start Free Trial</span>
        <i class="ph-bold ph-arrow-right"></i>
    </a>
@else
    <div class="pkg-pay-actions">
        <a href="{{ route('checkout.show', $package->slug) }}?pay=card" class="btn-portal btn-full pkg-pay-card">
            <i class="ph-bold ph-credit-card"></i>
            <span>Buy with Card</span>
        </a>
        <a href="{{ route('checkout.show', $package->slug) }}?pay=crypto" class="btn-portal btn-portal-outline btn-full pkg-pay-crypto">
            <i class="ph-bold ph-currency-btc"></i>
            <span>Buy with Crypto</span>
        </a>
    </div>
@endif

@once
@push('styles')
<style>
.pkg-pay-actions {
    display: grid;
    gap: 10px;
    width: 100%;
}
.pkg-pay-actions .btn-portal {
    justify-content: center;
    text-align: center;
    min-height: 48px;
}
</style>
@endpush
@endonce
