@extends('layouts.app')

@section('title', 'Affiliate Partner Program - 4khdiptv')

@section('content')
<!-- Hero Section -->
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
                    <div class="wall-item netflix">EARN</div>
                    <div class="wall-item amazon">20%</div>
                    <div class="wall-item hbo">CASH</div>
                    <div class="wall-item disney">PROFIT</div>
                    <div class="wall-item espn">PAYOUT</div>
                    <div class="wall-item sky">REVENUE</div>
                    <div class="wall-item nfl">PARTNER</div>
                    <div class="wall-item">SHARE</div>
                    <div class="wall-item">CRYPTO</div>
                @endfor
            </div>
            @endfor
        </div>
    </div>
    
    <div class="container">
        <div class="hero-content" id="heroContent" style="grid-template-columns: 1fr; text-align: center; justify-items: center;">
            <div class="hero-text" data-aos="fade-up" data-aos-duration="1000" style="max-width: 900px; display: flex; flex-direction: column; align-items: center;">
                <h1 class="hero-title" style="margin-bottom: 1.5rem;">
                    Earn with Our 
                    <span class="text-gradient">Affiliate</span> 
                    <span class="text-gradient">Program</span>
                </h1>
                
                <div class="hero-subtitle-wrap" style="display: flex; flex-direction: column; align-items: center; gap: 14px; margin-bottom: 2.5rem;">
                    <span class="hero-subtitle-line" style="width: 40px; height: 4px; border-radius: 999px; background: linear-gradient(90deg, #C8A2FF 0%, #7A3CFF 100%);"></span>
                    <p class="hero-subtitle" style="margin: 0; text-align: center; max-width: 700px; font-size: 1.25rem;">
                        {{ __('Partner with us and earn a solid 20% commission on every verified referral. Join thousands of creators and marketers who are generating massive passive income with no limits or caps.') }}
                    </p>
                </div>
                
                <div class="hero-features" style="justify-content: center; width: 100%;">
                    <div class="hero-feature">
                        <i class="ph-fill ph-percent"></i>
                        <span>20% Per Sale</span>
                    </div>
                    <div class="hero-feature">
                        <i class="ph-fill ph-cookie"></i>
                        <span>30-Day Tracking</span>
                    </div>
                    <div class="hero-feature">
                        <i class="ph-fill ph-wallet"></i>
                        <span>Quick Payouts</span>
                    </div>
                </div>

                <div class="hero-cta" style="margin-top: 2.5rem; display: flex; justify-content: center; width: 100%;">
                    @auth
                        <a href="{{ route('profile') }}#affiliate" class="btn btn-primary btn-lg">
                            <i class="ph ph-chart-line-up"></i>
                            View Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="ph ph-rocket-launch"></i>
                            Join the Program
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-glass btn-lg">
                            <i class="ph ph-sign-in"></i>
                            Log In
                        </a>
                    @endauth
                </div>
                
                <div class="hero-trust" style="width: 100%;">
                    <div class="trust-badges" style="justify-content: center;">
                        <div class="trust-badge">
                            <i class="ph-fill ph-check-circle"></i>
                            <span>$50 Min Payout</span>
                        </div>
                        <div class="trust-badge">
                            <i class="ph-fill ph-clock"></i>
                            <span>Weekly Rewards</span>
                        </div>
                        <div class="trust-badge">
                            <i class="ph-fill ph-shield-check"></i>
                            <span>Fully Transparent</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" style="margin-top: 4rem;">
                <div class="hero-device">
                    <div class="device-frame" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 40px; padding: 40px;">
                        <div style="text-align: center; color: white;">
                            <div style="font-size: 6rem; margin-bottom: 1.5rem;">💎</div>
                            <div style="font-size: 4rem; font-weight: 900; background: linear-gradient(135deg, #FF6B95 0%, #7A3CFF 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">20%</div>
                            <div style="font-size: 1.5rem; font-weight: 700; opacity: 0.9; text-transform: uppercase; letter-spacing: 2px;">Commission</div>
                            
                            <div style="margin-top: 2rem; padding: 20px; background: rgba(0,0,0,0.3); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">
                                <div style="font-size: 0.9rem; opacity: 0.6; margin-bottom: 5px;">Average Monthly Income</div>
                                <div style="font-size: 2.5rem; font-weight: 800; color: #10B981;">$840.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="device-shadow"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section lavender-bg">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon">
                    <i class="ph-fill ph-percent"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">20%</span>
                    <span class="stat-label">Commission %</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="ph-fill ph-hourglass-medium"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">30</span>
                    <span class="stat-label">Cookie Length (days)</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">$50</span>
                    <span class="stat-label">Payout Minimum</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="ph-fill ph-lightning"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">24h</span>
                    <span class="stat-label">Quick Processing</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section lavender-bg" id="benefits">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Why Partner as an <span class="text-gradient">Affiliate?</span></h2>
            <p class="section-subtitle">
                See why creators and marketers choose our program
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <h3 class="feature-title">Strong Commissions</h3>
                <p class="feature-desc">Earn 20% on every successful sale. With premium packages, each referral can add up quickly.</p>
                <div class="feature-tags">
                    <span>20% Per Sale</span>
                    <span>No Caps</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-chart-line-up"></i>
                </div>
                <h3 class="feature-title">Live Tracking</h3>
                <p class="feature-desc">See clicks, conversions, and earnings in your dashboard in real time.</p>
                <div class="feature-tags">
                    <span>Live Stats</span>
                    <span>Insights</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-wallet"></i>
                </div>
                <h3 class="feature-title">Easy Payouts</h3>
                <p class="feature-desc">Request a payout once you reach $50. We support multiple methods, including crypto.</p>
                <div class="feature-tags">
                    <span>Crypto</span>
                    <span>Multiple Methods</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-cookie"></i>
                </div>
                <h3 class="feature-title">30-Day Cookie</h3>
                <p class="feature-desc">Cookies last 30 days, so you earn commission even if a referral buys later.</p>
                <div class="feature-tags">
                    <span>Long Duration</span>
                    <span>More Sales</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-link-simple"></i>
                </div>
                <h3 class="feature-title">Easy Sharing</h3>
                <p class="feature-desc">Get your referral link instantly. Share on social, websites, or directly with friends and family.</p>
                <div class="feature-tags">
                    <span>One Click</span>
                    <span>Easy Share</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-headset"></i>
                </div>
                <h3 class="feature-title">Dedicated Support</h3>
                <p class="feature-desc">Our affiliate support team helps you succeed with guidance and materials.</p>
                <div class="feature-tags">
                    <span>24/7 Help</span>
                    <span>Resources</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works-section lavender-bg">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Get Started in <span class="text-gradient">3 Steps</span></h2>
            <p class="section-subtitle">
                Start quickly and begin earning commissions
            </p>
        </div>
        
        <div class="steps-grid">
            <div class="step-card" data-aos="fade-up" data-aos-delay="0">
                <div class="step-number">
                    <span>01</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-user-plus"></i>
                </div>
                <h3 class="step-title">Create an Account</h3>
                <p class="step-desc">Sign up for a free account. Your dashboard activates automatically with your unique referral link.</p>
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
                    <i class="ph-fill ph-share-network"></i>
                </div>
                <h3 class="step-title">Promote Your Link</h3>
                <p class="step-desc">Share your unique link on social media, your site, email, or direct messages.</p>
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
                <h3 class="step-title">Earn 20% Per Sale</h3>
                <p class="step-desc">When someone buys through your link, you earn 20%. Track earnings and withdraw at $50.</p>
            </div>
        </div>
    </div>
</section>

<!-- Earning Calculator Section -->
<section class="devices-section lavender-bg">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Project Your <span class="text-gradient">Earnings</span></h2>
            <p class="section-subtitle">
                See what you could earn with our affiliate program
            </p>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            <div style="background: var(--white); border-radius: var(--radius-2xl); padding: 3rem; border: 1px solid var(--gray-100); box-shadow: var(--shadow-lg);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; text-align: center;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0.5rem; font-weight: 500;">Typical Package Price</div>
                        <div style="font-size: 2rem; font-weight: 800; color: var(--gray-900);">$50</div>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0.5rem; font-weight: 500;">Your Commission (20%)</div>
                        <div style="font-size: 2rem; font-weight: 800; color: var(--primary-500);">$10</div>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0.5rem; font-weight: 500;">10 Sales per Month</div>
                        <div style="font-size: 2rem; font-weight: 800; color: var(--success);">$100</div>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--gray-100);">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                        <div style="text-align: center; padding: 1rem; background: var(--gray-50); border-radius: var(--radius-lg);">
                            <div style="font-size: 0.75rem; color: var(--gray-500); margin-bottom: 0.25rem;">5 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900);">$50/mo</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: var(--primary-50); border-radius: var(--radius-lg); border: 2px solid var(--primary-200);">
                            <div style="font-size: 0.75rem; color: var(--primary-600); margin-bottom: 0.25rem;">20 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--primary-600);">$200/mo</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: var(--gray-50); border-radius: var(--radius-lg);">
                            <div style="font-size: 0.75rem; color: var(--gray-500); margin-bottom: 0.25rem;">50 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900);">$500/mo</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: var(--gray-50); border-radius: var(--radius-lg);">
                            <div style="font-size: 0.75rem; color: var(--gray-500); margin-bottom: 0.25rem;">100 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--success);">$1000/mo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section lavender-bg" id="faq">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Affiliate <span class="text-gradient">FAQ</span></h2>
                <p class="section-subtitle">
                    The key details about our affiliate program
                </p>
        </div>
        
        <div class="faq-grid" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How much can I earn?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>You earn 20% on every sale through your referral link. There is no cap on earnings - refer more and earn more. Top affiliates earn over $1,000 per month.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How and when do I get paid?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Once your available balance reaches $50, you can request a payout. We support cryptocurrency (Bitcoin, USDT) and other methods. Payouts are processed within 24-48 hours.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How long do cookies last?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Affiliate cookies last 30 days. If someone clicks your link and buys within 30 days, you receive commission even if they do not buy immediately.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Is there any cost to join?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>No. Joining the affiliate program is free. Create an account and you get access to your dashboard and unique referral link.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How do I track referrals and earnings?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Your affiliate dashboard shows real-time tracking for referrals, clicks, conversions, and earnings. You can view detailed stats and monitor performance anytime.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Can I promote on social media?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely. Share your referral link on social media, YouTube, blogs, forums, or any legitimate marketing channel. Follow platform guidelines.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-bg">
        <div class="cta-gradient"></div>
        <div class="cta-pattern"></div>
    </div>
    
    <div class="container">
        <div class="cta-content" data-aos="zoom-in">
            <h2 class="cta-title">Ready to <span class="text-gradient">Earn?</span></h2>
            <p class="cta-subtitle">Join thousands of affiliates and start earning passive income today.</p>
            
            <div class="cta-features">
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Free to Join</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>20% Commission</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Fast Payouts</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Real-Time Tracking</span>
                </div>
            </div>
            
            <div class="cta-buttons">
                @auth
                    <a href="{{ route('profile') }}#affiliate" class="btn btn-white btn-lg">
                        <i class="ph-fill ph-chart-line-up"></i>
                        View Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-white btn-lg">
                        <i class="ph-fill ph-rocket-launch"></i>
                        Join the Program
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-white btn-lg">
                        <i class="ph ph-sign-in"></i>
                        Log In
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@push('styles')
<style>
    .stats-section, .features-section, .how-it-works-section, .devices-section, .faq-section {
        background: var(--bg-void) !important;
    }
    
    .stat-card, .feature-card, .step-card, .faq-item {
        background: rgba(18, 24, 38, 0.4) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        border-radius: var(--radius-xl);
    }
    
    .stat-number, .feature-title, .step-title, .faq-question span, .section-title {
        color: var(--text-high) !important;
    }
    
    .stat-label, .feature-desc, .step-desc, .faq-answer p, .section-subtitle {
        color: var(--text-low) !important;
    }

    .devices-section div[style*="background: var(--white)"] {
        background: rgba(18, 24, 38, 0.4) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
    }

    .devices-section div[style*="color: var(--gray-900)"] {
        color: var(--text-high) !important;
    }

    .devices-section div[style*="background: var(--gray-50)"] {
        background: rgba(255, 255, 255, 0.03) !important;
    }
</style>
@endpush
@endsection
