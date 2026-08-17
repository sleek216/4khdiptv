@extends('layouts.app')

@section('title', $package->name . ' - ' . $package->duration_label . ' - 4khdiptv')

@section('content')
<!-- Package Detail Hero -->
<section class="package-hero">
    <div class="hero-bg">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
    </div>
    <div class="container">
        <div class="package-hero-content">
            <a href="{{ route('packages.index') }}" class="back-link" data-aos="fade-right">
                <i class="ph ph-arrow-left"></i>
                Back to Options
            </a>
            
            <div class="package-header" data-aos="fade-up">
                @if($package->is_featured)
                <span class="popular-tag">
                    <i class="ph-fill ph-star"></i> Editor's Pick
                </span>
                @endif
                <h1 class="package-title">{{ $package->name }}</h1>
                <p class="package-duration">{{ $package->duration_label }} Access</p>
                
                <div class="package-price-box">
                    @if($package->original_price)
                    <span class="original-price">${{ number_format($package->original_price, 2) }}</span>
                    @endif
                    <span class="current-price">${{ number_format($package->price, 2) }}</span>
                    @if($package->original_price)
                    <span class="save-badge">Save {{ round((($package->original_price - $package->price) / $package->original_price) * 100) }}%</span>
                    @endif
                </div>
                
                <p class="package-description">{{ $package->description }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Package Details -->
<section class="package-details-section">
    <div class="container">
        <div class="package-grid">
            <!-- Left Column - Features -->
            <div class="features-column" data-aos="fade-right">
                <div class="detail-card">
                    <h3 class="card-title">
                        <i class="ph-fill ph-check-circle"></i>
                        Included Features
                    </h3>
                    
                    <ul class="features-list">
                        @foreach(json_decode($package->features_list ?? '[]') as $feature)
                        <li>
                            <i class="ph-fill ph-check-circle"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="detail-card">
                    <h3 class="card-title">
                        <i class="ph-fill ph-devices"></i>
                        Supported Devices
                    </h3>
                    
                    <div class="devices-grid">
                        <div class="device-item">
                            <i class="ph ph-television"></i>
                            <span>Smart TV</span>
                        </div>
                        <div class="device-item">
                            <i class="ph ph-device-mobile"></i>
                            <span>Android</span>
                        </div>
                        <div class="device-item">
                            <i class="ph ph-apple-logo"></i>
                            <span>iOS</span>
                        </div>
                        <div class="device-item">
                            <i class="ph ph-desktop"></i>
                            <span>Windows</span>
                        </div>
                        <div class="device-item">
                            <i class="ph ph-flame"></i>
                            <span>Firestick</span>
                        </div>
                        <div class="device-item">
                            <i class="ph ph-game-controller"></i>
                            <span>MAG Box</span>
                        </div>
                    </div>
                </div>
                
                <div class="detail-card">
                    <h3 class="card-title">
                        <i class="ph-fill ph-shield-check"></i>
                        Our Guarantees
                    </h3>
                    
                    <div class="guarantee-items">
                        <div class="guarantee-item">
                            <div class="guarantee-icon">
                                <i class="ph-fill ph-arrow-counter-clockwise"></i>
                            </div>
                            <div>
                                <h4>24-Hour Refund Window</h4>
                                <p>Not satisfied? Request a full refund within 24 hours</p>
                            </div>
                        </div>
                        <div class="guarantee-item">
                            <div class="guarantee-icon">
                                <i class="ph-fill ph-lightning"></i>
                            </div>
                            <div>
                                <h4>Instant Activation</h4>
                                <p>Start watching within minutes of purchase</p>
                            </div>
                        </div>
                        <div class="guarantee-item">
                            <div class="guarantee-icon">
                                <i class="ph-fill ph-headset"></i>
                            </div>
                            <div>
                                <h4>Always-On Support</h4>
                                <p>Our team is here whenever you need help</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Order Summary -->
            <div class="order-column" data-aos="fade-left">
                <div class="order-card sticky">
                    <h3 class="order-title">Purchase Summary</h3>
                    
                    <div class="order-package">
                        <div class="package-icon">
                            <i class="ph-fill ph-television"></i>
                        </div>
                        <div class="package-info">
                            <h4>{{ $package->name }}</h4>
                            <span>{{ $package->duration_label }} • {{ $package->connections }} {{ $package->connections > 1 ? 'Connections' : 'Connection' }}</span>
                        </div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-row">
                            <span>Plan Price</span>
                            <span>${{ number_format($package->price, 2) }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Connections</span>
                            <span>{{ $package->connections }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Duration</span>
                            <span>{{ $package->duration_label }}</span>
                        </div>
                        @if($package->original_price)
                        <div class="detail-row savings">
                            <span>You Save</span>
                            <span>-${{ number_format($package->original_price - $package->price, 2) }}</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="order-total">
                        <span>Total</span>
                        <span>${{ number_format($package->price, 2) }}</span>
                    </div>
                    
                    @php
                        $isTrialPkg = (float) $package->price <= 0
                            || str_contains(strtolower($package->name ?? ''), 'trial')
                            || str_contains(strtolower($package->duration_label ?? ''), 'trial');
                    @endphp
                    @if($isTrialPkg)
                        <a href="{{ route('checkout.show', $package->slug) }}" class="btn btn-primary btn-lg btn-block">
                            <i class="ph ph-play"></i>
                            Start Free Trial
                        </a>
                    @else
                        <div class="d-grid gap-2">
                            <a href="{{ route('checkout.show', $package->slug) }}?pay=card" class="btn btn-primary btn-lg btn-block">
                                <i class="ph ph-credit-card"></i>
                                Buy with Card
                            </a>
                            <a href="{{ route('checkout.show', $package->slug) }}?pay=crypto" class="btn btn-outline-primary btn-lg btn-block">
                                <i class="ph ph-currency-btc"></i>
                                Buy with Crypto
                            </a>
                        </div>
                    @endif
                    
                    <div class="secure-checkout">
                        <i class="ph-fill ph-lock"></i>
                        <span>SSL-secured payment</span>
                    </div>
                    
                    <div class="payment-methods">
                        <img src="https://cdn.jsdelivr.net/gh/lipis/flag-icons@main/flags/4x3/paypal.svg" alt="PayPal" style="height: 20px; filter: grayscale(1);">
                        <span style="font-weight: 600; color: var(--gray-500); font-size: 0.75rem;">PayPal</span>
                        <span style="font-weight: 600; color: var(--gray-500); font-size: 0.75rem;">Stripe</span>
                        <span style="font-weight: 600; color: var(--gray-500); font-size: 0.75rem;">Crypto</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Packages -->
<section class="related-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">More Plans to Explore</h2>
        
        <div class="related-grid">
            @foreach($relatedPackages ?? [] as $related)
            <div class="related-card" data-aos="fade-up">
                <div class="card-header">
                    <h4>{{ $related->name }}</h4>
                    <span class="duration">{{ $related->duration_label }}</span>
                </div>
                <div class="card-price">
                    <span class="price">${{ number_format($related->price, 2) }}</span>
                    <span class="connections">{{ $related->connections }} {{ $related->connections > 1 ? 'Connections' : 'Connection' }}</span>
                </div>
                <a href="{{ route('packages.show', $related->slug) }}" class="btn btn-outline btn-sm btn-block">
                    See Plan
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('styles')
<style>
    .package-hero {
        position: relative;
        padding: 180px 0 80px;
        text-align: center;
        overflow: hidden;
    }
    
    .package-hero .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
    }
    
    .package-hero .hero-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #0a0f1a 0%, #0d1525 50%, #0a0f1a 100%);
    }
    
    .package-hero .hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(rgba(0, 102, 255, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.5;
    }
    
    .package-hero-content {
        max-width: 600px;
        margin: 0 auto;
        color: var(--white);
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9375rem;
        margin-bottom: 2rem;
        transition: var(--transition-base);
    }
    
    .back-link:hover {
        color: var(--white);
    }
    
    .package-header {
        position: relative;
    }
    
    .popular-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1rem;
        background: var(--gradient-primary);
        color: var(--white);
        font-size: 0.8125rem;
        font-weight: 600;
        border-radius: var(--radius-full);
        margin-bottom: 1rem;
    }
    
    .package-title {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    
    .package-duration {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
    }
    
    .package-price-box {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .original-price {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.5);
        text-decoration: line-through;
    }
    
    .current-price {
        font-family: var(--font-display);
        font-size: 3.5rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .save-badge {
        padding: 0.375rem 0.75rem;
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: var(--radius-full);
    }
    
    .package-description {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .package-details-section {
        padding: 4rem 0;
        background: var(--gray-50);
    }
    
    .package-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        align-items: start;
    }
    
    .features-column {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .detail-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
    }
    
    .card-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .card-title i {
        color: var(--primary-500);
        font-size: 1.5rem;
    }
    
    .features-list {
        display: grid;
        gap: 1rem;
    }
    
    .features-list li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
        color: var(--gray-700);
    }
    
    .features-list li i {
        color: var(--success-500);
        font-size: 1.25rem;
    }
    
    .devices-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    .device-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        text-align: center;
    }
    
    .device-item i {
        font-size: 1.75rem;
        color: var(--primary-500);
    }
    
    .device-item span {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--gray-700);
    }
    
    .guarantee-items {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }
    
    .guarantee-item {
        display: flex;
        gap: 1rem;
    }
    
    .guarantee-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-50);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .guarantee-icon i {
        font-size: 1.5rem;
        color: var(--primary-500);
    }
    
    .guarantee-item h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .guarantee-item p {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    /* Order Card */
    .order-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--shadow-xl);
        border: 2px solid var(--primary-100);
    }
    
    .order-card.sticky {
        position: sticky;
        top: 120px;
    }
    
    .order-title {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .order-package {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
    }
    
    .package-icon {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.5rem;
    }
    
    .package-info h4 {
        font-weight: 600;
        color: var(--gray-900);
    }
    
    .package-info span {
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    .order-details {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9375rem;
        color: var(--gray-600);
    }
    
    .detail-row.savings {
        color: var(--success-600);
        font-weight: 500;
    }
    
    .order-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
    }
    
    .secure-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    .secure-checkout i {
        color: var(--success-500);
    }
    
    .payment-methods {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--gray-100);
    }
    
    /* Related Section */
    .related-section {
        padding: 4rem 0;
        background: var(--white);
    }
    
    .related-section .section-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .related-card {
        background: var(--gray-50);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        text-align: center;
    }
    
    .related-card .card-header h4 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--gray-900);
    }
    
    .related-card .duration {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    .related-card .card-price {
        margin: 1rem 0;
    }
    
    .related-card .price {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-600);
    }
    
    .related-card .connections {
        display: block;
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    @media (max-width: 1024px) {
        .package-grid {
            grid-template-columns: 1fr;
        }
        
        .order-card.sticky {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .package-hero {
            padding: 140px 0 60px;
        }
        
        .package-title {
            font-size: 2rem;
        }
        
        .current-price {
            font-size: 2.5rem;
        }
        
        .devices-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush
@endsection
