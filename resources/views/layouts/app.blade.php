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

        /* =======================================================
           Floating WhatsApp Support Widget (Positioned above Crisp)
           ======================================================= */
        .whatsapp-widget {
            position: fixed;
            right: 22px;
            bottom: 24px;
            z-index: 9998;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .whatsapp-widget.has-crisp {
            bottom: 92px !important; /* Floats directly above Crisp's bottom-right chat bubble */
        }
        .whatsapp-float-btn {
            position: relative;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: #ffffff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.45), 0 2px 8px rgba(0, 0, 0, 0.35);
            text-decoration: none !important;
            cursor: pointer;
            border: none;
            outline: none;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            user-select: none;
        }
        .whatsapp-float-btn:hover {
            transform: scale(1.08) translateY(-2px);
            box-shadow: 0 14px 32px rgba(37, 211, 102, 0.55), 0 4px 12px rgba(0, 0, 0, 0.4);
        }
        .wa-icon-holder {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
        }
        .wa-pulse-ring {
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 2px solid #25D366;
            animation: waPulseRing 2.2s cubic-bezier(0.24, 0, 0.38, 1) infinite;
            pointer-events: none;
        }
        @keyframes waPulseRing {
            0% { transform: scale(0.95); opacity: 0.85; }
            70% { transform: scale(1.35); opacity: 0; }
            100% { transform: scale(1.35); opacity: 0; }
        }
        .wa-badge-dot {
            position: absolute;
            top: 2px;
            right: 2px;
            width: 13px;
            height: 13px;
            background: #10b981;
            border: 2.5px solid #0b0f19;
            border-radius: 50%;
            z-index: 3;
            box-shadow: 0 0 8px #10b981;
        }
        .wa-tooltip-tag {
            position: absolute;
            right: 68px;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
            padding: 7px 14px;
            border-radius: 99px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transform: translateX(10px);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .whatsapp-widget:hover .wa-tooltip-tag {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }
        .whatsapp-widget.is-open .wa-tooltip-tag {
            opacity: 0 !important;
            visibility: hidden !important;
        }

        /* Popup Card */
        .wa-popup-card {
            position: absolute;
            bottom: 68px;
            right: 0;
            width: 300px;
            background: #0d1117;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px) scale(0.94);
            transform-origin: bottom right;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.65), 0 0 0 1px rgba(37, 211, 102, 0.25);
            z-index: 10;
        }
        .whatsapp-widget.is-open .wa-popup-card {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        .wa-card-header {
            background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }
        .wa-avatar-wrap {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .wa-status-dot {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background: #25D366;
            border: 2px solid #075E54;
            border-radius: 50%;
        }
        .wa-card-title-group {
            flex: 1;
            min-width: 0;
        }
        .wa-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
        }
        .wa-card-subtitle {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.85);
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 2px;
        }
        .wa-live-indicator {
            width: 6px;
            height: 6px;
            background: #25D366;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 6px #25D366;
        }
        .wa-close-btn {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.75);
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: color 0.2s;
        }
        .wa-close-btn:hover {
            color: #ffffff;
        }
        .wa-card-content {
            padding: 14px 16px;
            background: #0d1117;
        }
        .wa-chat-bubble {
            background: #1e293b;
            border-radius: 12px 12px 12px 2px;
            padding: 10px 12px;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .wa-bubble-text {
            font-size: 12px;
            line-height: 1.45;
            color: #e2e8f0;
            margin: 0;
        }
        .wa-bubble-time {
            display: block;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.45);
            text-align: right;
            margin-top: 4px;
        }
        .wa-number-badge {
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(37, 211, 102, 0.1);
            color: #25D366;
            border: 1px solid rgba(37, 211, 102, 0.25);
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
        }
        .wa-card-action {
            padding: 10px 16px 14px;
            background: #0d1117;
        }
        .wa-chat-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px 16px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 700;
            border-radius: 10px;
            text-decoration: none !important;
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);
            transition: all 0.25s ease;
        }
        .wa-chat-action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.5);
            filter: brightness(1.05);
        }

        /* Adjust coupon float so it never collides with Crisp or WhatsApp */
        #coupon-float {
            right: 88px !important;
            bottom: 24px !important;
        }

        @media (max-width: 768px) {
            .whatsapp-widget {
                right: 16px !important;
                bottom: 20px !important;
            }
            .whatsapp-widget.has-crisp {
                bottom: 84px !important;
            }
            .whatsapp-float-btn {
                width: 48px !important;
                height: 48px !important;
            }
            .whatsapp-float-btn svg {
                width: 26px !important;
                height: 26px !important;
            }
            .wa-popup-card {
                right: -6px;
                width: 280px;
                bottom: 58px;
            }
            #coupon-float {
                right: 76px !important;
                bottom: 18px !important;
            }
        }
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
                    $footerEmail = 'support@4khdiptv.net';
                    $footerWhatsapp = \App\Models\Setting::get('whatsapp_number') ?: \App\Models\Setting::get('whatsapp');
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

    <!-- WhatsApp Floating Support Widget -->
    @php
        $whatsappNumber = \App\Models\Setting::get('whatsapp_number') ?: \App\Models\Setting::get('whatsapp');
        $cleanWhatsapp = $whatsappNumber ? preg_replace('/\D+/', '', $whatsappNumber) : '';
        $hasCrisp = !empty(\App\Models\Setting::get('crisp_website_id'));
    @endphp

    @if($whatsappNumber && $cleanWhatsapp)
    <div id="whatsappWidget" class="whatsapp-widget {{ $hasCrisp ? 'has-crisp' : '' }}">
        {{-- Interactive Popup Card with agent status and direct chat --}}
        <div class="wa-popup-card" id="waPopupCard">
            <div class="wa-card-header">
                <div class="wa-avatar-wrap">
                    <div class="wa-avatar-icon">
                        <svg viewBox="0 0 32 32" width="22" height="22" fill="#ffffff">
                            <path d="M16 2C8.28 2 2 8.28 2 16c0 2.61.71 5.06 1.94 7.17L2 30l6.99-1.91A13.93 13.93 0 0 0 16 30c7.72 0 14-6.28 14-14S23.72 2 16 2zm0 25.54c-2.31 0-4.47-.64-6.33-1.74l-.45-.27-4.69 1.28 1.25-4.57-.29-.47A11.48 11.48 0 0 1 4.46 16c0-6.36 5.18-11.54 11.54-11.54 6.36 0 11.54 5.18 11.54 11.54 0 6.36-5.18 11.54-11.54 11.54zm6.33-8.63c-.35-.17-2.06-1.02-2.38-1.13-.32-.12-.55-.17-.78.17-.23.35-.9 1.13-1.1 1.36-.2.23-.41.26-.75.09-.35-.17-1.46-.54-2.79-1.72-1.03-.92-1.73-2.05-1.93-2.4-.2-.35-.02-.53.15-.71.16-.16.35-.41.52-.61.17-.2.23-.35.35-.58.12-.23.06-.44-.03-.61-.09-.17-.78-1.89-1.07-2.59-.28-.68-.57-.59-.78-.6h-.67c-.23 0-.61.09-.93.44-.32.35-1.22 1.19-1.22 2.9 0 1.72 1.25 3.38 1.43 3.61.17.23 2.46 3.76 5.96 5.27.83.36 1.48.57 1.99.73.84.27 1.6.23 2.21.14.67-.1 2.06-.84 2.35-1.65.29-.82.29-1.52.2-1.66-.08-.15-.31-.24-.66-.41z"/>
                        </svg>
                    </div>
                    <span class="wa-status-dot"></span>
                </div>
                <div class="wa-card-title-group">
                    <div class="wa-card-title">4khdiptv Support</div>
                    <div class="wa-card-subtitle">
                        <span class="wa-live-indicator"></span>
                        <span>Online &bull; Instant Reply</span>
                    </div>
                </div>
                <button type="button" class="wa-close-btn" id="waCloseBtn" aria-label="Close">&times;</button>
            </div>
            <div class="wa-card-content">
                <div class="wa-chat-bubble">
                    <p class="wa-bubble-text">👋 Hello! Need help with IPTV setup, channel list, or instant renewal?</p>
                    <span class="wa-bubble-time">{{ date('h:i A') }}</span>
                </div>
                <div class="wa-number-badge">
                    <i class="ph-bold ph-whatsapp-logo"></i>
                    <span>{{ $whatsappNumber }}</span>
                </div>
            </div>
            <div class="wa-card-action">
                <a href="https://wa.me/{{ $cleanWhatsapp }}?text={{ rawurlencode('Hello 4khdiptv support, I need help with IPTV service.') }}" target="_blank" rel="noopener noreferrer" class="wa-chat-action-btn">
                    <span>Chat on WhatsApp</span>
                    <i class="ph-bold ph-paper-plane-right"></i>
                </a>
            </div>
        </div>

        {{-- Main Floating Button (Direct tap on mobile, toggles card or opens on desktop) --}}
        <a href="https://wa.me/{{ $cleanWhatsapp }}?text={{ rawurlencode('Hello 4khdiptv support, I need help with IPTV service.') }}" class="whatsapp-float-btn" id="waFloatBtn" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp Support">
            <span class="wa-pulse-ring"></span>
            <span class="wa-icon-holder">
                <svg viewBox="0 0 32 32" width="30" height="30" fill="#ffffff">
                    <path d="M16 2C8.28 2 2 8.28 2 16c0 2.61.71 5.06 1.94 7.17L2 30l6.99-1.91A13.93 13.93 0 0 0 16 30c7.72 0 14-6.28 14-14S23.72 2 16 2zm0 25.54c-2.31 0-4.47-.64-6.33-1.74l-.45-.27-4.69 1.28 1.25-4.57-.29-.47A11.48 11.48 0 0 1 4.46 16c0-6.36 5.18-11.54 11.54-11.54 6.36 0 11.54 5.18 11.54 11.54 0 6.36-5.18 11.54-11.54 11.54zm6.33-8.63c-.35-.17-2.06-1.02-2.38-1.13-.32-.12-.55-.17-.78.17-.23.35-.9 1.13-1.1 1.36-.2.23-.41.26-.75.09-.35-.17-1.46-.54-2.79-1.72-1.03-.92-1.73-2.05-1.93-2.4-.2-.35-.02-.53.15-.71.16-.16.35-.41.52-.61.17-.2.23-.35.35-.58.12-.23.06-.44-.03-.61-.09-.17-.78-1.89-1.07-2.59-.28-.68-.57-.59-.78-.6h-.67c-.23 0-.61.09-.93.44-.32.35-1.22 1.19-1.22 2.9 0 1.72 1.25 3.38 1.43 3.61.17.23 2.46 3.76 5.96 5.27.83.36 1.48.57 1.99.73.84.27 1.6.23 2.21.14.67-.1 2.06-.84 2.35-1.65.29-.82.29-1.52.2-1.66-.08-.15-.31-.24-.66-.41z"/>
                </svg>
            </span>
            <span class="wa-badge-dot"></span>
            <span class="wa-tooltip-tag">WhatsApp Support</span>
        </a>
    </div>
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

    {{-- WhatsApp Floating Widget Script --}}
    <script>
        (function() {
            const widget = document.getElementById('whatsappWidget');
            const floatBtn = document.getElementById('waFloatBtn');
            const closeBtn = document.getElementById('waCloseBtn');
            if (!widget || !floatBtn) return;

            let isMobile = window.innerWidth <= 768;
            window.addEventListener('resize', function() {
                isMobile = window.innerWidth <= 768;
            });

            floatBtn.addEventListener('click', function(e) {
                if (!isMobile) {
                    e.preventDefault();
                    widget.classList.toggle('is-open');
                }
            });

            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    widget.classList.remove('is-open');
                });
            }

            document.addEventListener('click', function(e) {
                if (!widget.contains(e.target)) {
                    widget.classList.remove('is-open');
                }
            });

            if (window.$crisp) {
                $crisp.push(["on", "chat:opened", function() {
                    widget.style.opacity = '0';
                    widget.style.pointerEvents = 'none';
                }]);
                $crisp.push(["on", "chat:closed", function() {
                    widget.style.opacity = '1';
                    widget.style.pointerEvents = 'auto';
                }]);
            }
        })();
    </script>
</body>
</html>