@extends('layouts.app')

@section('title', 'Reseller Program - 4khdiptv')

@section('content')
<!-- Page Hero Section -->
<section class="hero" id="heroSection">
    <div class="hero-bg" id="heroBg">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
        <div class="hero-glow hero-glow-1"></div>
        <div class="hero-glow hero-glow-2"></div>
        
        <!-- Animated Channel Wall Background -->
        <div class="hero-channel-wall">
            @for($r = 0; $r < 4; $r++)
            <div class="channel-wall-row">
                @for($i = 0; $i < 2; $i++)
                    <div class="wall-item netflix">RESELLER</div>
                    <div class="wall-item amazon">PANEL</div>
                    <div class="wall-item hbo">PROFIT</div>
                    <div class="wall-item disney">CREDITS</div>
                    <div class="wall-item espn">STABLE</div>
                    <div class="wall-item sky">BRANDED</div>
                    <div class="wall-item nfl">DIRECT</div>
                    <div class="wall-item">BUSINESS</div>
                    <div class="wall-item">24/7</div>
                @endfor
            </div>
            @endfor
        </div>
    </div>
    
    <div class="container">
        <div class="hero-content" id="heroContent" style="grid-template-columns: 1fr; text-align: center; justify-items: center;">
            <div class="hero-text" data-aos="fade-up" data-aos-duration="1000" style="max-width: 900px; display: flex; flex-direction: column; align-items: center;">
                <div class="hero-badge" style="background: rgba(122, 60, 255, 0.2); border: 1px solid rgba(122, 60, 255, 0.3); padding: 8px 16px; border-radius: 99px; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 2rem; color: #C8A2FF; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
                    <i class="ph-fill ph-briefcase"></i>
                    <span>Partner Track</span>
                </div>
                
                <h1 class="hero-title" style="margin-bottom: 1.5rem;">
                    Build an IPTV 
                    <span class="text-gradient">Reseller</span> 
                    <span class="text-gradient">Business</span>
                </h1>
                
                <div class="hero-subtitle-wrap" style="display: flex; flex-direction: column; align-items: center; gap: 14px; margin-bottom: 2.5rem;">
                    <span class="hero-subtitle-line" style="width: 40px; height: 4px; border-radius: 999px; background: linear-gradient(90deg, #C8A2FF 0%, #7A3CFF 100%);"></span>
                    <p class="hero-subtitle" style="margin: 0; text-align: center; max-width: 700px; font-size: 1.25rem;">
                        {{ __('Launch your high-margin IPTV business today with our professional reseller panel. Gain access to wholesale pricing, 20,000+ stable channels, and 24/7 dedicated support to scale your empire.') }}
                    </p>
                </div>
                
                <div class="hero-features" style="justify-content: center; width: 100%;">
                    <div class="hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>White-Label Panel</span>
                    </div>
                    <div class="hero-feature">
                        <i class="ph-fill ph-chart-line-up"></i>
                        <span>High Margins</span>
                    </div>
                    <div class="hero-feature">
                        <i class="ph-fill ph-lightning"></i>
                        <span>Instant Delivery</span>
                    </div>
                </div>
                
                <div class="hero-cta" style="margin-top: 2.5rem; display: flex; justify-content: center; width: 100%;">
                    <a href="#reseller-packages" class="btn btn-primary btn-lg">
                        <i class="ph ph-shopping-cart"></i>
                        See Reseller Packages
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-glass btn-lg">
                        <i class="ph ph-chat-circle-text"></i>
                        Contact Sales
                    </a>
                </div>

                <div class="hero-trust" style="width: 100%;">
                    <div class="trust-badges" style="justify-content: center;">
                        <div class="trust-badge">
                            <i class="ph-fill ph-shield-check"></i>
                            <span>Stable Servers</span>
                        </div>
                        <div class="trust-badge">
                            <i class="ph-fill ph-headset"></i>
                            <span>24/7 VIP Help</span>
                        </div>
                        <div class="trust-badge">
                            <i class="ph-fill ph-globe"></i>
                            <span>Global Library</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" style="margin-top: 4rem;">
                <div class="hero-device">
                    <div class="device-frame" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 40px; padding: 30px;">
                        <div class="reseller-stats-grid">
                            <div class="stat-item" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1);">
                                <span class="stat-value" style="color: #C8A2FF;">$10K+</span>
                                <span class="stat-label">Profit / mo</span>
                            </div>
                            <div class="stat-item" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1);">
                                <span class="stat-value" style="color: #10B981;">99.9%</span>
                                <span class="stat-label">Server Uptime</span>
                            </div>
                            <div class="stat-item" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1);">
                                <span class="stat-value" style="color: #C8A2FF;">24/7</span>
                                <span class="stat-label">Expert Support</span>
                            </div>
                            <div class="stat-item" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1);">
                                <span class="stat-value" style="color: #10B981;">Manual</span>
                                <span class="stat-label">Management</span>
                            </div>
                        </div>
                        <div style="margin-top: 1.5rem; text-align: center;">
                            <span style="font-size: 0.8rem; opacity: 0.5; text-transform: uppercase; letter-spacing: 1px;">Partner Dashboard v4.2</span>
                        </div>
                    </div>
                    <div class="device-shadow"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Become a Reseller Section -->
<section class="reseller-benefits-section lavender-bg">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Why Join Our <span class="text-gradient">Reseller Network?</span></h2>
            <p class="section-subtitle">
                Build a profitable IPTV business with our reseller platform
            </p>
        </div>
        
        <div class="benefits-grid">
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="0">
                <div class="benefit-icon">
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <h3 class="benefit-title">Big Margins</h3>
                <p class="benefit-desc">
                    Set your own prices and earn up to 60% profit on each sale.
                    With wholesale rates, your earning potential is unlimited.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="100">
                <div class="benefit-icon cyan">
                    <i class="ph-fill ph-desktop-tower"></i>
                </div>
                <h3 class="benefit-title">White-Label Panel</h3>
                <p class="benefit-desc">
                    Get a branded reseller panel with your logo and domain.
                    Your customers will not see our branding.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="200">
                <div class="benefit-icon green">
                    <i class="ph-fill ph-lightning"></i>
                </div>
                <h3 class="benefit-title">Instant Delivery</h3>
                <p class="benefit-desc">
                    Create subscriptions instantly with our automated panel.
                    Your customers receive credentials right after purchase.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="300">
                <div class="benefit-icon purple">
                    <i class="ph-fill ph-chart-pie-slice"></i>
                </div>
                <h3 class="benefit-title">Simple Credit System</h3>
                <p class="benefit-desc">
                    Our credit system makes managing subscriptions simple.
                    Buy credits in bulk and create subs anytime.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="400">
                <div class="benefit-icon orange">
                    <i class="ph-fill ph-headset"></i>
                </div>
                <h3 class="benefit-title">24/7 Support</h3>
                <p class="benefit-desc">
                    Get dedicated reseller support around the clock.
                    We are always here to help you grow your business.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="500">
                <div class="benefit-icon">
                    <i class="ph-fill ph-shield-checkered"></i>
                </div>
                <h3 class="benefit-title">Premium Content</h3>
                <p class="benefit-desc">
                    Offer 20,000+ channels and 50,000+ VOD in HD/4K quality.
                    Give your customers the best streaming experience.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="reseller-steps-section lavender-bg">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Launch in <span class="text-gradient">3 Steps</span></h2>
            <p class="section-subtitle">
                Starting as a reseller is fast and straightforward
            </p>
        </div>
        
        <div class="steps-grid">
            <div class="step-card" data-aos="fade-up" data-aos-delay="0">
                <div class="step-number">
                    <span>01</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-shopping-cart-simple"></i>
                </div>
                <h3 class="step-title">Buy Credits</h3>
                <p class="step-desc">Choose a reseller package and purchase credits. More credits = better pricing per subscription.</p>
            </div>
            
            <div class="step-connector">
                <div class="connector-line"></div>
                <div class="connector-arrow"><i class="ph-bold ph-arrow-right"></i></div>
            </div>
            
            <div class="step-card" data-aos="fade-up" data-aos-delay="200">
                <div class="step-number">
                    <span>02</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-user-plus"></i>
                </div>
                <h3 class="step-title">Create Subscriptions</h3>
                <p class="step-desc">Use our panel to create and manage subscriptions for your customers instantly.</p>
            </div>
            
            <div class="step-connector">
                <div class="connector-line"></div>
                <div class="connector-arrow"><i class="ph-bold ph-arrow-right"></i></div>
            </div>
            
            <div class="step-card" data-aos="fade-up" data-aos-delay="400">
                <div class="step-number">
                    <span>03</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-money"></i>
                </div>
                <h3 class="step-title">Keep Profits</h3>
                <p class="step-desc">Sell at your own price and keep the profits. Your business, your rules.</p>
            </div>
        </div>
    </div>
</section>

<!-- Reseller Packages Section -->
<section class="reseller-packages-section lavender-bg" id="reseller-packages">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Select a <span class="text-gradient">Reseller Package</span></h2>
            <p class="section-subtitle">
                Start with any package and scale as your business grows. Credits never expire.
            </p>
        </div>
        
        @if($packages->count() > 0)
        <div class="reseller-packages-grid" data-aos="fade-up" data-aos-delay="100">
            @foreach($packages as $package)
            <div class="reseller-pricing-card {{ $package->is_popular ? 'popular' : '' }}">
                @if($package->is_popular)
                <div class="popular-badge">
                    <i class="ph-fill ph-crown"></i>
                    Best Value
                </div>
                @endif
                
                <div class="pricing-header">
                    <h3 class="plan-name">{{ $package->name }}</h3>
                    <p class="plan-credits">Credit Package</p>
                </div>
                
                <div class="pricing-price">
                    <span class="current-price">
                        <span class="currency">$</span>
                        <span class="amount">{{ number_format($package->price, 0) }}</span>
                    </span>
                    <span class="period">one-time</span>
                </div>
                
                <ul class="pricing-features">
                    @foreach($package->features as $feature)
                        <li><i class="ph-fill ph-check-circle"></i> {{ $feature->name }}</li>
                    @endforeach
                    @if($package->features->isEmpty())
                        <li><i class="ph-fill ph-check-circle"></i> Full Reseller Panel Access</li>
                        <li><i class="ph-fill ph-check-circle"></i> Unlimited Trial Accounts</li>
                        <li><i class="ph-fill ph-check-circle"></i> 24/7 Priority Support</li>
                        <li><i class="ph-fill ph-check-circle"></i> Credits Never Expire</li>
                        <li><i class="ph-fill ph-check-circle"></i> White-Label Branding</li>
                        <li><i class="ph-fill ph-check-circle"></i> Detailed Analytics</li>
                    @endif
                </ul>
                
                <a href="{{ route('checkout.show', $package->slug) }}" class="btn {{ $package->is_popular ? 'btn-primary' : 'btn-outline' }} btn-block">
                    <i class="ph ph-shopping-cart"></i>
                    Start Selling
                </a>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State - No Packages Available -->
        <div class="empty-packages-state" data-aos="fade-up">
            <div class="empty-state-card">
                <div class="empty-state-icon">
                    <i class="ph-duotone ph-package"></i>
                </div>
                <h3 class="empty-state-title">Reseller Packages Coming Soon</h3>
                <p class="empty-state-desc">
                    We are preparing reseller packages.
                    Please check back soon or contact us for custom options.
                </p>
                <div class="empty-state-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                        <i class="ph ph-chat-circle-text"></i>
                        Contact Sales
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline btn-lg">
                        <i class="ph ph-house"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="reseller-faq-section lavender-bg">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Reseller <span class="text-gradient">Questions</span></h2>
            <p class="section-subtitle">
                Answers to common reseller questions
            </p>
        </div>
        
        <div class="faq-grid" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How does the credit system work?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Each subscription uses a set number of credits. For example, 1 month = 1 credit, 3 months = 2 credits, and so on. You purchase credits in bulk at wholesale pricing and use them to create subscriptions. The more credits you buy, the lower the cost per credit.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do credits expire?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>No. Credits never expire. Use them whenever you want, at your own pace. This gives you flexibility to grow your business.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Can I set my own prices?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes. You set your own prices. Many resellers sell subscriptions at 50-100% markup and keep all profits.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Is the reseller panel white-labeled?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes. The reseller panel is fully white-labeled. Your customers will not see our branding. Add your logo, domain, and customize the look and feel.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What support do resellers get?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>All resellers get 24/7 priority support via a dedicated channel. We also provide training, marketing materials, and technical assistance to help you succeed.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How quickly can I start selling?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Immediately. Once you purchase credits, you get instant access to your reseller panel. You can start creating and selling subscriptions right away.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="reseller-cta-section lavender-bg">
    <div class="container">
        <div class="cta-card" data-aos="fade-up">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Launch Your IPTV Business?</h2>
                <p class="cta-desc">Join hundreds of resellers earning with 4khdiptv. Get started today.</p>
                <div class="cta-buttons">
                    <a href="#reseller-packages" class="btn btn-white btn-lg">
                        <i class="ph ph-rocket-launch"></i>
                        Start Now
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-glass-white btn-lg">
                        <i class="ph ph-whatsapp-logo"></i>
                        Contact Sales
                    </a>
                </div>
            </div>
            <div class="cta-visual">
                <div class="cta-icon">
                    <i class="ph-fill ph-handshake"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ── Reseller page: override lavender-bg to match site dark theme ── */
.lavender-bg {
    background: #020408 !important;
    background-image:
        radial-gradient(ellipse at 0% 50%, rgba(124, 58, 237, 0.08) 0%, transparent 60%),
        radial-gradient(ellipse at 100% 50%, rgba(219, 39, 119, 0.05) 0%, transparent 60%) !important;
}

/* ── Global text visibility: all headings → white ── */
.lavender-bg .section-title,
.lavender-bg .benefit-title,
.lavender-bg .step-title,
.lavender-bg .plan-name,
.lavender-bg .empty-state-title,
.lavender-bg h1, .lavender-bg h2, .lavender-bg h3, .lavender-bg h4 {
    color: #ffffff !important;
}

/* ── Body/paragraph text → readable off-white ── */
.lavender-bg .section-subtitle,
.lavender-bg .benefit-desc,
.lavender-bg .step-desc,
.lavender-bg .plan-credits,
.lavender-bg .period,
.lavender-bg .empty-state-desc,
.lavender-bg p, .lavender-bg li, .lavender-bg span {
    color: rgba(255, 255, 255, 0.75) !important;
}

/* ── Pricing card amounts ── */
.lavender-bg .current-price,
.lavender-bg .amount,
.lavender-bg .currency {
    color: #ffffff !important;
}

/* ── Pricing features list ── */
.lavender-bg .pricing-features li {
    color: rgba(255, 255, 255, 0.8) !important;
}
.lavender-bg .pricing-features i {
    color: #a78bfa !important;
}

/* ── FAQ questions and answers — white bg cards → dark text ── */
.lavender-bg .faq-question {
    color: #111111 !important;
    background: rgba(255,255,255,0.95) !important;
    border-color: rgba(0,0,0,0.08) !important;
}
.lavender-bg .faq-question span {
    color: #111111 !important;
}
.lavender-bg .faq-question i {
    color: #7c3aed !important;
}
.lavender-bg .faq-question:hover {
    background: #ffffff !important;
    border-color: rgba(124,58,237,0.3) !important;
}
.lavender-bg .faq-answer p {
    color: #333333 !important;
}
.lavender-bg .faq-item {
    border-color: rgba(0,0,0,0.08) !important;
}

/* ── Step cards — white bg cards → dark text ── */
.lavender-bg .step-card {
    background: rgba(255,255,255,0.97) !important;
    border: 1px solid rgba(0,0,0,0.06) !important;
}
.lavender-bg .step-title {
    color: #111111 !important;
}
.lavender-bg .step-desc {
    color: #444444 !important;
}
.lavender-bg .step-title span,
.lavender-bg .step-card span,
.lavender-bg .step-card p {
    color: #444444 !important;
}

/* ── Custom package note ── */
.lavender-bg .custom-package-note {
    background: rgba(124, 58, 237, 0.08) !important;
    border: 1px solid rgba(124, 58, 237, 0.2) !important;
    color: rgba(255,255,255,0.75) !important;
}
.lavender-bg .custom-package-note a {
    color: #c4b5fd !important;
}
.lavender-bg .custom-package-note i {
    color: #a78bfa !important;
}

/* ── Pricing card on dark bg ── */
.lavender-bg .reseller-pricing-card {
    background: rgba(18, 24, 38, 0.6) !important;
    border-color: rgba(255,255,255,0.07) !important;
}
.lavender-bg .reseller-pricing-card.popular {
    background: linear-gradient(180deg, rgba(124,58,237,0.2), rgba(10,13,20,0.9)) !important;
    border-color: rgba(124,58,237,0.3) !important;
}

/* ── Benefit card on dark bg ── */
.lavender-bg .benefit-card {
    background: rgba(18, 24, 38, 0.5) !important;
    border-color: rgba(255,255,255,0.06) !important;
}

/* Reseller Stats Card in Hero */
.reseller-stats-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-2xl);
    padding: 2rem;
    width: 100%;
    max-width: 420px;
}

.reseller-stats-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    color: var(--white);
    font-weight: 600;
}

.reseller-stats-header .stats-icon {
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.reseller-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

.reseller-stats-grid .stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.reseller-stats-grid .stat-value {
    display: block;
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--secondary-400);
    margin-bottom: 0.25rem;
}

.reseller-stats-grid .stat-label {
    font-size: 0.8125rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Benefits Section */
.reseller-benefits-section {
    padding: 5rem 0;
    background: var(--bg-void);
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.benefit-card {
    background: rgba(18, 24, 38, 0.4);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: var(--radius-xl);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all var(--transition-base);
}

.benefit-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: transparent;
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: var(--white);
    margin-bottom: 1.25rem;
}

.benefit-icon.cyan {
    background: linear-gradient(135deg, var(--secondary-500), var(--secondary-600));
}

.benefit-icon.green {
    background: linear-gradient(135deg, #10b981, #059669);
}

.benefit-icon.purple {
    background: linear-gradient(135deg, #8b5cf6, #6d28d9);
}

.benefit-icon.orange {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.benefit-title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-high);
    margin-bottom: 0.75rem;
}

.benefit-desc {
    font-size: 0.9375rem;
    color: var(--text-low);
    line-height: 1.6;
}

/* Steps Section */
.reseller-steps-section {
    padding: 5rem 0;
    background: var(--bg-void);
}

/* Reseller Packages Section */
.reseller-packages-section {
    padding: 5rem 0 6rem;
    background: var(--bg-void);
}

.reseller-packages-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

.reseller-pricing-card {
    position: relative;
    background: rgba(18, 24, 38, 0.4);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-xl);
    padding: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: all var(--transition-base);
}

.reseller-pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.reseller-pricing-card.popular {
    background: linear-gradient(180deg, var(--gray-900) 0%, var(--black) 100%);
    border-color: transparent;
    transform: scale(1.05);
}

.reseller-pricing-card.popular:hover {
    transform: scale(1.05) translateY(-10px);
}

.reseller-pricing-card.popular .plan-name,
.reseller-pricing-card.popular .plan-credits,
.reseller-pricing-card.popular .pricing-features li,
.reseller-pricing-card.popular .current-price,
.reseller-pricing-card.popular .period {
    color: var(--white);
}

.reseller-pricing-card.popular .pricing-features i {
    color: var(--secondary-400);
}

.custom-package-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
    padding: 1rem;
    background: var(--primary-50);
    border-radius: var(--radius-lg);
    font-size: 0.9375rem;
    color: var(--gray-700);
}

.custom-package-note i {
    font-size: 1.25rem;
    color: var(--primary-600);
}

.custom-package-note a {
    color: var(--primary-600);
    font-weight: 600;
    text-decoration: underline;
}

/* FAQ Section */
.reseller-faq-section {
    padding: 5rem 0;
    background: var(--bg-void);
}

/* CTA Section */
.reseller-cta-section {
    padding: 5rem 0 6rem;
    background: var(--bg-void);
}

.cta-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 3rem;
    background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
    border-radius: var(--radius-2xl);
    padding: 4rem;
    position: relative;
    overflow: hidden;
}

.cta-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 60%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.cta-content {
    position: relative;
    z-index: 1;
    flex: 1;
}

.cta-title {
    font-family: var(--font-display);
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 0.75rem;
}

.cta-desc {
    font-size: 1.125rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 2rem;
    max-width: 500px;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
}

.btn-white {
    background: var(--white);
    color: var(--primary-600);
    font-weight: 600;
}

.btn-white:hover {
    background: var(--gray-100);
    transform: translateY(-2px);
}

.btn-glass-white {
    background: rgba(255, 255, 255, 0.15);
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.btn-glass-white:hover {
    background: rgba(255, 255, 255, 0.25);
}

/* Empty State Styling */
.empty-state-card {
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(18, 24, 38, 0.4);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-2xl);
    border: 1px solid rgba(255, 255, 255, 0.05);
    max-width: 600px;
    margin: 0 auto;
}

.empty-state-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, var(--primary-50), var(--primary-100));
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--primary-600);
    margin: 0 auto 1.5rem;
}

.empty-state-title {
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-high);
    margin-bottom: 0.75rem;
}

.empty-state-desc {
    font-size: 1.0625rem;
    color: var(--text-low);
    line-height: 1.6;
    margin-bottom: 2rem;
    max-width: 450px;
    margin-left: auto;
    margin-right: auto;
}

.empty-state-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-visual {
    position: relative;
    z-index: 1;
}

.cta-icon {
    width: 140px;
    height: 140px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: var(--white);
}

/* Responsive */
@media (max-width: 1024px) {
    .benefits-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .reseller-packages-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
    }
    
    .reseller-pricing-card.popular {
        transform: none;
    }
    
    .reseller-pricing-card.popular:hover {
        transform: translateY(-10px);
    }
}

@media (max-width: 768px) {
    .page-hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .page-hero-text {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .page-hero-features {
        justify-content: center;
    }
    
    .hero-cta {
        flex-direction: column;
        width: 100%;
    }
    
    .hero-cta .btn {
        width: 100%;
    }
    
    .reseller-stats-card {
        max-width: 100%;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .steps-grid {
        flex-direction: column;
    }
    
    .step-connector {
        transform: rotate(90deg);
        margin: 1rem 0;
    }
    
    .cta-card {
        flex-direction: column;
        text-align: center;
        padding: 2.5rem;
    }
    
    .cta-content {
        text-align: center;
    }
    
    .cta-desc {
        margin-left: auto;
        margin-right: auto;
    }
    
    .cta-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .cta-buttons .btn {
        width: 100%;
    }
}
</style>
@endsection
