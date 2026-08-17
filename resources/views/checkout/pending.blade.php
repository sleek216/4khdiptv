@extends('layouts.app')

@section('title', 'Payment Pending - 4khdiptv')

@section('content')
<section class="checkout-result-section">
    <!-- Ambient Background Glows -->
    <div class="ambient-glow glow-pending"></div>

    <div class="container">
        <div class="result-card pending" data-aos="zoom-in" data-aos-duration="600">
            <div class="result-icon-wrapper">
                <div class="result-icon-glow"></div>
                <div class="result-icon">
                    <i class="ph-fill ph-clock-countdown"></i>
                </div>
            </div>
            
            <span class="status-tag-pending">
                <i class="ph-bold ph-hourglass-high"></i> Payment Pending
            </span>
            <h1 class="result-title">Payment is Pending</h1>
            <p class="result-message">Your order has been created. Please complete your payment to activate your IPTV subscription.</p>
            
            <div class="order-details-box">
                <div class="detail-row">
                    <span class="label">Order Number:</span>
                    <span class="value-highlight">#{{ $order->order_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Package:</span>
                    <span class="value">{{ $order->package->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Amount Due:</span>
                    <span class="value-price">${{ number_format($order->amount, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Payment Method:</span>
                    <span class="value">{{ ucfirst($order->payment_method) }}</span>
                </div>
            </div>
            
            @if($order->payment_method === 'paypal')
            <div class="payment-instructions-box">
                <h3><i class="ph-fill ph-paypal-logo"></i> PayPal Payment Instructions</h3>
                <p>Send <strong>${{ number_format($order->amount, 2) }}</strong> to our PayPal account and include your order number <strong>{{ $order->order_number }}</strong> in the note.</p>
                <a href="https://paypal.me/4khdiptv" target="_blank" class="btn-glow-primary">
                    <i class="ph-bold ph-arrow-square-out"></i>
                    <span>Pay with PayPal</span>
                </a>
            </div>
            @elseif($order->payment_method === 'crypto')
            <div class="payment-instructions-box">
                <h3><i class="ph-fill ph-currency-btc"></i> Crypto Payment</h3>
                <p>If the payment window didn't open automatically, contact our 24/7 team to receive payment instructions.</p>
                <a href="{{ route('contact') }}" class="btn-glow-primary">
                    <i class="ph-bold ph-chat-circle-dots"></i>
                    <span>Contact Support</span>
                </a>
            </div>
            @endif
            
            <div class="result-note-box">
                <i class="ph-fill ph-info"></i>
                <span>Once your payment is confirmed, your IPTV credentials will be emailed to you within minutes.</span>
            </div>
            
            <div class="result-actions-row">
                <a href="{{ route('home') }}" class="btn-glow-primary">
                    <i class="ph-bold ph-house"></i>
                    <span>Back to Home</span>
                </a>
                <a href="{{ route('contact') }}" class="btn-glass-secondary">
                    <i class="ph-bold ph-headset"></i>
                    <span>Get Help</span>
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .checkout-result-section {
        position: relative;
        padding: 140px 0 90px;
        background: #080a10;
        min-height: 100vh;
        overflow: hidden;
        font-family: 'Hanken Grotesk', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    
    .ambient-glow.glow-pending {
        position: absolute;
        top: 20%;
        left: 30%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        filter: blur(140px);
        pointer-events: none;
    }
    
    .result-card {
        position: relative;
        z-index: 1;
        max-width: 680px;
        margin: 0 auto;
        padding: 3.5rem 3rem;
        background: linear-gradient(165deg, rgba(20, 24, 38, 0.85) 0%, rgba(12, 15, 26, 0.95) 100%);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 32px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
        text-align: center;
    }
    
    .result-icon-wrapper {
        position: relative;
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .result-icon-glow {
        position: absolute;
        inset: -10px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.4) 0%, transparent 70%);
        border-radius: 50%;
    }
    .result-icon {
        position: relative;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 2.75rem;
        box-shadow: 0 0 30px rgba(245, 158, 11, 0.45);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    
    .status-tag-pending {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.35rem 1rem;
        background: rgba(245, 158, 11, 0.12);
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 50px;
        color: #fbbf24;
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }
    
    .result-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }
    
    .result-message {
        color: #94a3b8;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }
    
    .order-details-box {
        background: rgba(255, 255, 255, 0.025);
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 1.75rem;
        text-align: left;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    }
    .detail-row:last-child {
        border-bottom: none;
    }
    .detail-row .label {
        color: #94a3b8;
        font-size: 0.9375rem;
    }
    .detail-row .value {
        color: #ffffff;
        font-weight: 600;
    }
    .value-highlight {
        color: #a78bfa;
        font-weight: 700;
        font-family: 'Outfit', sans-serif;
    }
    .value-price {
        color: #38bdf8;
        font-weight: 700;
        font-size: 1.125rem;
        font-family: 'Outfit', sans-serif;
    }
    
    .payment-instructions-box {
        background: rgba(124, 58, 237, 0.08);
        border: 1px solid rgba(124, 58, 237, 0.25);
        border-radius: 20px;
        padding: 1.75rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .payment-instructions-box h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }
    .payment-instructions-box p {
        color: #cbd5e1;
        font-size: 0.9375rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }
    
    .result-note-box {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 14px;
        text-align: left;
        color: #94a3b8;
        font-size: 0.875rem;
        margin-bottom: 2rem;
    }
    .result-note-box i {
        color: #38bdf8;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    
    .result-actions-row {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .btn-glow-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 0.9rem 2rem;
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #ec4899 100%);
        color: #ffffff;
        border-radius: 50px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.4);
        transition: all 0.3s ease;
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
        padding: 0.9rem 2rem;
        background: rgba(255, 255, 255, 0.05);
        color: #f1f5f9;
        border-radius: 50px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }
    .btn-glass-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .checkout-result-section {
            padding: 110px 1rem 60px;
        }
        .result-card {
            padding: 2.25rem 1.25rem;
        }
        .result-actions-row {
            flex-direction: column;
        }
        .btn-glow-primary, .btn-glass-secondary {
            width: 100%;
        }
    }
</style>
@endpush
@endsection
