@extends('layouts.app')

@section('title', 'Privacy Notice - 4khdiptv')

@section('content')
<!-- Page Hero -->
<section class="page-hero-small">
    <div class="container">
        <h1 class="page-title">Privacy Notice</h1>
        <p class="page-subtitle">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<!-- Content -->
<section class="legal-section">
    <div class="container">
        <div class="legal-content" data-aos="fade-up">
            <div class="legal-nav">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#introduction">1. Overview</a></li>
                    <li><a href="#collection">2. Data We Collect</a></li>
                    <li><a href="#use">3. How We Use Data</a></li>
                    <li><a href="#sharing">4. When We Share</a></li>
                    <li><a href="#security">5. How We Protect Data</a></li>
                    <li><a href="#cookies">6. Cookies and Tracking</a></li>
                    <li><a href="#rights">7. Your Privacy Rights</a></li>
                    <li><a href="#retention">8. Retention Periods</a></li>
                    <li><a href="#children">9. Children and Privacy</a></li>
                    <li><a href="#contact">10. Contact</a></li>
                </ul>
            </div>
            
            <div class="legal-main">
                <section id="introduction">
                    <h2>1. Overview</h2>
                    <p>4khdiptv ("we," "our," or "us") values your privacy. This notice explains how we collect, use, share, and protect information when you use our IPTV streaming services.</p>
                    <p>By using our services, you agree to the practices described here. If you do not agree, please do not access or use our services.</p>
                </section>
                
                <section id="collection">
                    <h2>2. Data We Collect</h2>
                    <p>We may collect the following categories of information:</p>
                    
                    <h3>Personal Details</h3>
                    <ul>
                        <li>Name and email address</li>
                        <li>Billing details and payment information</li>
                        <li>Contact details (phone number, messaging app IDs)</li>
                        <li>Account credentials</li>
                    </ul>
                    
                    <h3>Technical Details</h3>
                    <ul>
                        <li>IP address and device identifiers</li>
                        <li>Browser type and version</li>
                        <li>Device type and operating system</li>
                        <li>Usage data and viewing preferences</li>
                    </ul>
                </section>
                
                <section id="use">
                    <h2>3. How We Use Data</h2>
                    <p>We use collected information to:</p>
                    <ul>
                        <li>Provide and maintain our services</li>
                        <li>Process transactions and send related updates</li>
                        <li>Deliver service-related communications</li>
                        <li>Provide customer support</li>
                        <li>Improve and personalize your experience</li>
                        <li>Detect and prevent fraud or abuse</li>
                        <li>Comply with legal obligations</li>
                    </ul>
                </section>
                
                <section id="sharing">
                    <h2>4. When We Share</h2>
                    <p>We do not sell, trade, or rent personal information. We may share information only in these situations:</p>
                    <ul>
                        <li><strong>Service Providers:</strong> Vendors that help deliver our services (payment processors, hosting providers)</li>
                        <li><strong>Legal Requirements:</strong> When required by law or to respond to legal process</li>
                        <li><strong>Protection:</strong> To protect rights, privacy, safety, or property</li>
                        <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or asset sale</li>
                    </ul>
                </section>
                
                <section id="security">
                    <h2>5. How We Protect Data</h2>
                    <p>We use technical and organizational measures to protect your information, including:</p>
                    <ul>
                        <li>256-bit SSL encryption for data transmission</li>
                        <li>Secure password hashing</li>
                        <li>Regular security reviews</li>
                        <li>Access controls and authentication</li>
                        <li>Secure data storage practices</li>
                    </ul>
                    <p>No method of transmission over the Internet is 100% secure, and we cannot guarantee absolute security.</p>
                </section>
                
                <section id="cookies">
                    <h2>6. Cookies and Tracking</h2>
                    <p>We use cookies and similar technologies to improve your experience. Cookies are small files stored on your device that help us:</p>
                    <ul>
                        <li>Remember preferences and settings</li>
                        <li>Understand how the service is used</li>
                        <li>Improve the service based on usage patterns</li>
                        <li>Provide personalized content</li>
                    </ul>
                    <p>You can manage cookies through your browser settings. Disabling cookies may affect functionality.</p>
                </section>
                
                <section id="rights">
                    <h2>7. Your Privacy Rights</h2>
                    <p>Depending on your location, you may have rights related to your personal information, including:</p>
                    <ul>
                        <li><strong>Access:</strong> Request access to your personal data</li>
                        <li><strong>Correction:</strong> Request correction of inaccurate data</li>
                        <li><strong>Deletion:</strong> Request deletion of your personal data</li>
                        <li><strong>Portability:</strong> Request transfer of your data</li>
                        <li><strong>Objection:</strong> Object to processing of your data</li>
                        <li><strong>Withdrawal:</strong> Withdraw consent at any time</li>
                    </ul>
                    <p>To exercise these rights, contact us using the details below.</p>
                </section>
                
                <section id="retention">
                    <h2>8. Retention Periods</h2>
                    <p>We keep personal information only as long as needed for the purposes described here, unless a longer period is required by law.</p>
                    <p>When your account is closed, we delete or anonymize personal information within a reasonable timeframe unless legal or business needs require retention.</p>
                </section>
                
                <section id="children">
                    <h2>9. Children and Privacy</h2>
                    <p>Our services are not intended for individuals under 18. We do not knowingly collect personal information from children. If you are a parent or guardian and believe a child has provided us personal information, contact us immediately.</p>
                </section>
                
                <section id="contact">
                    <h2>10. Contact</h2>
                    <p>Questions about this privacy notice or our data practices? Contact us:</p>
                    <ul>
                        <li>Email: privacy@4khdiptv.org</li>
                        <li>Support: support@4khdiptv.org</li>
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
    
    .legal-main h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-800);
        margin: 1.5rem 0 0.75rem;
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
