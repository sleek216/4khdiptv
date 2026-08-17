@extends('layouts.app')

@section('title', 'Refunds & Returns - 4khdiptv')

@section('content')
<!-- Page Hero -->
<section class="page-hero-small">
    <div class="container">
        <h1 class="page-title">Refunds & Returns</h1>
        <p class="page-subtitle">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<!-- Content -->
<section class="legal-section">
    <div class="container">
        <div class="refund-content" data-aos="fade-up">
            <!-- Guarantee Badge -->
            <div class="guarantee-box">
                <div class="guarantee-icon">
                    <i class="ph-fill ph-shield-check"></i>
                </div>
                <div class="guarantee-text">
                    <h2>24-Hour Refund Window</h2>
                    <p>We stand behind our service. If it does not meet expectations, we will refund your payment.</p>
                </div>
            </div>
            
            <div class="policy-grid">
                <div class="policy-card">
                    <div class="card-icon eligible">
                        <i class="ph-fill ph-check-circle"></i>
                    </div>
                    <h3>Refund-Eligible</h3>
                    <ul>
                        <li>New subscriptions requested within 24 hours of activation</li>
                        <li>Service not performing as described</li>
                        <li>Technical issues we cannot resolve</li>
                        <li>Duplicate orders placed by mistake</li>
                    </ul>
                </div>
                
                <div class="policy-card">
                    <div class="card-icon not-eligible">
                        <i class="ph-fill ph-x-circle"></i>
                    </div>
                    <h3>Not Eligible</h3>
                    <ul>
                        <li>Requests submitted after 24 hours</li>
                        <li>Renewal purchases</li>
                        <li>Account suspended due to misuse</li>
                        <li>Change of mind after extensive usage</li>
                    </ul>
                </div>
            </div>
            
            <div class="process-section">
                <h2>How to Request a Refund</h2>
                <div class="steps-grid">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h4>Reach Support</h4>
                        <p>Contact us by email, WhatsApp, or Telegram within 24 hours of activation</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h4>Share Details</h4>
                        <p>Include your order number, email address, and the reason for the refund request</p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h4>Review</h4>
                        <p>Our team verifies your purchase and reviews your request within 24 hours</p>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <h4>Refund Issued</h4>
                        <p>Approved refunds are processed within 3-5 business days to the original payment method</p>
                    </div>
                </div>
            </div>
            
            <div class="info-boxes">
                <div class="info-box">
                    <i class="ph-fill ph-clock"></i>
                    <div>
                        <h4>Processing Time</h4>
                        <p>Refunds are typically processed within 3-5 business days. Depending on your payment provider, it may take additional time to appear in your account.</p>
                    </div>
                </div>
                
                <div class="info-box">
                    <i class="ph-fill ph-credit-card"></i>
                    <div>
                        <h4>Refund Method</h4>
                        <p>Refunds are issued to the original payment method used for the purchase. Cryptocurrency refunds may be processed to an equivalent value.</p>
                    </div>
                </div>
                
                <div class="info-box">
                    <i class="ph-fill ph-warning"></i>
                    <div>
                        <h4>Important Notes</h4>
                        <p>Trial subscriptions are free and are not eligible for refunds. Misuse of this policy may result in account restrictions.</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-cta">
                <h3>Need Clarification?</h3>
                <p>Our support team is available 24/7 to help you</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                    <i class="ph ph-chat-centered-dots"></i>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .page-hero-small {
        padding: 160px 0 60px;
        background: linear-gradient(135deg, #0a0f1a 0%, #0d1525 100%);
        text-align: center;
        color: var(--white);
    }
    
    .page-hero-small .page-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    
    .page-hero-small .page-subtitle {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .legal-section {
        padding: 4rem 0;
        background: var(--gray-50);
    }
    
    .refund-content {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .guarantee-box {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 2rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: var(--radius-2xl);
        color: var(--white);
        margin-bottom: 2rem;
    }
    
    .guarantee-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .guarantee-icon i {
        font-size: 2.5rem;
    }
    
    .guarantee-text h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .guarantee-text p {
        opacity: 0.9;
    }
    
    .policy-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .policy-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--shadow-md);
    }
    
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    
    .card-icon i {
        font-size: 2rem;
    }
    
    .card-icon.eligible {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    
    .card-icon.not-eligible {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
    
    .policy-card h3 {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }
    
    .policy-card ul {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .policy-card li {
        color: var(--gray-600);
        padding-left: 1.5rem;
        position: relative;
    }
    
    .policy-card li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: var(--gray-400);
    }
    
    .process-section {
        background: var(--white);
        border-radius: var(--radius-2xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
    }
    
    .process-section h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .steps-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }
    
    .step {
        text-align: center;
    }
    
    .step-number {
        width: 50px;
        height: 50px;
        background: var(--gradient-primary);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0 auto 1rem;
    }
    
    .step h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .step p {
        font-size: 0.875rem;
        color: var(--gray-500);
        line-height: 1.6;
    }
    
    .info-boxes {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .info-box {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
    }
    
    .info-box i {
        font-size: 1.5rem;
        color: var(--primary-500);
        flex-shrink: 0;
    }
    
    .info-box h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .info-box p {
        font-size: 0.9375rem;
        color: var(--gray-600);
    }
    
    .contact-cta {
        text-align: center;
        padding: 2.5rem;
        background: var(--white);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-md);
    }
    
    .contact-cta h3 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .contact-cta p {
        color: var(--gray-500);
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .page-hero-small {
            padding: 140px 0 40px;
        }
        
        .page-hero-small .page-title {
            font-size: 2rem;
        }
        
        .guarantee-box {
            flex-direction: column;
            text-align: center;
        }
        
        .policy-grid {
            grid-template-columns: 1fr;
        }
        
        .steps-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }
</style>
@endpush
@endsection
