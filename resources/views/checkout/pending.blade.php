@extends('layouts.app')

@section('title', 'Payment Pending - 4khdiptv')

@section('content')
<section class="checkout-result">
    <div class="container">
        <div class="result-card pending">
            <div class="result-icon">
                <i class="ph-fill ph-clock"></i>
            </div>
            
            <h1 class="result-title">Payment Still Pending</h1>
            <p class="result-message">Your order is created. Complete payment to activate your subscription.</p>
            
            <div class="order-details">
                <div class="detail-row">
                    <span class="label">Order ID:</span>
                    <span class="value">{{ $order->order_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Plan:</span>
                    <span class="value">{{ $order->package->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Total:</span>
                    <span class="value">${{ number_format($order->amount, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Payment Type:</span>
                    <span class="value">{{ ucfirst($order->payment_method) }}</span>
                </div>
            </div>
            
            @if($order->payment_method === 'paypal')
            <div class="payment-instructions">
                <h3><i class="ph-fill ph-paypal-logo"></i> PayPal Instructions</h3>
                <p>Send <strong>${{ number_format($order->amount, 2) }}</strong> to our PayPal account and include order number <strong>{{ $order->order_number }}</strong> in the payment notes.</p>
                <a href="https://paypal.me/4khdiptv" target="_blank" class="btn btn--primary btn--lg">
                    <i class="ph ph-arrow-square-out"></i>
                    Pay with PayPal
                </a>
            </div>
            @elseif($order->payment_method === 'crypto')
            <div class="payment-instructions">
                <h3><i class="ph-fill ph-currency-btc"></i> Crypto Instructions</h3>
                <p>Contact our support team to receive the wallet address for your payment.</p>
                <a href="{{ route('contact') }}" class="btn btn--primary btn--lg">
                    <i class="ph ph-chat-circle"></i>
                    Contact Support
                </a>
            </div>
            @endif
            
            <div class="result-note">
                <i class="ph ph-info"></i>
                <span>Once payment is confirmed, you'll receive your subscription details by email within 24 hours.</span>
            </div>
            
            <div class="result-actions">
                <a href="{{ route('profile') }}" class="btn btn--outline">
                    <i class="ph ph-user"></i>
                    Account Settings
                </a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">
                    Get Help
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .checkout-result {
        padding: 160px 0 80px;
        background: var(--gray-50);
        min-height: 100vh;
    }
    
    .result-card {
        max-width: 560px;
        margin: 0 auto;
        padding: 3rem;
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        text-align: center;
    }
    
    .result-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        border-radius: 50%;
    }
    
    .pending .result-icon {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.2));
        color: #f59e0b;
    }
    
    .result-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.75rem;
    }
    
    .result-message {
        color: var(--gray-600);
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .order-details {
        background: var(--gray-50);
        padding: 1.5rem;
        border-radius: var(--radius-lg);
        margin-bottom: 2rem;
    }
    
    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--gray-200);
    }
    
    .detail-row:last-child {
        border-bottom: none;
    }
    
    .detail-row .label {
        color: var(--gray-500);
        font-size: 0.9375rem;
    }
    
    .detail-row .value {
        font-weight: 600;
        color: var(--gray-900);
    }
    
    .payment-instructions {
        background: linear-gradient(135deg, var(--primary-50), rgba(0, 102, 255, 0.05));
        border: 1px solid var(--primary-100);
        padding: 2rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
    }
    
    .payment-instructions h3 {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.75rem;
    }
    
    .payment-instructions p {
        color: var(--gray-600);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
    
    .result-note {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: var(--radius-md);
        text-align: left;
        margin-bottom: 1.5rem;
    }
    
    .result-note i {
        font-size: 1.25rem;
        color: var(--primary-500);
        flex-shrink: 0;
    }
    
    .result-note span {
        font-size: 0.875rem;
        color: var(--gray-600);
        line-height: 1.5;
    }
    
    .result-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .pending-title { color: #ffffff !important; }
    .pending-subtitle { color: #94a3b8 !important; }
    .order-details, .payment-instructions, .support-box {
        background: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }
    .detail-row { border-bottom-color: rgba(255, 255, 255, 0.08) !important; }
    .detail-row .value { color: #ffffff !important; }
    .detail-row .label { color: #94a3b8 !important; }

</style>
@endpush
@endsection
