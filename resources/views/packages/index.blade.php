@extends('layouts.app')

@section('title', 'Plans & Pricing - 4khdiptv')

@section('content')

<!-- Packages Hero -->
<section class="portal-hero" style="padding-bottom: 40px;">
    <div class="parallax-bg">
        <div class="blob" style="width: 500px; height: 500px; background: var(--accent-vibrant); top: -100px; right: 0; opacity: 0.1;"></div>
        <div class="blob" style="width: 300px; height: 300px; background: var(--accent-secondary); bottom: 0; left: 10%; opacity: 0.1;"></div>
    </div>
    
    <div class="container">
        <div data-aos="zoom-out">
            <h1 class="title-display">CHOOSE YOUR <br> <span class="text-vibrant">PLAN.</span></h1>
            


            <p style="color: var(--text-low); font-size: 22px; max-width: 650px; margin: 0 auto; line-height: 1.6;">Clear pricing. Full channel access. Pick how long you want to watch.</p>
        </div>

        <!-- Ultra Modern Filter Bar -->
        <div style="margin-top: 60px; display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;" data-aos="fade-up">
            @php
                $isRenew = request('renew') == '1';
                $renewHref = auth()->check()
                    ? route('profile')
                    : route('login');
                $filters = [
                    ['id' => 'all', 'label' => 'All Plans'],
                    ['id' => 'free', 'label' => 'Free Trial'],
                    ['id' => '1_month', 'label' => '1 Month'],
                    ['id' => '3_months', 'label' => '3 Months'],
                    ['id' => '6_months', 'label' => '6 Months'],
                    ['id' => '12_months', 'label' => '12 Months'],
                    ['id' => 'lifetime', 'label' => 'Lifetime'],
                ];
            @endphp
            <a href="{{ $renewHref }}" class="filter-pill filter-pill-renew {{ $isRenew ? 'active' : '' }}">
                <i class="ph-bold ph-arrows-clockwise"></i> Renew
            </a>
            @foreach($filters as $filter)
                <button class="filter-pill {{ !$isRenew && $filter['id'] == 'all' ? 'active' : '' }}" onclick="filterPackages('{{ $filter['id'] }}', this)">
                    {{ $filter['label'] }}
                </button>
            @endforeach
        </div>

        @if($isRenew)
        <div class="renew-banner" data-aos="fade-up">
            <div class="renew-banner-icon"><i class="ph-bold ph-arrows-clockwise"></i></div>
            <div>
                <strong>Renew your plan</strong>
                <p>Already a customer? Choose a plan below to renew, or open your account to renew an existing subscription.</p>
            </div>
            @auth
                <a href="{{ route('profile') }}" class="btn-portal btn-portal-outline renew-banner-cta">My Account</a>
            @else
                <a href="{{ route('login') }}" class="btn-portal btn-portal-outline renew-banner-cta">Sign In to Renew</a>
            @endauth
        </div>
        @endif
    </div>
</section>

<!-- Passes Grid -->
<section style="padding-bottom: 140px;">
    <div class="container">
        <div id="packages-grid" class="pricing-grid">
            @foreach($packagesByDuration['all'] as $package)
            <div id="package-{{ $package->id }}" 
                 class="stream-card package-item {{ $package->is_popular ? 'is-premium' : '' }}" 
                 data-duration="{{ 
                    $package->price == 0 ? 'free' : (
                    str_contains(strtolower($package->duration_label), 'lifetime') ? 'lifetime' : (
                    str_contains(strtolower($package->duration_label), '1 month') ? '1_month' : 
                    (str_contains(strtolower($package->duration_label), '3 month') ? '3_months' : 
                    (str_contains(strtolower($package->duration_label), '6 month') ? '6_months' : 
                    (str_contains(strtolower($package->duration_label), '12 month') || str_contains(strtolower($package->duration_label), '1 year') ? '12_months' : 'other')))))
                 }}"
                 data-aos="fade-up" 
                 data-aos-delay="{{ $loop->index * 50 }}">
                
                @if($package->is_popular)
                <div class="card-badge-glow">MOST POPULAR</div>
                @endif
                
                <h3 class="package-name">{{ $package->name }}</h3>
                <div class="tier-label">{{ $package->duration_label }} Plan</div>
                
                <div class="card-price-wrap">
                    <span class="currency">$</span>
                    <span class="amount">{{ number_format($package->price, 2) }}</span>
                </div>

                <div class="package-features">
                    <div class="feature-item">
                        <i class="ph-bold ph-check"></i> 20,000+ Live Channels
                    </div>
                    <div class="feature-item">
                        <i class="ph-bold ph-check"></i> HD & 4K Quality
                    </div>
                    <div class="feature-item">
                        <i class="ph-bold ph-shield-check"></i> Stable & Reliable
                    </div>
                </div>

                <div class="card-action">
                    @include('partials.package-pay-buttons', ['package' => $package])
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .filter-pill {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: var(--text-low);
        padding: 12px 32px;
        border-radius: 99px;
        font-family: var(--font-display);
        font-weight: 800;
        font-style: normal;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        font-size: 14px;
        letter-spacing: 1px;
    }

    .filter-pill:hover {
        background: rgba(255, 255, 255, 0.06);
        color: white;
    }

    .filter-pill.active {
        background: var(--accent-glow);
        color: white;
        border-color: transparent;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
    }

    a.filter-pill {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .filter-pill-renew {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.18), rgba(124, 58, 237, 0.18));
        border-color: rgba(16, 185, 129, 0.45);
        color: #6ee7b7;
    }

    .filter-pill-renew.active,
    .filter-pill-renew:hover {
        background: linear-gradient(135deg, #10b981, #7c3aed);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.25);
    }

    .renew-banner {
        margin: 28px auto 0;
        max-width: 920px;
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        padding: 18px 22px;
        border-radius: 18px;
        background: rgba(16, 185, 129, 0.08);
        border: 1px solid rgba(16, 185, 129, 0.28);
        color: #e2e8f0;
    }
    .renew-banner-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: rgba(16, 185, 129, 0.2);
        color: #6ee7b7;
        font-size: 20px;
        flex-shrink: 0;
    }
    .renew-banner strong { display: block; color: #fff; font-size: 16px; margin-bottom: 4px; }
    .renew-banner p { margin: 0; color: #94a3b8; font-size: 14px; line-height: 1.5; }
    .renew-banner-cta { margin-left: auto; white-space: nowrap; }
    @media (max-width: 640px) {
        .renew-banner-cta { width: 100%; margin-left: 0; text-align: center; justify-content: center; }
    }
</style>
@endpush

@push('scripts')
<script>
    function filterPackages(duration, btn) {
        // Update Active Button
        document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Filter Grid
        const cards = document.querySelectorAll('.package-item');
        cards.forEach(card => {
            if (duration === 'all' || card.getAttribute('data-duration') === duration) {
                card.style.display = 'block';
                setTimeout(() => { card.style.opacity = '1'; card.style.transform = 'scale(1)'; }, 10);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => { card.style.display = 'none'; }, 300);
            }
        });
    }
</script>
@endpush
