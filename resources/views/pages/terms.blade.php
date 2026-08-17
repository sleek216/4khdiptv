@extends('layouts.app')

@section('title', 'Service Terms - 4khdiptv')

@section('content')
<!-- Page Hero -->
<section class="page-hero-small">
    <div class="container">
        <h1 class="page-title">Service Terms</h1>
        <p class="page-subtitle">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<!-- Content -->
<section class="legal-section">
    <div class="container">
        <div class="legal-content" data-aos="fade-up">
            <div class="legal-nav">
                <h4>On This Page</h4>
                <ul>
                    <li><a href="#acceptance">1. Agreement</a></li>
                    <li><a href="#services">2. What We Provide</a></li>
                    <li><a href="#accounts">3. Account Use</a></li>
                    <li><a href="#payments">4. Billing Rules</a></li>
                    <li><a href="#refunds">5. Refund Window</a></li>
                    <li><a href="#usage">6. Usage Rules</a></li>
                    <li><a href="#termination">7. Account Closure</a></li>
                    <li><a href="#liability">8. Liability Limits</a></li>
                    <li><a href="#changes">9. Policy Updates</a></li>
                    <li><a href="#contact">10. Reach Us</a></li>
                </ul>
            </div>
            
            <div class="legal-main">
                <section id="acceptance">
                    <h2>1. Agreement</h2>
                    <p>By accessing or using 4khdiptv services, you accept these terms and all applicable laws and regulations. If you do not agree, do not use the services.</p>
                    <p>These terms apply to anyone using the service, including visitors, customers, and contributors.</p>
                </section>
                
                <section id="services">
                    <h2>2. What We Provide</h2>
                    <p>4khdiptv delivers IPTV streaming that provides live channels, on-demand content, and related entertainment through an internet connection.</p>
                    <p>Service highlights include:</p>
                    <ul>
                        <li>Live TV from multiple regions</li>
                        <li>On-demand movies and series</li>
                        <li>Electronic Program Guide (EPG)</li>
                        <li>Multi-device access</li>
                        <li>Customer support help</li>
                    </ul>
                    <p>We may change, pause, or end parts of the service at any time without notice.</p>
                </section>
                
                <section id="accounts">
                    <h2>3. Account Use</h2>
                    <p>When creating an account, you must provide accurate, complete, and current information. Inaccurate details violate these terms.</p>
                    <p>You are responsible for:</p>
                    <ul>
                        <li>Keeping login details private</li>
                        <li>All activity under your account</li>
                        <li>Reporting unauthorized access right away</li>
                    </ul>
                    <p>You may not use your account for unlawful purposes or share access beyond the connections allowed by your plan.</p>
                </section>
                
                <section id="payments">
                    <h2>4. Billing Rules</h2>
                    <p>Payments are processed securely through our payment partners. By subscribing, you agree to pay the fees shown at checkout.</p>
                    <p>Billing terms include:</p>
                    <ul>
                        <li>Prices are listed in USD unless noted</li>
                        <li>Subscriptions do not auto-renew unless stated</li>
                        <li>Payment is due in full at purchase</li>
                        <li>We accept PayPal, cards, and cryptocurrency</li>
                    </ul>
                </section>
                
                <section id="refunds">
                    <h2>5. Refund Window</h2>
                    <p>New subscribers have a 24-hour money-back window. If you are not satisfied within 24 hours of activation, contact support to request a full refund.</p>
                    <p>Refund rules:</p>
                    <ul>
                        <li>Requests must be submitted within 24 hours of activation</li>
                        <li>Refunds apply only to first-time subscriptions</li>
                        <li>Renewals are not refundable</li>
                        <li>Refunds go back to the original payment method</li>
                    </ul>
                </section>
                
                <section id="usage">
                    <h2>6. Usage Rules</h2>
                    <p>You agree not to use the service for unlawful purposes or in a way that could damage, disable, or disrupt it. Prohibited activities include:</p>
                    <ul>
                        <li>Sharing credentials beyond allowed connections</li>
                        <li>Reselling or redistributing the service without authorization</li>
                        <li>Trying to bypass security controls</li>
                        <li>Recording or redistributing streamed content</li>
                        <li>Using VPNs or proxies to avoid geographic limits</li>
                    </ul>
                </section>
                
                <section id="termination">
                    <h2>7. Account Closure</h2>
                    <p>We may suspend or terminate your account immediately, without notice or liability, for any reason, including violating these terms.</p>
                    <p>After termination, your right to use the service ends immediately. We are not responsible for losses resulting from termination.</p>
                </section>
                
                <section id="liability">
                    <h2>8. Liability Limits</h2>
                    <p>4khdiptv, its directors, employees, and affiliates are not liable for indirect, incidental, special, consequential, or punitive damages from your use or inability to use the service.</p>
                    <p>Total liability will not exceed what you paid for the service in the 12 months before the claim.</p>
                </section>
                
                <section id="changes">
                    <h2>9. Policy Updates</h2>
                    <p>We may update these terms at any time. Updates take effect when posted. Continued use after changes means you accept the revised terms.</p>
                </section>
                
                <section id="contact">
                    <h2>10. Reach Us</h2>
                    <p>Questions about these terms? Contact us:</p>
                    <ul>
                        <li>Email: support@4khdiptv.org</li>
                        <li>Contact Form: <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </section>
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
    
    .legal-content {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 3rem;
        align-items: start;
    }
    
    .legal-nav {
        position: sticky;
        top: 120px;
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
    }
    
    .legal-nav h4 {
        font-family: var(--font-display);
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .legal-nav ul {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .legal-nav a {
        display: block;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: var(--gray-600);
        border-radius: var(--radius-md);
        transition: var(--transition-base);
    }
    
    .legal-nav a:hover {
        background: var(--primary-50);
        color: var(--primary-600);
    }
    
    .legal-main {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-md);
    }
    
    .legal-main section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .legal-main section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .legal-main h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }
    
    .legal-main p {
        color: var(--gray-600);
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    
    .legal-main ul {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }
    
    .legal-main li {
        color: var(--gray-600);
        margin-bottom: 0.5rem;
        list-style-type: disc;
    }
    
    .legal-main a {
        color: var(--primary-600);
    }
    
    .legal-main a:hover {
        text-decoration: underline;
    }
    
    @media (max-width: 1024px) {
        .legal-content {
            grid-template-columns: 1fr;
        }
        
        .legal-nav {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .page-hero-small {
            padding: 140px 0 40px;
        }
        
        .page-hero-small .page-title {
            font-size: 2rem;
        }
        
        .legal-main {
            padding: 1.5rem;
        }
    }
</style>
@endpush
@endsection
