@extends('layouts.app')

@section('title', '4khdiptv - Watch Live TV in 4K')

@section('content')

@php
    $deviceList = [
        ['label' => 'Smart TV', 'icon' => 'ph-bold ph-television'],
        ['label' => 'Fire Stick', 'icon' => 'ph-bold ph-fire'],
        ['label' => 'Android', 'icon' => 'ph-bold ph-android-logo'],
        ['label' => 'iPhone / iPad', 'icon' => 'ph-bold ph-apple-logo'],
        ['label' => 'Windows / Mac', 'icon' => 'ph-bold ph-desktop'],
        ['label' => 'MAG / Formuler', 'icon' => 'ph-bold ph-hard-drives'],
    ];

    $fallbackTestimonials = [
        ['name' => 'James R.', 'location' => 'United Kingdom', 'content' => 'Crystal clear 4K sports and movies. Setup took under 5 minutes on my Fire Stick.', 'rating' => 5],
        ['name' => 'Sofia M.', 'location' => 'Spain', 'content' => 'Stable streams every day. Support replied fast when I needed help with my Smart TV.', 'rating' => 5],
        ['name' => 'Omar K.', 'location' => 'UAE', 'content' => 'Best picture quality I have tried. Works great on phone and TV at the same time.', 'rating' => 5],
        ['name' => 'Emily T.', 'location' => 'USA', 'content' => 'Huge channel list and VOD library. My family switched from cable and never looked back.', 'rating' => 5],
    ];

    $displayTestimonials = ($testimonials ?? collect())->count()
        ? $testimonials
        : collect($fallbackTestimonials)->map(fn ($t) => (object) $t);

    $fallbackFaqs = [
        ['question' => 'What devices can I watch on?', 'answer' => 'Yes. Watch on multiple devices at same time — Smart TV, Fire Stick, phone, tablet, and computer.'],
        ['question' => 'How fast can I start watching?', 'answer' => 'Most customers are streaming within a few minutes. Create an account, pick a plan, and follow the simple setup guide for your device.'],
        ['question' => 'Do you offer HD and 4K channels?', 'answer' => 'Yes. Enjoy thousands of channels in HD and 4K where available, plus a large VOD library of movies and series.'],
        ['question' => 'Is support available if I need help?', 'answer' => 'Yes. Our support team is available 24/7 by email at support@4khdiptv.org and live chat on the website.'],
        ['question' => 'Can I try before I buy?', 'answer' => 'Yes. Start with a free trial (when available) or choose a short plan to test quality, speed, and channel lineup.'],
        ['question' => 'What payment methods do you accept?', 'answer' => 'We accept card and crypto payments at checkout. After payment you receive your subscription details by email.'],
    ];

    $displayFaqs = ($faqs ?? collect())->count()
        ? $faqs
        : collect($fallbackFaqs)->map(fn ($f) => (object) $f);
@endphp

<!-- Maximalist Cinematic Hero with Parallax Animation -->
<section class="portal-hero">
    <div class="parallax-bg">
        <div class="blob" style="width: 600px; height: 600px; background: var(--accent-vibrant); top: -200px; left: -100px; opacity: 0.15;"></div>
        <div class="blob" style="width: 400px; height: 400px; background: var(--accent-secondary); bottom: -100px; right: -50px; opacity: 0.1; animation-delay: -5s;"></div>
    </div>
    
    <div class="container">
        <div data-aos="zoom-out" data-aos-duration="1200">
            <h1 class="title-display">
                WATCH LIVE TV <br>
                <span class="text-vibrant">IN CRYSTAL CLEAR</span> <br>
                4K.
            </h1>
            <p style="font-size: 22px; color: var(--text-low); max-width: 900px; margin: 0 auto 56px; line-height: 1.6; font-weight: 500; letter-spacing: -0.01em;">
                Stream 20,000+ live channels and 100,000+ VOD titles in stunning HD & 4K quality. Enjoy sports, movies, news, and entertainment from 150+ countries on your TV, phone, or tablet. Easy setup. Start streaming in minutes.
            </p>
            
            @php
                $freeTrialPackage = \App\Models\Package::where('price', 0)->first();
                $trialLink = $freeTrialPackage ? route('packages.index') . '#package-' . $freeTrialPackage->id : route('contact', ['subject' => 'Trial']);
            @endphp
            <div class="hero-actions-wrap" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('packages.index') }}" class="btn-portal btn-hero">
                    <span>View Plans</span>
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
                <a href="{{ $trialLink }}" class="btn-portal btn-portal-outline btn-hero">
                    <span>Try Free</span>
                </a>
            </div>

            <div class="brand-logos-strip" data-aos="fade-up" data-aos-delay="320">
                <div class="brand-logos-label">Premium Sports &amp; Entertainment</div>
                <div class="brand-logos-row">
                    <span class="brand-logo-chip hbo">HBO</span>
                    <span class="brand-logo-chip nfl">NFL</span>
                    <span class="brand-logo-chip espn">ESPN</span>
                    <span class="brand-logo-chip netflix">NETFLIX</span>
                    <span class="brand-logo-chip disney">Disney+</span>
                    <span class="brand-logo-chip prime">prime</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- High-Tech Metrics Bridge -->
<section class="metrics-bridge">
    <div class="container">
        <div class="metrics-grid">
            @foreach([
                ['stat' => '20K+', 'label' => 'Channels', 'sub' => 'Worldwide TV', 'icon' => 'ph-bold ph-television-simple'],
                ['stat' => 'Fast', 'label' => 'Streaming', 'sub' => 'Less Buffering', 'icon' => 'ph-bold ph-lightning'],
                ['stat' => '4K', 'label' => 'Quality', 'sub' => 'Ultra HD Picture', 'icon' => 'ph-bold ph-monitor'],
                ['stat' => '24/7', 'label' => 'Support', 'sub' => 'Always Here to Help', 'icon' => 'ph-bold ph-shield-check']
            ] as $s)
            <div class="metric-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="metric-icon">
                    <i class="{{ $s['icon'] }}"></i>
                </div>
                <div class="metric-value">{{ $s['stat'] }}</div>
                <div class="metric-label">{{ $s['label'] }}</div>
                <div class="metric-sub">{{ $s['sub'] }}</div>
                <div class="metric-glow"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Work on All Devices -->
<section class="home-devices-section section-spacer" id="devices">
    <div class="container">
        <div class="home-devices-grid">
            <div class="home-devices-copy" data-aos="fade-right">
                <div class="home-section-badge">Works Everywhere</div>
                <h2 class="title-display portal-title-large">WORK ON <br><span class="text-vibrant">ALL DEVICES.</span></h2>
                <p class="home-section-desc">Watch on multiple devices at same time. Clear 4K picture with a simple setup — no complicated steps.</p>

                <div class="home-device-icons">
                    @foreach($deviceList as $device)
                    <div class="home-device-chip" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                        <div class="home-device-icon"><i class="{{ $device['icon'] }}"></i></div>
                        <span>{{ $device['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="home-devices-visual" data-aos="fade-left">
                <div class="home-devices-frame">
                    <img src="{{ asset('iptv_multi_device_sync_1776669948393.png') }}" alt="4khdiptv on all devices" class="home-devices-img">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Elite Pricing Architecture -->
<section id="pricing" class="pricing-portal">
    <div class="container">
        <div class="section-header-centered" data-aos="zoom-in">
            <h2 class="title-display-mega">CHOOSE YOUR <span class="text-vibrant">PLAN.</span></h2>
            <p class="header-sub-premium">Simple plans with full channel access, fast streaming, and friendly support whenever you need help.</p>
        </div>

        <div class="pricing-grid">
            @foreach($featuredPackages as $package)
            <div class="stream-card {{ $package->is_featured ? 'is-premium' : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($package->is_featured)
                <div class="card-badge-glow">MOST POPULAR</div>
                @endif
                
                <h3 class="package-name">{{ $package->name }}</h3>
                <div class="tier-label">{{ $package->duration_label ? $package->duration_label . ' Plan' : 'Subscription Plan' }}</div>
                
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

<!-- What Our Customers Say -->
<section class="home-testimonials-section section-spacer" id="testimonials">
    <div class="container">
        <div class="section-header-centered" data-aos="zoom-in">
            <div class="home-section-badge">Trusted Worldwide</div>
            <h2 class="title-display-mega">WHAT OUR <span class="text-vibrant">CUSTOMERS SAY.</span></h2>
            <p class="header-sub-premium">Real feedback from people streaming sports, movies, and live TV with 4khdiptv every day.</p>
        </div>

        <div class="home-testimonials-grid">
            @foreach($displayTestimonials as $t)
            <article class="home-testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="home-testimonial-top">
                    <div class="home-testimonial-avatar">
                        @if(!empty($t->avatar))
                            <img src="{{ asset('storage/' . ltrim($t->avatar, '/')) }}" alt="{{ $t->name }}">
                        @else
                            <i class="ph-fill ph-user"></i>
                        @endif
                    </div>
                    <div>
                        <h3 class="home-testimonial-name">{{ $t->name }}</h3>
                        @if(!empty($t->location))
                            <p class="home-testimonial-loc"><i class="ph-bold ph-map-pin"></i> {{ $t->location }}</p>
                        @endif
                    </div>
                    <div class="home-testimonial-quote-icon"><i class="ph-fill ph-quotes"></i></div>
                </div>

                <div class="home-testimonial-stars" aria-label="{{ (int) ($t->rating ?? 5) }} star rating">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="ph-fill ph-star {{ $i <= (int) ($t->rating ?? 5) ? 'is-on' : '' }}"></i>
                    @endfor
                </div>

                <p class="home-testimonial-text">{{ $t->content }}</p>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="home-faq-section section-spacer" id="faq">
    <div class="container">
        <div class="home-faq-layout">
            <div class="home-faq-intro" data-aos="fade-right">
                <div class="home-section-badge">Help Center</div>
                <h2 class="title-display portal-title-large">FREQUENTLY <br><span class="text-vibrant">ASKED QUESTIONS.</span></h2>
                <p class="home-section-desc">Quick answers about devices, setup, payments, and streaming quality.</p>
                <a href="{{ route('faq') }}" class="btn-portal btn-portal-outline">
                    <span>View All FAQs</span>
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>

            <div class="home-faq-list" data-aos="fade-left">
                @foreach($displayFaqs->take(6) as $faq)
                <details class="home-faq-item" {{ $loop->first ? 'open' : '' }}>
                    <summary>
                        <span>{{ $faq->question }}</span>
                        <i class="ph-bold ph-plus"></i>
                    </summary>
                    <div class="home-faq-answer">
                        <p>{{ $faq->answer }}</p>
                    </div>
                </details>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .home-section-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(124, 58, 237, 0.12);
        border: 1px solid rgba(124, 58, 237, 0.28);
        color: #c4b5fd;
        padding: 8px 16px;
        border-radius: 999px;
        font-family: var(--font-display), 'Outfit', sans-serif;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .home-section-desc {
        color: var(--text-low, #94a3b8);
        font-size: 18px;
        line-height: 1.65;
        max-width: 520px;
        margin: 0 0 32px;
    }

    /* Devices */
    .home-devices-section {
        background:
            radial-gradient(ellipse at left, rgba(124, 58, 237, 0.12), transparent 55%),
            linear-gradient(180deg, #020408 0%, #090612 100%);
    }

    .home-devices-grid {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 48px;
        align-items: center;
    }

    .home-device-icons {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .home-device-chip {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease;
    }

    .home-device-chip:hover {
        transform: translateY(-3px);
        border-color: rgba(124, 58, 237, 0.45);
        background: rgba(124, 58, 237, 0.1);
    }

    .home-device-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.35), rgba(219, 39, 119, 0.25));
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .home-devices-frame {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
        background: rgba(255, 255, 255, 0.02);
    }

    .home-devices-frame::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 55%, rgba(2, 4, 8, 0.55) 100%);
        pointer-events: none;
    }

    .home-devices-img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    /* Testimonials */
    .home-testimonials-section {
        background:
            radial-gradient(ellipse at top, rgba(219, 39, 119, 0.1), transparent 50%),
            #020408;
    }

    .home-testimonials-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
        margin-top: 48px;
    }

    .home-testimonial-card {
        padding: 28px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .home-testimonial-card:hover {
        transform: translateY(-4px);
        border-color: rgba(124, 58, 237, 0.4);
    }

    .home-testimonial-top {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 14px;
        align-items: center;
        margin-bottom: 16px;
    }

    .home-testimonial-avatar {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        overflow: hidden;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #7c3aed, #db2777);
        color: #fff;
        font-size: 24px;
    }

    .home-testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .home-testimonial-name {
        margin: 0;
        color: #fff;
        font-size: 17px;
        font-weight: 800;
    }

    .home-testimonial-loc {
        margin: 4px 0 0;
        color: #94a3b8;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .home-testimonial-quote-icon {
        color: rgba(124, 58, 237, 0.7);
        font-size: 28px;
    }

    .home-testimonial-stars {
        display: flex;
        gap: 4px;
        margin-bottom: 14px;
        color: rgba(255, 255, 255, 0.2);
    }

    .home-testimonial-stars .is-on {
        color: #fbbf24;
    }

    .home-testimonial-text {
        margin: 0;
        color: #cbd5e1;
        line-height: 1.7;
        font-size: 15px;
    }

    /* FAQ */
    .home-faq-section {
        background:
            radial-gradient(ellipse at right, rgba(124, 58, 237, 0.12), transparent 50%),
            linear-gradient(180deg, #090612 0%, #020408 100%);
    }

    .home-faq-layout {
        display: grid;
        grid-template-columns: 0.85fr 1.15fr;
        gap: 48px;
        align-items: start;
    }

    .home-faq-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .home-faq-item {
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        overflow: hidden;
    }

    .home-faq-item[open] {
        border-color: rgba(124, 58, 237, 0.4);
        background: rgba(124, 58, 237, 0.08);
    }

    .home-faq-item summary {
        list-style: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 20px 22px;
        color: #fff;
        font-weight: 700;
        font-size: 15px;
    }

    .home-faq-item summary::-webkit-details-marker { display: none; }

    .home-faq-item summary i {
        color: #c4b5fd;
        transition: transform 0.25s ease;
        flex-shrink: 0;
    }

    .home-faq-item[open] summary i {
        transform: rotate(45deg);
    }

    .home-faq-answer {
        padding: 0 22px 20px;
    }

    .home-faq-answer p {
        margin: 0;
        color: #94a3b8;
        line-height: 1.7;
        font-size: 14px;
    }

    @media (max-width: 1024px) {
        .home-devices-grid,
        .home-faq-layout {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        .home-testimonials-grid {
            grid-template-columns: 1fr;
        }
        .home-section-desc { font-size: 16px; max-width: none; }
    }

    @media (max-width: 640px) {
        .home-device-icons { grid-template-columns: 1fr; }
        .home-testimonial-card { padding: 22px 18px; }
        .home-faq-item summary { padding: 16px 18px; font-size: 14px; }
        .home-faq-answer { padding: 0 18px 16px; }
    }
</style>
@endpush
