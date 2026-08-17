@extends('layouts.app')

@section('title', 'Order Complete - 4khdiptv')

@section('content')
<section class="success-section">
    <div class="container">
        <div class="success-card" data-aos="fade-up">
            <!-- Success Icon -->
            <div class="success-icon">
                <div class="icon-circle">
                    <i class="ph-fill ph-check-circle"></i>
                </div>
                <div class="confetti"></div>
            </div>
            
            <!-- Success Message -->
            <h1 class="success-title">Order Complete!</h1>
            <p class="success-subtitle">Thanks for your purchase. Your IPTV subscription is now active.</p>
            
            <!-- Order Details -->
            <div class="order-details">
                <div class="order-header">
                    <span class="order-number">Order #{{ $order->order_number }}</span>
                    <span class="order-date">{{ $order->created_at->format('M d, Y - h:i A') }}</span>
                </div>
                
                <div class="order-items">
                    <div class="order-item">
                        <div class="item-icon">
                            <i class="ph-fill ph-television"></i>
                        </div>
                        <div class="item-info">
                            <h4>{{ $order->package->name }}</h4>
                            <p>{{ $order->package->duration_label }} Subscription - {{ $order->package->devices }} {{ $order->package->devices > 1 ? 'Devices' : 'Device' }}</p>
                        </div>
                        <div class="item-price">
                            ${{ number_format($order->amount, 2) }}
                        </div>
                    </div>
                </div>
                
                <div class="order-summary-row">
                    <span>Item Total</span>
                    <span>${{ number_format($order->amount, 2) }}</span>
                </div>
                <div class="order-summary-row total">
                    <span>Amount Paid</span>
                    <span>${{ number_format($order->amount, 2) }}</span>
                </div>
            </div>
            
            <!-- Email Notification Box -->
            <div class="email-notification-box">
                <div class="email-icon">
                    <i class="ph-fill ph-envelope-simple"></i>
                </div>
                <h3>Check Your Email</h3>
                <p class="email-message">
                    You will receive an email at <strong>{{ $order->customer_email }}</strong> within the next few minutes with your IPTV credentials and setup instructions.
                </p>
                <div class="email-checklist">
                    <div class="check-item">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Login details (username and password)</span>
                    </div>
                    <div class="check-item">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Portal URL and M3U file</span>
                    </div>
                    <div class="check-item">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Step-by-step setup guide</span>
                    </div>
                    <div class="check-item">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Suggested IPTV apps</span>
                    </div>
                </div>
                <p class="email-note">
                    <i class="ph ph-warning"></i>
                    <strong>Can't find the email?</strong> Check your spam/junk folder. If you still don't receive it within 10 minutes, contact support.
                </p>
            </div>
            
            <!-- Next Steps -->
            <div class="next-steps">
                <h3><i class="ph-fill ph-list-checks"></i> What Happens Next</h3>
                <div class="steps-grid">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h4>Install an IPTV App</h4>
                            <p>Install an IPTV player on your device, like IPTV Smarters or TiviMate.</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h4>Enter Your Credentials</h4>
                            <p>Use the portal URL, username, and password above to log in</p>
                        </div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h4>Start Watching</h4>
                            <p>Enjoy thousands of channels and VOD content right away</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="success-actions">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    <i class="ph ph-house"></i>
                    Go Home
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline btn-lg">
                    <i class="ph ph-question"></i>
                    Get Help
                </a>
            </div>
            
            <!-- Support Box -->
            <div class="support-box">
                <i class="ph-fill ph-headset"></i>
                <div>
                    <p>Need help with setup? Our support team is here 24/7</p>
                    <a href="{{ route('contact') }}">Contact Support →</a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .success-section {
        padding: 150px 0 80px;
        background: linear-gradient(135deg, #f8fafc 0%, #e8f4fd 100%);
        min-height: 100vh;
    }
    
    .success-card {
        max-width: 700px;
        margin: 0 auto;
        background: var(--white);
        border-radius: var(--radius-2xl);
        padding: 3rem;
        box-shadow: var(--shadow-xl);
        text-align: center;
        border: 1px solid var(--gray-100);
    }
    
    .success-icon {
        position: relative;
        margin-bottom: 2rem;
    }
    
    .icon-circle {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: scaleIn 0.5s ease forwards;
    }
    
    .icon-circle i {
        font-size: 3.5rem;
        color: var(--white);
    }
    
    @keyframes scaleIn {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .success-title {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .success-subtitle {
        color: var(--gray-600);
        font-size: 1.125rem;
        margin-bottom: 2rem;
    }
    
    .order-details {
        background: var(--gray-50);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--gray-200);
    }
    
    .order-number {
        font-weight: 700;
        color: var(--gray-900);
    }
    
    .order-date {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    .order-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--gray-200);
    }
    
    .item-icon {
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
    
    .item-info {
        flex: 1;
    }
    
    .item-info h4 {
        font-weight: 600;
        color: var(--gray-900);
    }
    
    .item-info p {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    .item-price {
        font-weight: 700;
        font-size: 1.125rem;
        color: var(--gray-900);
    }
    
    .order-summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.9375rem;
        color: var(--gray-600);
    }
    
    .order-summary-row.total {
        padding-top: 1rem;
        margin-top: 0.5rem;
        border-top: 1px solid var(--gray-200);
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
    }
    
    .email-notification-box {
        background: linear-gradient(135deg, #0a0f1a 0%, #1a2332 100%);
        border-radius: var(--radius-xl);
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: center;
        color: var(--white);
    }
    
    .email-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #0066ff 0%, #0052cc 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s ease-in-out infinite;
    }
    
    .email-icon i {
        font-size: 2.5rem;
        color: var(--white);
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .email-notification-box h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--white);
    }
    
    .email-message {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .email-message strong {
        color: #60a5fa;
        font-weight: 600;
    }
    
    .email-checklist {
        background: rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        text-align: left;
    }
    
    .check-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 0;
        font-size: 0.9375rem;
    }
    
    .check-item:not(:last-child) {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .check-item i {
        color: #10b981;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    
    .email-note {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(251, 191, 36, 0.1);
        border: 1px solid rgba(251, 191, 36, 0.3);
        border-radius: var(--radius-lg);
        font-size: 0.875rem;
        text-align: left;
        color: rgba(255, 255, 255, 0.9);
    }
    
    .email-note i {
        color: #fbbf24;
        font-size: 1.25rem;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }
    
    .email-note strong {
        color: var(--white);
    }
    
    .next-steps {
        background: var(--gray-50);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .next-steps h3 {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
    }
    
    .next-steps h3 i {
        color: var(--primary-500);
    }
    
    .steps-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .step-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .step-number {
        width: 32px;
        height: 32px;
        background: var(--gradient-primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
        flex-shrink: 0;
    }
    
    .step-content h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .step-content p {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    .success-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 2rem;
    }
    
    .support-box {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: var(--primary-50);
        border-radius: var(--radius-lg);
        text-align: left;
    }
    
    .support-box i {
        font-size: 2rem;
        color: var(--primary-500);
    }
    
    .support-box p {
        font-size: 0.9375rem;
        color: var(--gray-600);
        margin-bottom: 0.25rem;
    }
    
    .support-box a {
        font-weight: 600;
        color: var(--primary-600);
    }
    
    @media (max-width: 768px) {
        .success-section {
            padding: 120px 0 40px;
        }
        
        .success-card {
            padding: 1.5rem;
            margin: 0 1rem;
        }
        
        .icon-circle {
            width: 80px;
            height: 80px;
        }
        
        .icon-circle i {
            font-size: 2.5rem;
        }
        
        .success-title {
            font-size: 1.5rem;
        }
        
        .order-header {
            flex-direction: column;
            gap: 0.5rem;
            text-align: center;
        }
        
        .order-item {
            flex-wrap: wrap;
        }
        
        .success-actions {
            flex-direction: column;
        }
        
        .success-actions .btn {
            width: 100%;
        }
        
        .support-box {
            flex-direction: column;
            text-align: center;
        }
    }

    .success-title { color: #ffffff !important; }
    .success-subtitle { color: #94a3b8 !important; }
    .order-details, .next-steps {
        background: rgba(255, 255, 255, 0.03) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }
    .order-header, .order-item { border-bottom-color: rgba(255, 255, 255, 0.08) !important; }
    .order-number, .item-info h4, .item-price, .order-summary-row.total, .next-steps h3, .step-content h4 { color: #ffffff !important; }
    .order-date, .item-info p, .order-summary-row, .step-content p { color: #94a3b8 !important; }
    .support-box {
        background: rgba(124, 58, 237, 0.12) !important;
        border: 1px solid rgba(124, 58, 237, 0.3) !important;
    }
    .support-box p { color: #cbd5e1 !important; }
    .support-box a { color: #a78bfa !important; }

</style>
@endpush
@endsection
