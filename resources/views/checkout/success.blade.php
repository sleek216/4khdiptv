@extends('layouts.app')

@section('title', 'Order Complete - 4khdiptv')

@section('content')
<section class="success-section">
    <!-- Ambient Background Glows -->
    <div class="ambient-glow glow-1"></div>
    <div class="ambient-glow glow-2"></div>

    <div class="container">
        <div class="success-card" data-aos="zoom-in" data-aos-duration="600">
            
            <!-- Success Icon Badge -->
            <div class="success-badge-wrapper">
                <div class="success-icon-glow"></div>
                <div class="success-icon-circle">
                    <i class="ph-fill ph-check-circle"></i>
                </div>
            </div>
            
            <!-- Success Titles -->
            <span class="order-status-tag">
                <i class="ph-bold ph-sparkle"></i> Order Successful
            </span>
            <h1 class="success-title">Thank You For Your Order!</h1>
            <p class="success-subtitle">Your subscription has been activated. Instant access details have been sent.</p>
            
            <!-- Order Details Card -->
            <div class="order-details-box">
                <div class="order-header-row">
                    <div class="order-id-col">
                        <span class="meta-label">ORDER NUMBER</span>
                        <span class="order-number-badge">
                            <i class="ph-bold ph-hash"></i>{{ $order->order_number }}
                        </span>
                    </div>
                    <div class="order-date-col">
                        <span class="meta-label">DATE & TIME</span>
                        <span class="order-date-val">{{ $order->created_at->format('M d, Y • h:i A') }}</span>
                    </div>
                </div>
                
                <div class="order-item-card">
                    <div class="item-visual">
                        <i class="ph-fill ph-television"></i>
                    </div>
                    <div class="item-meta">
                        <h4 class="item-name">{{ $order->package->name }}</h4>
                        <p class="item-desc">
                            <i class="ph-fill ph-clock"></i> {{ $order->package->duration_label }} Plan
                            <span class="dot-separator">•</span>
                            <i class="ph-fill ph-devices"></i> {{ $order->package->devices }} {{ $order->package->devices > 1 ? 'Devices' : 'Device' }}
                        </p>
                    </div>
                    <div class="item-price-tag">
                        ${{ number_format($order->amount, 2) }}
                    </div>
                </div>
                
                <div class="order-bill-breakdown">
                    <div class="bill-row">
                        <span>Item Subtotal</span>
                        <span>${{ number_format($order->amount, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="bill-row discount">
                        <span>Discount Applied</span>
                        <span>-${{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    @endif
                    <div class="bill-row total">
                        <span>Total Paid</span>
                        <span class="total-highlight">${{ number_format($order->amount, 2) }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Email Credentials Info Box -->
            <div class="email-notice-card">
                <div class="email-notice-header">
                    <div class="email-notice-icon">
                        <i class="ph-fill ph-envelope-simple-open"></i>
                    </div>
                    <div class="email-notice-text">
                        <h3>Check Your Email Inbox</h3>
                        <p>We've sent your IPTV login credentials & M3U playlist to <span class="user-email">{{ $order->customer_email }}</span></p>
                    </div>
                </div>
                
                <div class="credentials-checklist">
                    <div class="check-pill">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Username & Password</span>
                    </div>
                    <div class="check-pill">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Xtream Portal & M3U URL</span>
                    </div>
                    <div class="check-pill">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Step-by-Step App Guide</span>
                    </div>
                    <div class="check-pill">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>24/7 Priority Support</span>
                    </div>
                </div>
                
                <div class="spam-alert-pill">
                    <i class="ph-fill ph-info"></i>
                    <span><strong>Pro Tip:</strong> If you don't see the email in 2-3 minutes, please check your <strong>Spam / Junk</strong> folder.</span>
                </div>
            </div>
            
            <!-- Next Steps Flow -->
            <div class="steps-container">
                <h3 class="steps-heading">
                    <i class="ph-fill ph-rocket-launch"></i> Quick Setup in 3 Simple Steps
                </h3>
                <div class="steps-grid-3">
                    <div class="step-card">
                        <div class="step-badge">1</div>
                        <h5>Download App</h5>
                        <p>Install IPTV Smarters Pro, TiviMate, or IBO Player on your TV/Device.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-badge">2</div>
                        <h5>Enter Details</h5>
                        <p>Paste the Xtream credentials or M3U playlist link sent to your email.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-badge">3</div>
                        <h5>Enjoy 4K Streaming</h5>
                        <p>Access 20,000+ live channels, sports, movies & series instantly!</p>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="success-footer-actions">
                <a href="{{ route('home') }}" class="btn-glow-primary">
                    <i class="ph-bold ph-house"></i>
                    <span>Back to Home</span>
                </a>
                <a href="{{ route('contact') }}" class="btn-glass-secondary">
                    <i class="ph-bold ph-headset"></i>
                    <span>Contact Support</span>
                </a>
            </div>
            
            <!-- Trust Support Note -->
            <div class="live-support-ribbon">
                <i class="ph-fill ph-chat-circle-dots"></i>
                <span>Need instant setup help? Our support agents are active 24/7.</span>
                <a href="{{ route('contact') }}" class="support-link">Get Live Help →</a>
            </div>
            
        </div>
    </div>
</section>

@push('styles')
<style>
    .success-section {
        position: relative;
        padding: 140px 0 90px;
        background: #080a10;
        min-height: 100vh;
        overflow: hidden;
        font-family: 'Hanken Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Ambient Background Glows */
    .ambient-glow {
        position: absolute;
        border-radius: 50%;
        filter: blur(140px);
        pointer-events: none;
        z-index: 0;
    }
    .glow-1 {
        top: 10%;
        left: 20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(124, 58, 237, 0.18) 0%, transparent 70%);
    }
    .glow-2 {
        bottom: 15%;
        right: 20%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, transparent 70%);
    }

    /* Success Card Container */
    .success-card {
        position: relative;
        z-index: 1;
        max-width: 780px;
        margin: 0 auto;
        background: linear-gradient(165deg, rgba(20, 24, 38, 0.85) 0%, rgba(12, 15, 26, 0.95) 100%);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 32px;
        padding: 3.5rem 3rem;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6), 0 0 50px rgba(124, 58, 237, 0.08);
        text-align: center;
    }

    /* Badge & Icon */
    .success-badge-wrapper {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .success-icon-glow {
        position: absolute;
        inset: -10px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.5) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2.5s ease-in-out infinite;
    }
    .success-icon-circle {
        position: relative;
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 35px rgba(16, 185, 129, 0.5), inset 0 2px 4px rgba(255, 255, 255, 0.4);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    .success-icon-circle i {
        font-size: 3.25rem;
        color: #ffffff;
    }

    @keyframes pulseGlow {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.15); opacity: 0.9; }
    }

    .order-status-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 1rem;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 50px;
        color: #34d399;
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .success-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.25rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.02em;
        margin-bottom: 0.6rem;
    }

    .success-subtitle {
        color: #94a3b8;
        font-size: 1.0625rem;
        line-height: 1.6;
        max-width: 560px;
        margin: 0 auto 2.5rem;
    }

    /* Order Details Box */
    .order-details-box {
        background: rgba(255, 255, 255, 0.025);
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 24px;
        padding: 1.75rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .order-header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 1.25rem;
    }
    .meta-label {
        display: block;
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        color: #64748b;
        margin-bottom: 0.35rem;
    }
    .order-number-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1.0625rem;
        color: #a78bfa;
        background: rgba(124, 58, 237, 0.12);
        padding: 0.25rem 0.75rem;
        border-radius: 8px;
        border: 1px solid rgba(124, 58, 237, 0.25);
    }
    .order-date-val {
        font-size: 0.9375rem;
        color: #cbd5e1;
        font-weight: 500;
    }

    /* Order Item */
    .order-item-card {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 16px;
        margin-bottom: 1.25rem;
    }
    .item-visual {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.75rem;
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
        flex-shrink: 0;
    }
    .item-meta {
        flex: 1;
    }
    .item-name {
        font-family: 'Outfit', sans-serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.25rem;
    }
    .item-desc {
        font-size: 0.875rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }
    .dot-separator {
        color: #475569;
    }
    .item-price-tag {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: #38bdf8;
    }

    /* Bill breakdown */
    .order-bill-breakdown {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }
    .bill-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.9375rem;
        color: #94a3b8;
    }
    .bill-row.discount {
        color: #34d399;
    }
    .bill-row.total {
        padding-top: 0.9rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        font-family: 'Outfit', sans-serif;
        font-size: 1.1875rem;
        font-weight: 700;
        color: #ffffff;
    }
    .total-highlight {
        font-size: 1.375rem;
        color: #34d399;
    }

    /* Email Notification Card */
    .email-notice-card {
        background: linear-gradient(165deg, rgba(124, 58, 237, 0.12) 0%, rgba(30, 27, 75, 0.3) 100%);
        border: 1px solid rgba(124, 58, 237, 0.3);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    .email-notice-header {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .email-notice-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #7c3aed 0%, #3b82f6 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.85rem;
        box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4);
        flex-shrink: 0;
    }
    .email-notice-text h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.25rem;
    }
    .email-notice-text p {
        font-size: 0.9375rem;
        color: #cbd5e1;
        line-height: 1.5;
    }
    .user-email {
        color: #38bdf8;
        font-weight: 600;
        background: rgba(56, 189, 248, 0.1);
        padding: 0.15rem 0.5rem;
        border-radius: 6px;
    }

    .credentials-checklist {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }
    .check-pill {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.7rem 1rem;
        background: rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        font-size: 0.875rem;
        color: #e2e8f0;
    }
    .check-pill i {
        color: #34d399;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .spam-alert-pill {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.75rem 1rem;
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.25);
        border-radius: 12px;
        font-size: 0.8125rem;
        color: #fde68a;
    }
    .spam-alert-pill i {
        color: #fbbf24;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .spam-alert-pill strong {
        color: #ffffff;
    }

    /* Next Steps */
    .steps-container {
        margin-bottom: 2.25rem;
        text-align: left;
    }
    .steps-heading {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'Outfit', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1.25rem;
    }
    .steps-heading i {
        color: #ec4899;
    }
    .steps-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    .step-card {
        background: rgba(255, 255, 255, 0.025);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 18px;
        padding: 1.25rem;
        transition: transform 0.25s ease, border-color 0.25s ease;
    }
    .step-card:hover {
        transform: translateY(-3px);
        border-color: rgba(124, 58, 237, 0.35);
    }
    .step-badge {
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }
    .step-card h5 {
        font-family: 'Outfit', sans-serif;
        font-size: 0.9375rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.35rem;
    }
    .step-card p {
        font-size: 0.8125rem;
        color: #94a3b8;
        line-height: 1.45;
    }

    /* Footer Action Buttons */
    .success-footer-actions {
        display: flex;
        gap: 1.25rem;
        justify-content: center;
        margin-bottom: 2rem;
    }
    .btn-glow-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 1rem 2.25rem;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #ec4899 100%);
        color: #ffffff;
        border-radius: 50px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.45);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border: none;
    }
    .btn-glow-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(124, 58, 237, 0.6);
        color: #ffffff;
    }
    .btn-glass-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 1rem 2.25rem;
        background: rgba(255, 255, 255, 0.05);
        color: #f1f5f9;
        border-radius: 50px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }
    .btn-glass-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.25);
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* Live Support Ribbon */
    .live-support-ribbon {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.85rem 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 50px;
        font-size: 0.875rem;
        color: #94a3b8;
    }
    .live-support-ribbon i {
        color: #a78bfa;
        font-size: 1.25rem;
    }
    .support-link {
        color: #a78bfa;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .support-link:hover {
        color: #c084fc;
        text-decoration: underline;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .success-section {
            padding: 110px 1rem 60px;
        }
        .success-card {
            padding: 2.25rem 1.25rem;
            border-radius: 24px;
        }
        .success-title {
            font-size: 1.65rem;
        }
        .credentials-checklist {
            grid-template-columns: 1fr;
        }
        .steps-grid-3 {
            grid-template-columns: 1fr;
        }
        .order-header-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        .success-footer-actions {
            flex-direction: column;
        }
        .btn-glow-primary, .btn-glass-secondary {
            width: 100%;
        }
    }
</style>
@endpush
@endsection
