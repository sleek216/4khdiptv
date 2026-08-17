@extends('layouts.app')

@section('title', 'Channel List - 4khdiptv')
@section('content')

    <!-- Channels Hero with Parallax Animation -->
    <section class="portal-hero">
        <div class="parallax-bg">
            <div class="blob"
                style="width: 500px; height: 500px; background: var(--accent-vibrant); top: -100px; left: 0; opacity: 0.15;">
            </div>
            <div class="blob"
                style="width: 400px; height: 400px; background: var(--accent-secondary); bottom: -100px; right: 20%; opacity: 0.1;">
            </div>
        </div>

        <div class="container">
            <div data-aos="zoom-out">
                <h1 class="title-display">
                    OUR <br>
                    <span class="text-vibrant">CHANNEL</span> <br>
                    LIST.
                </h1>



                <p
                    style="font-size: 22px; color: var(--text-low); max-width: 800px; margin: 0 auto 56px; line-height: 1.6; font-weight: 500;">
                    Browse channels from 150+ countries — news, sports, movies, and more. Search below to find what you want to watch.
                </p>

                <div class="search-box large"
                    style="max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 20px 32px; border-radius: 99px; display: flex; align-items: center; gap: 16px;">
                    <i class="ph-bold ph-magnifying-glass" style="color: var(--accent-vibrant); font-size: 24px;"></i>
                    <input type="text" id="channelSearch" placeholder="Search for a channel..."
                        style="background: transparent; border: none; outline: none; color: white; width: 100%; font-family: var(--font-display); font-weight: 800; font-style: italic; font-size: 18px; letter-spacing: 1px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Signal Categories (Elite Command Center Design) -->
    <section style="padding: 100px 0; background: #04060b; position: relative;">
        <div class="container">
            <div class="elite-channel-grid">
                @php
                    $portalCategories = [
                        ['name' => 'Sports Networks', 'icon' => 'soccer-ball', 'count' => '2,500+', 'desc' => 'Premier League, NFL, NBA, UFC, and PPV Events.', 'color' => '#10b981', 'glow' => 'rgba(16, 185, 129, 0.2)'],
                        ['name' => 'Cinema & VOD', 'icon' => 'film-slate', 'count' => '100k+', 'desc' => 'Latest Blockbusters & Binge-worthy Series.', 'color' => '#8b5cf6', 'glow' => 'rgba(139, 92, 246, 0.2)'],
                        ['name' => 'Global News', 'icon' => 'newspaper', 'count' => '800+', 'desc' => '24/7 Live Coverage from CNN, BBC, BBC Sky.', 'color' => '#ef4444', 'glow' => 'rgba(239, 68, 68, 0.2)'],
                        ['name' => 'Entertainment', 'icon' => 'star', 'count' => '5,000+', 'desc' => 'Reality TV, Music, and Lifestyle Hubs.', 'color' => '#f59e0b', 'glow' => 'rgba(245, 158, 11, 0.2)'],
                        ['name' => 'Kids & Family', 'icon' => 'baby', 'count' => '1,000+', 'desc' => 'Disney, Nick, and Educational Signals.', 'color' => '#ec4899', 'glow' => 'rgba(236, 72, 153, 0.2)'],
                        ['name' => 'Discoveries', 'icon' => 'globe-hemisphere-west', 'count' => '600+', 'desc' => 'History, Science, and Nature Networks.', 'color' => '#0ea5e9', 'glow' => 'rgba(14, 165, 233, 0.2)']
                    ];
                @endphp

                @foreach($portalCategories as $cat)
                    <div class="elite-stream-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="card-glow"
                            style="background: radial-gradient(circle at top right, {{ $cat['glow'] }}, transparent 70%);">
                        </div>

                        <div class="card-header-elite">
                            <div class="icon-portal-wrap" style="--portal-color: {{ $cat['color'] }}">
                                <i class="ph-fill ph-{{ $cat['icon'] }}"></i>
                                <div class="icon-bloom"></div>
                            </div>
                            <div class="status-indicator">
                                <div class="pulse-dot" style="background: {{ $cat['color'] }}"></div>
                                <span>SIGNAL_LIVE</span>
                            </div>
                        </div>

                        <div class="card-body-elite">
                            <h3 class="category-title">{{ $cat['name'] }}</h3>
                            <div class="signal-count-wrap">
                                <span class="count-val">{{ $cat['count'] }}</span>
                                <span class="count-label">STREAMS DEPLOYED</span>
                            </div>
                            <p class="category-description">{{ $cat['desc'] }}</p>
                        </div>

                        <div class="card-footer-elite">
                            <div class="tech-specs">
                                <div class="spec-tag"><span>4K_ULTRA</span></div>
                                <div class="spec-tag"><span>LOW_LATENCY</span></div>
                                <div class="spec-tag"><span>RAW_FEED</span></div>
                            </div>
                            <div class="action-trigger">
                                <i class="ph-bold ph-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .elite-channel-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
                gap: 40px;
            }

            .elite-stream-card {
                background: rgba(13, 17, 24, 0.7);
                backdrop-filter: blur(30px) saturate(180%);
                -webkit-backdrop-filter: blur(30px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 36px;
                padding: 40px;
                position: relative;
                overflow: hidden;
                transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                min-height: 480px;
                border-top: 1px solid rgba(255, 255, 255, 0.08);
            }

            .card-glow {
                position: absolute;
                inset: 0;
                pointer-events: none;
                opacity: 0.3;
                transition: opacity 0.6s ease;
            }

            .elite-stream-card:hover {
                transform: translateY(-20px) scale(1.02);
                background: rgba(18, 24, 34, 0.85);
                border-color: rgba(255, 255, 255, 0.15);
                box-shadow:
                    0 50px 100px -20px rgba(0, 0, 0, 0.9),
                    0 0 40px rgba(124, 58, 237, 0.1);
            }

            .elite-stream-card:hover .card-glow {
                opacity: 0.6;
            }

            .card-header-elite {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 48px;
            }

            .icon-portal-wrap {
                width: 84px;
                height: 84px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                transition: all 0.5s ease;
            }

            .icon-portal-wrap i {
                font-size: 38px;
                color: var(--portal-color);
                position: relative;
                z-index: 2;
                filter: drop-shadow(0 0 15px var(--portal-color));
            }

            .icon-bloom {
                position: absolute;
                inset: 0;
                background: var(--portal-color);
                filter: blur(25px);
                opacity: 0.05;
                border-radius: 24px;
                transition: opacity 0.5s ease;
            }

            .elite-stream-card:hover .icon-portal-wrap {
                transform: rotate(-5deg) scale(1.1);
                border-color: var(--portal-color);
                background: rgba(255, 255, 255, 0.05);
            }

            .elite-stream-card:hover .icon-bloom {
                opacity: 0.3;
            }

            .status-indicator {
                display: flex;
                align-items: center;
                gap: 10px;
                background: rgba(255, 255, 255, 0.03);
                padding: 8px 16px;
                border-radius: 99px;
                border: 1px solid rgba(255, 255, 255, 0.05);
            }

            .status-indicator span {
                font-size: 10px;
                font-weight: 900;
                letter-spacing: 2px;
                color: rgba(255, 255, 255, 0.5);
            }

            .pulse-dot {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                position: relative;
                animation: portal-pulse 2.2s infinite;
            }

            @keyframes portal-pulse {
                0% {
                    transform: scale(1);
                    opacity: 1;
                    box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
                }

                100% {
                    transform: scale(1.2);
                    opacity: 0;
                    box-shadow: 0 0 0 10px transparent;
                }
            }

            .category-title {
                font-family: var(--font-display);
                font-size: 36px;
                font-weight: 900;
                text-transform: uppercase;
                letter-spacing: -1px;
                margin-bottom: 8px;
                line-height: 1;
                background: linear-gradient(to right, #fff, rgba(255, 255, 255, 0.6));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .signal-count-wrap {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 24px;
            }

            .count-val {
                font-family: var(--font-display);
                font-weight: 900;
                color: var(--accent-vibrant);
                font-size: 18px;
            }

            .count-label {
                font-size: 11px;
                font-weight: 800;
                letter-spacing: 2px;
                color: rgba(255, 255, 255, 0.3);
            }

            .category-description {
                color: var(--text-low);
                font-size: 16px;
                line-height: 1.7;
                font-weight: 600;
                margin-bottom: 40px;
            }

            .card-footer-elite {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
                padding-top: 32px;
            }

            .tech-specs {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .spec-tag {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .spec-tag::before {
                content: '';
                width: 12px;
                height: 2px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 2px;
            }

            .spec-tag span {
                font-size: 10px;
                font-weight: 900;
                letter-spacing: 1.5px;
                color: rgba(255, 255, 255, 0.4);
            }

            .action-trigger {
                width: 60px;
                height: 60px;
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                color: white;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }   

            .elite-stream-card:hover .action-trigger {
                background: var(--accent-vibrant);
                border-color: var(--accent-vibrant);
                transform: rotate(-45deg);
                box-shadow: 0 0 30px rgba(124, 58, 237, 0.6);
            }

            @media (max-width: 768px) {
                .elite-channel-grid {
                    grid-template-columns: 1fr;
                }

                .elite-stream-card {
                    min-height: auto;
                }
            }
        </style>
    @endpush


    <!-- Worldwide Signal Coverage (Holographic Node Grid) -->
    <section class="network-node-section">
        <div class="node-matrix-bg"></div>
        <div class="container relative z-10">
            <div class="section-header-modern" data-aos="fade-down">
                <div class="cyber-badge">GLOBAL_CONNECTIVITY_ESTABLISHED</div>
                <h2 class="title-display">COUNCIL OF <br><span class="text-vibrant">NETWORKS.</span></h2>
                <p class="section-subtitle">A decentralized mesh of high-density nodes spanning every core territory.</p>
            </div>

            <div class="node-grid">
                @php
                    $territories = [
                        ['f' => '🇺🇸', 'n' => 'USA', 'c' => '3K+', 'code' => 'US_01'],
                        ['f' => '🇬🇧', 'n' => 'UK', 'c' => '2K+', 'code' => 'GB_04'],
                        ['f' => '🇨🇦', 'n' => 'CANADA', 'c' => '1.5K+', 'code' => 'CA_09'],
                        ['f' => '🇩🇪', 'n' => 'GERMANY', 'c' => '1K+', 'code' => 'DE_02'],
                        ['f' => '🇫🇷', 'n' => 'FRANCE', 'c' => '1K+', 'code' => 'FR_11'],
                        ['f' => '🇪🇸', 'n' => 'SPAIN', 'c' => '800+', 'code' => 'ES_05'],
                        ['f' => '🇮🇹', 'n' => 'ITALY', 'c' => '800+', 'code' => 'IT_07'],
                        ['f' => '🇸🇦', 'n' => 'ARABIA', 'c' => '2K+', 'code' => 'SA_12'],
                        ['f' => '🇮🇳', 'n' => 'INDIA', 'c' => '1.5K+', 'code' => 'IN_03'],
                        ['f' => '🇵🇰', 'n' => 'PAKISTAN', 'c' => '600+', 'code' => 'PK_08'],
                        ['f' => '🇧🇷', 'n' => 'BRAZIL', 'c' => '1K+', 'code' => 'BR_06'],
                        ['f' => '🇹🇷', 'n' => 'TURKEY', 'c' => '800+', 'code' => 'TR_10']
                    ];
                @endphp
                @foreach($territories as $t)
                    <div class="network-node-capsule" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 30 }}">
                        <div class="node-inner">
                            <div class="node-meta">
                                <span class="node-code">{{ $t['code'] }}</span>
                                <div class="node-status">
                                    <div class="dot"></div> ACTIVE
                                </div>
                            </div>
                            <div class="node-main">
                                <div class="flag-circle">{{ $t['f'] }}</div>
                                <div class="node-info">
                                    <h4 class="node-name">{{ $t['n'] }}</h4>
                                    <span class="node-count">{{ $t['c'] }} SIGNALS</span>
                                </div>
                            </div>
                            <div class="node-visual">
                                <div class="signal-bars">
                                    <div class="bar" style="height: 40%"></div>
                                    <div class="bar" style="height: 70%"></div>
                                    <div class="bar" style="height: 100%"></div>
                                    <div class="bar" style="height: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="network-node-capsule more-nodes" data-aos="zoom-in">
                    <div class="node-inner">
                        <div class="more-content">
                            <span class="plus-val">+135</span>
                            <span class="plus-label">GLOBAL_NODES</span>
                        </div>
                        <i class="ph-bold ph-globe-hemisphere-east"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .network-node-section {
                padding: 120px 0 160px;
                background: #020408;
                position: relative;
                overflow: hidden;
            }

            .node-matrix-bg {
                position: absolute;
                inset: 0;
                background-image:
                    radial-gradient(rgba(124, 58, 237, 0.05) 1px, transparent 1px),
                    linear-gradient(to bottom, transparent, rgba(124, 58, 237, 0.02) 50%, transparent);
                background-size: 40px 40px, 100% 100%;
                opacity: 0.5;
            }

            .node-matrix-bg::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(0deg, #020408 0%, transparent 100%);
            }

            .cyber-badge {
                display: inline-block;
                background: rgba(124, 58, 237, 0.1);
                border: 1px solid rgba(124, 58, 237, 0.2);
                color: var(--accent-vibrant);
                padding: 6px 16px;
                border-radius: 6px;
                font-family: var(--font-display);
                font-weight: 800;
                font-size: 11px;
                letter-spacing: 2px;
                margin-bottom: 24px;
                text-transform: uppercase;
            }

            .section-header-modern {
                text-align: center;
                margin-bottom: 100px;
                position: relative;
            }

            .section-subtitle {
                color: var(--text-low);
                font-size: 20px;
                font-weight: 500;
                max-width: 600px;
                margin: 0 auto;
            }

            .node-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 24px;
            }

            .network-node-capsule {
                position: relative;
                transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
                cursor: crosshair;
            }

            .node-inner {
                background: rgba(255, 255, 255, 0.02);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 24px;
                padding: 24px;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                gap: 20px;
                transition: all 0.5s ease;
                position: relative;
                z-index: 1;
                overflow: hidden;
            }

            .node-inner::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(124, 58, 237, 0.1), transparent);
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            .network-node-capsule:hover .node-inner {
                background: rgba(255, 255, 255, 0.04);
                border-color: rgba(124, 58, 237, 0.4);
                transform: translateY(-10px) scale(1.05);
                box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.8), 0 0 30px rgba(124, 58, 237, 0.1);
            }

            .network-node-capsule:hover .node-inner::before {
                opacity: 1;
            }

            .node-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid rgba(255, 255, 255, 0.03);
                padding-bottom: 12px;
            }

            .node-code {
                font-family: var(--font-display);
                font-size: 10px;
                font-weight: 800;
                color: rgba(255, 255, 255, 0.3);
                letter-spacing: 1px;
            }

            .node-status {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 9px;
                font-weight: 900;
                color: #10b981;
                background: rgba(16, 185, 129, 0.1);
                padding: 4px 8px;
                border-radius: 4px;
            }

            .node-status .dot {
                width: 6px;
                height: 6px;
                background: #10b981;
                border-radius: 50%;
                animation: status-pulse 1.5s infinite;
            }

            @keyframes status-pulse {
                0% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.5;
                    transform: scale(1.2);
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .node-main {
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .flag-circle {
                width: 48px;
                height: 48px;
                background: rgba(255, 255, 255, 0.03);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                border: 1px solid rgba(255, 255, 255, 0.08);
            }

            .node-name {
                font-family: var(--font-display);
                font-size: 18px;
                font-weight: 900;
                margin-bottom: 2px;
                color: white;
            }

            .node-count {
                font-size: 11px;
                font-weight: 800;
                color: var(--accent-vibrant);
                letter-spacing: 1px;
            }

            .node-visual {
                display: flex;
                align-items: flex-end;
                height: 24px;
            }

            .signal-bars {
                display: flex;
                align-items: flex-end;
                gap: 4px;
                height: 100%;
            }

            .signal-bars .bar {
                width: 4px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 2px;
                transition: all 0.3s ease;
            }

            .network-node-capsule:hover .bar {
                background: var(--accent-vibrant);
                box-shadow: 0 0 10px var(--accent-vibrant);
            }

            .more-nodes .node-inner {
                background: var(--accent-glow);
                border: none;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            .more-nodes .plus-val {
                font-family: var(--font-display);
                font-size: 32px;
                font-weight: 1000;
                line-height: 1;
                display: block;
            }

            .more-nodes .plus-label {
                font-size: 10px;
                font-weight: 900;
                letter-spacing: 2px;
                opacity: 0.8;
            }

            .more-nodes i {
                font-size: 32px;
                margin-top: 10px;
                opacity: 0.5;
            }

            @media (max-width: 768px) {
                .node-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 480px) {
                .node-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    @endpush


    <!-- Final Transmission Start -->
    <section style="padding: 160px 0;">
        <div class="container" style="text-align: center;" data-aos="zoom-in">
            <h2 class="title-display">READY TO <br><span class="text-vibrant">INITIALIZE?</span></h2>
            <p style="color: var(--text-low); font-size: 20px; max-width: 600px; margin: 0 auto 48px;">Secure your pass now
                and gain immediate access to the global lineup.</p>
            <a href="{{ route('packages.index') }}" class="btn-portal">
                <span>Unlock Catalog</span>
                <i class="ph-bold ph-rocket-launch"></i>
            </a>
        </div>
    </section>

@endsection