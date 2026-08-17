<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="theme-color" content="#0066FF">
    <meta name="description" content="4khdiptv - Premium IPTV Service with 20,000+ Channels, HD & 4K Quality, 99.9% Uptime. Get the ultimate streaming experience worldwide.">
    <meta name="keywords" content="4khdiptv, streaming, live TV, 4K IPTV, HD channels, premium IPTV">
    <meta name="author" content="4khdiptv">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', '4khdiptv - Premium Streaming Service')</title>
    
    <!-- Favicon (site icon — not Laravel default) -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}?v=2">
    
    <!-- Refined Professional Typography (Outfit + Hanken Grotesk) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Hanken+Grotesk:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modern-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unique-animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    
    <!-- Crisp Chat -->
    @php
        $crispId = \App\Models\Setting::get('crisp_website_id');
    @endphp
    @if($crispId)
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="{{ $crispId }}";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    @endif

    @stack('styles')
    <style>
        .btn-login-nebula { position: relative; }
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff3b30;
            color: white;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 4px;
            border-radius: 10px;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--header-bg, #000);
            font-family: 'Hanken Grotesk', sans-serif;
            box-shadow: 0 0 10px rgba(255, 59, 48, 0.5);
        }

        /* Announcement Toast Styles - Refined Premium UI */
        .announcement-toast {
            position: fixed;
            bottom: 40px;
            left: 40px;
            z-index: 10000;
            width: 420px;
            background: linear-gradient(165deg, rgba(20, 22, 28, 0.95) 0%, rgba(10, 11, 14, 0.98) 100%);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 28px;
            padding: 28px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6), inset 0 1px 1px rgba(255, 255, 255, 0.1);
            transform: translateY(150%) scale(0.9);
            opacity: 0;
            transition: all 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
            pointer-events: none;
        }
        .announcement-toast.show {
            transform: translateY(0) scale(1);
            opacity: 1;
            pointer-events: auto;
            animation: toastFloat 6s ease-in-out infinite;
        }
        .announcement-toast::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 30%, rgba(0, 102, 255, 0.08) 0%, transparent 50%);
            pointer-events: none;
            animation: auroraRotate 15s linear infinite;
        }
        .toast-content { display: flex; gap: 24px; position: relative; z-index: 1; }
        .toast-icon-side { flex-shrink: 0; }
        .toast-icon-box {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--accent-vibrant), #0044CC);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 12px 24px rgba(0, 102, 255, 0.4);
            position: relative;
            animation: iconPulse 2.5s ease-in-out infinite;
        }
        .toast-icon-box i {
            animation: iconWobble 4s ease-in-out infinite;
        }
        .toast-icon-box::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 22px;
            border: 1px solid rgba(0, 102, 255, 0.4);
            animation: ringExpand 2.5s ease-out infinite;
        }
        .toast-main-side { flex-grow: 1; padding-top: 2px; }
        .toast-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
        .toast-badge {
            font-family: 'Outfit', sans-serif;
            font-size: 10px;
            font-weight: 800;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: var(--accent-vibrant);
            padding: 4px 12px;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 102, 255, 0.3);
            animation: badgeShimmer 3s linear infinite;
            background-size: 200% 100%;
            background-image: linear-gradient(90deg, var(--accent-vibrant) 0%, #0077FF 50%, var(--accent-vibrant) 100%);
        }
        .toast-main-text {
            color: white;
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 20px;
            font-weight: 600;
            font-family: 'Hanken Grotesk', sans-serif;
            animation: textReveal 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .toast-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            background: rgba(255, 255, 255, 0.05);
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        .toast-cta-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
            animation: buttonShimmer 4s infinite;
        }

        /* Advanced Keyframe Animations */
        @keyframes toastFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes auroraRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes iconPulse {
            0% { box-shadow: 0 12px 24px rgba(0, 102, 255, 0.4); }
            50% { box-shadow: 0 12px 40px rgba(0, 102, 255, 0.7); }
            100% { box-shadow: 0 12px 24px rgba(0, 102, 255, 0.4); }
        }
        @keyframes iconWobble {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        @keyframes ringExpand {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.4); opacity: 0; }
        }
        @keyframes badgeShimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        @keyframes buttonShimmer {
            0% { left: -100%; }
            20% { left: 100%; }
            100% { left: 100%; }
        }
        @keyframes textReveal {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .toast-cta-btn:hover {
            background: white;
            color: black;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .toast-cta-btn i { font-size: 16px; }

        .toast-close-fixed {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.4);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 2;
        }
        .toast-close-fixed:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: rotate(90deg);
        }

        @media (max-width: 576px) {
            .announcement-toast {
                left: 15px;
                right: 15px;
                bottom: 15px;
                width: calc(100% - 30px);
                padding: 20px;
            }
            .toast-icon-box { width: 44px; height: 44px; font-size: 20px; }
            .toast-content { gap: 15px; }
        }

        /* Announcement Launcher */
        .announcement-launcher {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 56px;
            height: 56px;
            background: var(--accent-vibrant);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            z-index: 9999;
            box-shadow: 0 10px 25px rgba(0, 102, 255, 0.4);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 4px solid rgba(255, 255, 255, 0.1);
        }
        .announcement-launcher:hover {
            transform: scale(1.1) rotate(15deg);
            background: #0044CC;
        }
        .announcement-launcher.hidden {
            transform: scale(0) rotate(-45deg);
            opacity: 0;
            pointer-events: none;
        }
        .logo-glow-effect {
            position: absolute;
            width: 45px;
            height: 45px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.4) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(10px);
            z-index: 1;
            animation: logoPulse 3s infinite alternate;
        }
        @keyframes logoPulse {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.5); opacity: 0.8; }
        }
        @media (max-width: 768px) {
            .logo-text-main, .logo-text-accent { font-size: 20px !important; }
            .logo-icon-wrapper img { height: 40px !important; }
        }

        /* Chip reused inside bottom announcement toast */
        .site-announce-chip {
            display: inline-flex;
            align-items: center;
            background: rgba(0,0,0,0.22);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: #fff;
        }

        /* Brand logos strip */
        .brand-logos-strip {
            margin-top: 48px;
            text-align: center;
        }
        .brand-logos-label {
            font-family: 'Outfit', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: 18px;
        }
        .brand-logos-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 18px 28px;
        }
        .brand-logo-chip {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: clamp(16px, 2.4vw, 22px);
            letter-spacing: 1px;
            color: rgba(255,255,255,0.82);
            opacity: 0.85;
            user-select: none;
            filter: grayscale(0.2);
        }
        .brand-logo-chip.hbo { letter-spacing: 4px; }
        .brand-logo-chip.nfl { color: #fff; font-style: italic; }
        .brand-logo-chip.espn { color: #E31837; letter-spacing: 1px; }
        .brand-logo-chip.netflix { color: #E50914; letter-spacing: 2px; }
        .brand-logo-chip.disney { color: #fff; font-weight: 600; letter-spacing: 1px; }
        .brand-logo-chip.prime { color: #00A8E1; }
    </style>
</head>
<body class="antialiased">
    @php
        $announcementEnabled = \App\Models\Setting::get('announcement_enabled', '0');
        $announcementText = \App\Models\Setting::get('announcement_text', '');
        $announcementLink = \App\Models\Setting::get('announcement_link', '');
        $announcementLinkText = \App\Models\Setting::get('announcement_link_text', 'Shop Now');
        $announcementBadge = \App\Models\Setting::get('announcement_badge', 'LIMITED OFFER');
        $announcementHighlight = \App\Models\Setting::get('announcement_highlight', '');
    @endphp

    {{-- Announcement is a bottom floating toast (NOT a top bar) --}}
    @if($announcementEnabled == '1' && $announcementText)
    <div class="announcement-toast" id="announcementToast" role="dialog" aria-label="Announcement">
        <button type="button" class="toast-close-fixed" onclick="dismissAnnouncementToast()" aria-label="Close">
            <i class="ph-bold ph-x"></i>
        </button>
        <div class="toast-content">
            <div class="toast-icon-side">
                <div class="toast-icon-box"><i class="ph-fill ph-megaphone"></i></div>
            </div>
            <div class="toast-main-side">
                <div class="toast-meta">
                    @if($announcementBadge)
                        <span class="toast-badge">{{ $announcementBadge }}</span>
                    @endif
                    @if($announcementHighlight)
                        <span class="site-announce-chip" style="background:rgba(255,255,255,0.12);">{{ $announcementHighlight }}</span>
                    @endif
                </div>
                <div class="toast-main-text">{!! $announcementText !!}</div>
                @if($announcementLink)
                    <a href="{{ $announcementLink }}" class="toast-cta-btn">
                        {{ $announcementLinkText ?: 'Shop Now' }}
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Nebula Glass Floating Header -->
    @php
        $freeTrialPackage = \App\Models\Package::where('price', 0)->first();
        $trialLink = $freeTrialPackage ? route('packages.index') . '#package-' . $freeTrialPackage->id : route('contact', ['subject' => 'Trial']);
    @endphp
    <div class="header-floating-wrapper">
        <header class="header-floating" id="siteHeader">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="floating-logo" style="display: flex; align-items: center; gap: 8px; text-decoration: none;">
                <span class="logo-text-main" style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 900; letter-spacing: -1px; color: #ffffff;">4khd<span class="logo-text-accent" style="color: #7c3aed; filter: drop-shadow(0 0 10px rgba(124, 58, 237, 0.5));">iptv</span></span>
            </a>

            <!-- Nav Hub -->
            <nav class="nav-island">
                <ul class="nav-pills">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('packages.index') }}" class="{{ request()->routeIs('packages.*') ? 'active' : '' }}">Pricing</a></li>
                    <li><a href="{{ route('how-it-works') }}" class="{{ request()->routeIs('how-it-works') ? 'active' : '' }}">How It Works</a></li>
                    <li><a href="{{ route('channels') }}" class="{{ request()->routeIs('channels') ? 'active' : '' }}">Channels</a></li>
                    <li><a href="{{ route('affiliate.info') }}" class="{{ request()->routeIs('affiliate.info') || request()->routeIs('affiliate.*') ? 'active' : '' }}">Affiliate</a></li>
                    <li><a href="{{ route('reseller.index') }}" class="{{ request()->routeIs('reseller.*') ? 'active' : '' }}">Reseller</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
            </nav>

            <!-- Actions -->
            <div class="floating-cluster">
                <a href="{{ $trialLink }}" class="btn-nebula-trial">
                    <i class="ph-bold ph-lightning"></i>
                    <span>Free Trial</span>
                </a>

                <div class="lang-minimal" onclick="toggleLangMenu(event)">
                    <i class="ph-bold ph-translate"></i>
                    <div id="langMenuElite" class="lang-glass-panel">
                         @foreach(['en', 'es', 'fr', 'de', 'pt', 'it', 'ar', 'nl'] as $l)
                         <a href="{{ route('lang.switch', $l) }}">{{ strtoupper($l) }}</a>
                         @endforeach
                    </div>
                </div>

                @auth
                    <a href="{{ route('profile') }}" class="btn-login-nebula" style="font-size: 18px;">
                        <i class="ph-bold ph-user-circle"></i>
                        @if(isset($userUnreadOrdersCount) && $userUnreadOrdersCount > 0)
                            <span class="notification-badge">{{ $userUnreadOrdersCount }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-login-nebula">Sign In</a>
                @endauth

                <!-- Mobile Toggle -->
                <button class="nebula-toggle" id="navToggle">
                    <div class="dots"><span></span><span></span><span></span></div>
                </button>
            </div>
        </header>
    </div>

    <!-- Elite Mobile Overlay -->
    <div class="mobile-overlay" id="mobileNav">
        <div class="overlay-inner">
            <div class="overlay-header">
                <span class="logo-text">4khd<span class="accent">iptv</span></span>
                <button class="close-overlay" id="navClose"><i class="ph-bold ph-x"></i></button>
            </div>
            <ul class="overlay-nav">
                <li style="--d:1"><a href="{{ route('home') }}">Home</a></li>
                <li style="--d:2"><a href="{{ route('packages.index') }}">Pricing</a></li>
                <li style="--d:3"><a href="{{ route('how-it-works') }}">How It Works</a></li>
                <li style="--d:4"><a href="{{ route('channels') }}">Channels</a></li>
                <li style="--d:5"><a href="{{ route('affiliate.info') }}">Affiliate</a></li>
                <li style="--d:6"><a href="{{ route('reseller.index') }}">Reseller</a></li>
                <li style="--d:7"><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <div class="overlay-footer">
                @auth
                    <a href="{{ route('profile') }}" class="btn-nebula-trial" style="width: 100%; justify-content: center; position: relative;">
                        My Account
                        @if(isset($userUnreadOrdersCount) && $userUnreadOrdersCount > 0)
                            <span class="notification-badge" style="top: 50%; right: 20px; transform: translateY(-50%); position: absolute;">{{ $userUnreadOrdersCount }}</span>
                        @endif
                    </a>
                @else
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('login') }}" class="btn-nebula-trial" style="background: rgba(255,255,255,0.1); flex: 1; justify-content: center;">Sign In</a>
                        <a href="{{ route('register') }}" class="btn-nebula-trial" style="flex: 1; justify-content: center;">Create Account</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main -->
    <main class="main" id="main">
        @yield('content')
    </main>

    <!-- Pre-Footer CTA -->
    <section class="pre-footer">
        <div class="container">
            <div class="pre-footer-content" data-aos="zoom-in">
                <div class="cta-badge">Ready to watch?</div>
                <h2 class="cta-title">START STREAMING <span class="text-vibrant">TODAY.</span></h2>
                <p class="cta-desc">Join thousands of happy customers watching live TV in 4K — with less buffering and easy setup.</p>
                <div class="cta-actions">
                    <a href="{{ route('packages.index') }}" class="btn-portal">
                        <span>See Plans</span>
                        <i class="ph-bold ph-lightning"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-portal btn-portal-outline">
                        <span>Contact Support</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mega Footer Marquee -->
    <div class="mega-footer-marquee">
        <div class="mega-marquee-track">
            <span>LIVE TV • HD & 4K • FAST STREAMING • EASY SETUP • 4khdiptv • WATCH ANYWHERE • </span>
            <span>LIVE TV • HD & 4K • FAST STREAMING • EASY SETUP • 4khdiptv • WATCH ANYWHERE • </span>
        </div>
    </div>

    <!-- Cinematic Modern Footer -->
    <footer class="footer-modern">
        <div class="footer-overlay"></div>
        <div class="container">
            <div class="footer-grid-modern">
                <!-- Brand Engine -->
                <div class="footer-col-main">
                    <a href="{{ route('home') }}" class="footer-brand-modern">
                        <span class="brand-text-modern">4khd<span class="text-vibrant">iptv</span></span>
                    </a>
                    <p class="brand-desc-modern">
                        Premium IPTV streaming with HD &amp; 4K channels, fast servers, and 24/7 support.
                    </p>
                    <div class="social-cluster">
                        <a href="#" class="social-node" aria-label="Facebook"><i class="ph-bold ph-facebook-logo"></i></a>
                        <a href="#" class="social-node" aria-label="X"><i class="ph-bold ph-twitter-logo"></i></a>
                        <a href="#" class="social-node" aria-label="Instagram"><i class="ph-bold ph-instagram-logo"></i></a>
                        <a href="{{ route('contact') }}" class="social-node" aria-label="Live Chat"><i class="ph-bold ph-chat-circle-dots"></i></a>
                    </div>
                </div>

                <!-- Navigation Hubs -->
                <div class="footer-col-nav">
                    <h4 class="hub-title">Explore</h4>
                    <ul class="hub-links">
                        <li><a href="{{ route('packages.index') }}">Pricing Plans</a></li>
                        <li><a href="{{ route('channels') }}">Channel List</a></li>
                        <li><a href="{{ route('reseller.index') }}">Reseller Program</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog &amp; News</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-col-nav">
                    <h4 class="hub-title">Help</h4>
                    <ul class="hub-links">
                        <li><a href="{{ route('how-it-works') }}">How It Works</a></li>
                        <li><a href="{{ route('faq') }}">Help Center</a></li>
                        <li><a href="{{ route('contact') }}">Live Support</a></li>
                        <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('packages.index') }}?renew=1">Renew Plan</a></li>
                    </ul>
                </div>

                <!-- Contact Us -->
                @php
                    $footerEmail = 'support@4khdiptv.org';
                    $footerWhatsapp = \App\Models\Setting::get('whatsapp_number');
                    $footerPhoneDisplay = \App\Models\Setting::get('support_phone', $footerWhatsapp ?: '');
                    $crispFooter = \App\Models\Setting::get('crisp_website_id');
                @endphp
                <div class="footer-col-nav footer-col-contact">
                    <h4 class="hub-title">Contact Us</h4>
                    <ul class="footer-contact-list">
                        <li>
                            <a href="mailto:{{ $footerEmail }}" class="footer-contact-row">
                                <span class="footer-contact-icon"><i class="ph-bold ph-envelope-simple"></i></span>
                                <span>{{ $footerEmail }}</span>
                            </a>
                        </li>
                        @if($footerPhoneDisplay)
                        <li>
                            <a href="{{ $footerWhatsapp ? 'https://wa.me/'.preg_replace('/\D+/', '', $footerWhatsapp) : 'tel:'.preg_replace('/\s+/', '', $footerPhoneDisplay) }}" class="footer-contact-row" target="_blank" rel="noopener">
                                <span class="footer-contact-icon"><i class="ph-bold ph-phone"></i></span>
                                <span>{{ $footerPhoneDisplay }}</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            @if($crispFooter)
                            <button type="button" class="footer-contact-row footer-contact-btn" onclick="window.$crisp&&$crisp.push(['do','chat:open'])">
                                <span class="footer-contact-icon"><i class="ph-bold ph-chat-circle-dots"></i></span>
                                <span>Live Chat 24/7</span>
                            </button>
                            @else
                            <a href="{{ route('contact') }}" class="footer-contact-row">
                                <span class="footer-contact-icon"><i class="ph-bold ph-chat-circle-dots"></i></span>
                                <span>Live Chat 24/7</span>
                            </a>
                            @endif
                        </li>
                        <li>
                            <div class="footer-contact-row is-static">
                                <span class="footer-contact-icon"><i class="ph-bold ph-clock"></i></span>
                                <span>24/7 Customer Support</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Global Footer Bottom -->
            <div class="footer-bottom-modern">
                <div class="payment-methods-block">
                    <span class="payment-methods-label">Payment Methods:</span>
                    <div class="payment-suite payment-suite-visual">
                        <span class="pay-badge pay-paypal" title="PayPal"><i class="ph-bold ph-paypal-logo"></i><em>PayPal</em></span>
                        <span class="pay-badge pay-card" title="Cards"><i class="ph-bold ph-credit-card"></i><em>Visa / MC</em></span>
                        <span class="pay-badge pay-crypto" title="Crypto"><i class="ph-bold ph-currency-btc"></i><em>Crypto</em></span>
                        <span class="pay-badge pay-stripe" title="Stripe"><i class="ph-bold ph-stripe-logo"></i><em>Stripe</em></span>
                    </div>
                </div>
                <div class="copyright-wrap">
                    <p>&copy; {{ date('Y') }} <span class="brand-text-mini">4khdiptv</span>. ALL SIGNALS SECURED.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Chat -->
    @php
        $whatsappNumber = \App\Models\Setting::get('whatsapp_number');
    @endphp
    @if($whatsappNumber)
    <a href="https://wa.me/{{ $whatsappNumber }}" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <i class="ph-fill ph-whatsapp-logo"></i>
    </a>
    @endif

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script>
        // Floating Header Logic
        const siteHeader = document.getElementById('siteHeader');
        const navToggle = document.getElementById('navToggle');
        const navClose = document.getElementById('navClose');
        const mobileNav = document.getElementById('mobileNav');
        const langMenu = document.getElementById('langMenuElite');

        // Scroll Performance
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                siteHeader?.classList.add('is-scrolled');
            } else {
                siteHeader?.classList.remove('is-scrolled');
            }
        });

        // Overlay Toggle
        if (navToggle) {
            navToggle.addEventListener('click', () => {
                mobileNav.classList.add('is-active');
                document.body.style.overflow = 'hidden';
            });
        }

        if (navClose) {
            navClose.addEventListener('click', () => {
                mobileNav.classList.remove('is-active');
                document.body.style.overflow = '';
            });
        }

        // Language Panel Toggle
        function toggleLangMenu(e) {
            e.stopPropagation();
            langMenu?.classList.toggle('show');
        }

        window.addEventListener('click', () => {
            langMenu?.classList.remove('show');
        });

        // AOS Init
        AOS.init({ duration: 800, once: true });
    </script>

    {{-- Floating Coupon --}}
    @php
        $floatingCoupon = \App\Models\Coupon::valid()->latest()->first();
    @endphp
    @if($floatingCoupon)
    <div id="coupon-float">
        <div class="coupon-pill">
            <i class="ph-bold ph-tag"></i>
            <span>{{ $floatingCoupon->value }}{{ $floatingCoupon->type === 'percentage' ? '%' : '$' }} OFF</span>
        </div>
        <div class="coupon-card">
            <h4 style="color:white;margin-bottom:10px;">Exclusive Deal</h4>
            <div style="font-size:24px;font-weight:900;color:var(--accent-vibrant);">{{ $floatingCoupon->code }}</div>
            <p style="font-size:12px;color:rgba(255,255,255,0.6);margin:10px 0;">Use this code at checkout to save big!</p>
            <button onclick="navigator.clipboard.writeText('{{ $floatingCoupon->code }}');this.innerText='Copied!'" style="width:100%;height:40px;background:white;color:black;border:none;border-radius:10px;font-weight:900;cursor:pointer;">Copy Code</button>
        </div>
    </div>
    @endif
    
    {{-- Announcement toast scripts --}}

    @stack('scripts')
    <script>
        (function () {
            const toast = document.getElementById('announcementToast');
            if (!toast) return;
            if (sessionStorage.getItem('announce_toast_dismissed') === '1') {
                toast.remove();
                return;
            }
            setTimeout(function () {
                toast.classList.add('show');
            }, 800);
        })();
        function dismissAnnouncementToast() {
            const toast = document.getElementById('announcementToast');
            if (!toast) return;
            toast.classList.remove('show');
            sessionStorage.setItem('announce_toast_dismissed', '1');
            setTimeout(function () { toast.remove(); }, 500);
        }
    </script>
</body>
</html>