@extends('layouts.app')

@section('title', 'How It Works - 4khdiptv')

@section('content')

<!-- Cinematic Hero: The Technical Backbone -->
<section class="portal-hero">
    <div class="parallax-bg">
        <div class="blob" style="width: 500px; height: 500px; background: var(--accent-vibrant); top: -100px; right: 0; opacity: 0.1;"></div>
        <div class="blob" style="width: 300px; height: 300px; background: var(--accent-secondary); bottom: 0; left: 10%; opacity: 0.1;"></div>
    </div>
    
    <div class="container">
        <div data-aos="zoom-out" data-aos-duration="1200">
            <div class="portal-badge">Simple Steps</div>
            <h1 class="title-display">
                HOW IT <span class="text-vibrant">WORKS.</span>
            </h1>
            <p style="font-size: 22px; color: var(--text-low); max-width: 750px; margin: 0 auto; line-height: 1.6;">
                Getting started is easy. Follow these 5 simple steps and start watching in about 5 minutes.
            </p>
        </div>
    </div>
</section>

<!-- The Deployment Path: Vertical Process -->
<section class="process-gateway" style="padding: 100px 0; position: relative; overflow: hidden; background: #020408;">
    <div class="container">
        <div class="deployment-timeline">
            
            <!-- Phase 01 -->
            <div class="deploy-node" data-aos="fade-up">
                <div class="node-numeric">01</div>
                <div class="node-glass">
                    <div class="node-icon-box">
                        <i class="ph-bold ph-sketch-logo"></i>
                    </div>
                    <div class="node-info">
                        <h3>Pick a Plan</h3>
                        <p>Choose how long you want access — from a free trial to 1, 3, 6, or 12 months.</p>
                        <div class="node-links">
                            <a href="{{ route('packages.index') }}">View Plans <i class="ph-bold ph-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phase 02 -->
            <div class="deploy-node" data-aos="fade-up">
                <div class="node-numeric">02</div>
                <div class="node-glass">
                    <div class="node-icon-box">
                        <i class="ph-bold ph-lock-keyhole"></i>
                    </div>
                    <div class="node-info">
                        <h3>Complete Payment</h3>
                        <p>Pay safely with card, PayPal, or crypto. Your order is protected and private.</p>
                    </div>
                </div>
            </div>

            <!-- Phase 03 -->
            <div class="deploy-node" data-aos="fade-up">
                <div class="node-numeric">03</div>
                <div class="node-glass">
                    <div class="node-icon-box">
                        <i class="ph-bold ph-broadcast"></i>
                    </div>
                    <div class="node-info">
                        <h3>Get Your Login Details</h3>
                        <p>We email your login info right away — usually within a minute after payment.</p>
                    </div>
                </div>
            </div>

            <!-- Phase 04 -->
            <div class="deploy-node" data-aos="fade-up">
                <div class="node-numeric">04</div>
                <div class="node-glass">
                    <div class="node-icon-box">
                        <i class="ph-bold ph-device-mobile-camera"></i>
                    </div>
                    <div class="node-info">
                        <h3>Open an IPTV App</h3>
                        <p>Install a free player like IPTV Smarters, TiviMate, or IBO Player. Enter the details from your email.</p>
                    </div>
                </div>
            </div>

            <!-- Phase 05 -->
            <div class="deploy-node" data-aos="fade-up">
                <div class="node-numeric">05</div>
                <div class="node-glass">
                    <div class="node-icon-box">
                        <i class="ph-bold ph-television-simple"></i>
                    </div>
                    <div class="node-info">
                        <h3>Start Watching</h3>
                        <p>Enjoy 20,000+ live channels plus movies and series — in HD and 4K.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Device Ecosystem: Cinematic Grid -->
<section style="padding: 140px 0; background: #000;">
    <div class="container">
        <div class="section-header-centered" data-aos="fade-up">
             <h2 class="title-display">ANY DEVICE. <br><span class="text-vibrant">ANYWHERE.</span></h2>
             <p class="header-sub-premium">Watch on multiple devices at same time — Smart TVs, Fire Stick, phones, tablets, and computers.</p>
        </div>

        <div class="support-grid">
            @foreach([
                ['tag' => 'SMART TV', 'icon' => 'ph-bold ph-television', 'desc' => 'Samsung, LG, Android TV, Sony'],
                ['tag' => 'FIRE STICK', 'icon' => 'ph-bold ph-flame', 'desc' => 'Amazon Fire TV, Cube, Lite'],
                ['tag' => 'MOBILE', 'icon' => 'ph-bold ph-device-mobile', 'desc' => 'iOS, Android, Tablets'],
                ['tag' => 'PC / MAC', 'icon' => 'ph-bold ph-desktop', 'desc' => 'Web Player, VLC, Smarters PC'],
                ['tag' => 'MAG BOX', 'icon' => 'ph-bold ph-cpu', 'desc' => 'MAG 250, 254, 322, 522'],
                ['tag' => 'GAMING', 'icon' => 'ph-bold ph-game-controller', 'desc' => 'Xbox, PlayStation via Apps']
            ] as $d)
            <div class="support-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="support-icon"><i class="{{ $d['icon'] }}"></i></div>
                <h4 class="support-title">{{ $d['tag'] }}</h4>
                <p class="support-desc">{{ $d['desc'] }}</p>
                <div class="support-glow"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Minimal FAQ Integration -->
<section style="padding: 100px 0; background: #020408; border-top: 1px solid rgba(255,255,255,0.03);">
    <div class="container" style="max-width: 800px;">
        <div class="section-header-centered" style="margin-bottom: 60px;">
             <h3 class="title-display" style="font-size: 48px;">COMMON <span class="text-vibrant">QUESTIONS.</span></h3>
        </div>

        <div class="glass-accordion">
            @foreach([
                ['q' => 'How fast do I get access?', 'a' => 'Right after payment, we send your login details by email — usually in under a minute.'],
                ['q' => 'What internet speed do I need?', 'a' => 'For smooth 4K, about 25 Mbps is best. HD works fine with around 10 Mbps.'],
                ['q' => 'Can I use it on more than one device?', 'a' => 'Yes. Watch on multiple devices at same time.']
            ] as $faq)
            <div class="glass-faq-item" data-aos="fade-up">
                <details>
                    <summary>
                        <span>{{ $faq['q'] }}</span>
                        <i class="ph-bold ph-plus"></i>
                    </summary>
                    <div class="faq-body">
                        {{ $faq['a'] }}
                    </div>
                </details>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Technical Deployment Timeline */
    .deployment-timeline {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
    }

    .deployment-timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 40px;
        bottom: 40px;
        width: 1px;
        background: linear-gradient(to bottom, transparent, var(--accent-vibrant), var(--accent-secondary), transparent);
        opacity: 0.3;
    }

    .deploy-node {
        display: flex;
        gap: 50px;
        margin-bottom: 60px;
        position: relative;
    }

    .node-numeric {
        width: 60px;
        height: 60px;
        background: var(--bg-void);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-weight: 950;
        font-size: 20px;
        color: var(--text-vibrant);
        flex-shrink: 0;
        z-index: 2;
        box-shadow: 0 0 20px rgba(124, 58, 237, 0.2);
    }

    .node-glass {
        flex: 1;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 30px;
        display: flex;
        gap: 30px;
        transition: all 0.4s ease;
    }

    .node-glass:hover {
        background: rgba(255,255,255,0.05);
        border-color: var(--accent-vibrant);
        transform: translateX(10px);
    }

    .node-icon-box {
        width: 64px;
        height: 64px;
        background: rgba(124, 58, 237, 0.1);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-vibrant);
        font-size: 28px;
        flex-shrink: 0;
    }

    .node-info h3 {
        font-family: var(--font-display);
        font-size: 28px;
        font-weight: 900;
        color: white;
        margin-bottom: 15px;
    }

    .node-info p {
        color: var(--text-low);
        font-size: 16px;
        line-height: 1.6;
    }

    .node-links {
        margin-top: 20px;
    }

    .node-links a {
        color: var(--accent-vibrant);
        text-decoration: none;
        font-weight: 800;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Support Grid */
    .support-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 80px;
    }

    .support-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 30px;
        padding: 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .support-card:hover {
        background: rgba(255,255,255,0.06);
        border-color: var(--accent-secondary);
        transform: translateY(-10px);
    }

    .support-icon {
        font-size: 48px;
        color: var(--accent-vibrant);
        margin-bottom: 20px;
    }

    .support-title {
        font-family: var(--font-display);
        font-weight: 950;
        color: white;
        font-size: 20px;
        margin-bottom: 10px;
        letter-spacing: 2px;
    }

    .support-desc {
        color: var(--text-low);
        font-size: 14px;
        font-weight: 600;
    }

    /* Glass Accordion */
    .glass-faq-item {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 20px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 25px 30px;
        cursor: pointer;
        list-style: none;
        font-weight: 800;
        color: white;
        transition: all 0.3s;
    }

    summary::-webkit-details-marker { display: none; }

    summary:hover { background: rgba(255,255,255,0.03); }

    .faq-body {
        padding: 0 30px 25px;
        color: var(--text-low);
        line-height: 1.6;
        font-size: 15px;
    }

    details[open] summary {
        color: var(--accent-vibrant);
    }

    details[open] i {
        transform: rotate(45deg);
        color: var(--accent-vibrant);
    }

    @media (max-width: 768px) {
        .deployment-timeline::before { left: 20px; }
        .node-numeric { width: 40px; height: 40px; font-size: 14px; }
        .deploy-node { gap: 20px; }
        .node-glass { padding: 25px; flex-direction: column; gap: 20px; }
    }
</style>
@endpush
