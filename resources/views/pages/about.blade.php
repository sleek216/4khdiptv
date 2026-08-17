@extends('layouts.app')

@section('title', 'About 4khdiptv')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="hero-bg">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
    </div>
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <span class="section-badge">
                <i class="ph-fill ph-users"></i>
                Who We Are
            </span>
            <h1 class="page-title">Entertainment <span class="text-gradient">Without Borders</span></h1>
            <p class="page-subtitle">
                Bringing premium entertainment to viewers worldwide
            </p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="about-section">
    <div class="container">
        <!-- Story -->
        <div class="about-block" data-aos="fade-up">
            <div class="about-content">
                <span class="badge">Our Story</span>
                <h2>How We Started</h2>
                <p>
                    4khdiptv is a leading IPTV provider focused on delivering a premium streaming
                    experience for customers worldwide. Built on innovation and customer satisfaction,
                    we have grown into a trusted name in IPTV.
                </p>
                <p>
                    Our team works continuously to deliver top live channels, movies, and series from
                    around the globe. We believe great entertainment should not carry the high cost
                    of traditional cable.
                </p>
            </div>
            <div class="about-image">
                <div class="image-box">
                    <i class="ph-fill ph-globe"></i>
                </div>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="stats-row" data-aos="fade-up">
            <div class="stat-item">
                <span class="stat-number">20K+</span>
                <span class="stat-label">Live Channels</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50K+</span>
                <span class="stat-label">On-Demand Titles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">150+</span>
                <span class="stat-label">Countries Reached</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">100K+</span>
                <span class="stat-label">Active Viewers</span>
            </div>
        </div>
        
        <!-- Mission -->
        <div class="about-block reverse" data-aos="fade-up">
            <div class="about-content">
                <span class="badge">Our Mission</span>
                <h2>What We Stand For</h2>
                <p>
                    Our mission is to deliver affordable, high-quality IPTV that brings global
                    entertainment straight to your home. We focus on:
                </p>
                <ul class="mission-list">
                    <li>
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Delivering crisp HD and 4K streaming quality</span>
                    </li>
                    <li>
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Providing 24/7 support in multiple languages</span>
                    </li>
                    <li>
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Expanding our channel library continuously</span>
                    </li>
                    <li>
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Keeping pricing competitive and transparent</span>
                    </li>
                    <li>
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Keeping streams stable with anti-freeze technology</span>
                    </li>
                </ul>
            </div>
            <div class="about-image">
                <div class="image-box">
                    <i class="ph-fill ph-target"></i>
                </div>
            </div>
        </div>
        
        <!-- Features Grid -->
        <div class="features-grid" data-aos="fade-up">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="ph-fill ph-shield-check"></i>
                </div>
                <h3>Always On</h3>
                <p>99.9% uptime with redundant servers worldwide</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="ph-fill ph-lightning"></i>
                </div>
                <h3>Quick Activation</h3>
                <p>Instant activation after payment - start watching in minutes</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="ph-fill ph-headset"></i>
                </div>
                <h3>All-Day Support</h3>
                <p>Expert support team available around the clock</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="ph-fill ph-devices"></i>
                </div>
                <h3>Device Freedom</h3>
                <p>Works with Smart TVs, phones, tablets, and more</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="about-cta">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of viewers enjoying premium entertainment</p>
            <div class="cta-buttons">
                <a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg">
                    <i class="ph ph-shopping-cart"></i>
                    See Plans
                </a>
                <a href="{{ route('packages.index') }}?duration=trial" class="btn btn-white btn-lg">
                    <i class="ph ph-play-circle"></i>
                    Start Trial
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .page-hero {
        position: relative;
        padding: 180px 0 80px;
        text-align: center;
        overflow: hidden;
    }
    
    .page-hero .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
    }
    
    .page-hero .hero-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #0a0f1a 0%, #0d1525 50%, #0a0f1a 100%);
    }
    
    .page-hero .hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(rgba(0, 102, 255, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.5;
    }
    
    .page-hero-content {
        max-width: 700px;
        margin: 0 auto;
        color: var(--white);
    }
    
    .page-title {
        font-family: var(--font-display);
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 1rem;
    }
    
    .page-subtitle {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .about-section {
        padding: 5rem 0;
        background: var(--gray-50);
    }
    
    .about-block {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        margin-bottom: 4rem;
    }
    
    .about-block.reverse {
        direction: rtl;
    }
    
    .about-block.reverse > * {
        direction: ltr;
    }
    
    .about-content .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: var(--primary-50);
        color: var(--primary-600);
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: var(--radius-full);
        margin-bottom: 1rem;
    }
    
    .about-content h2 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
    }
    
    .about-content p {
        color: var(--gray-600);
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    
    .mission-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    
    .mission-list li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--gray-700);
    }
    
    .mission-list li i {
        color: var(--success-500);
        font-size: 1.25rem;
    }
    
    .about-image {
        display: flex;
        justify-content: center;
    }
    
    .image-box {
        width: 300px;
        height: 300px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .image-box i {
        font-size: 8rem;
        color: var(--white);
    }
    
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        padding: 3rem;
        background: var(--white);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-lg);
        margin-bottom: 4rem;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        display: block;
        font-family: var(--font-display);
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-label {
        font-size: 0.9375rem;
        color: var(--gray-500);
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }
    
    .feature-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow-md);
        transition: var(--transition-base);
    }
    
    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }
    
    .feature-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        background: var(--primary-50);
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .feature-icon i {
        font-size: 2rem;
        color: var(--primary-500);
    }
    
    .feature-card h3 {
        font-family: var(--font-display);
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .feature-card p {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    .about-cta {
        padding: 5rem 0;
        background: var(--gradient-primary);
        text-align: center;
        color: var(--white);
    }
    
    .about-cta h2 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    
    .about-cta p {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .btn-white {
        background: var(--white);
        color: var(--primary-600);
    }
    
    .btn-white:hover {
        background: var(--gray-100);
    }
    
    @media (max-width: 1024px) {
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .page-hero {
            padding: 140px 0 60px;
        }
        
        .about-block {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .about-block.reverse {
            direction: ltr;
        }
        
        .image-box {
            width: 200px;
            height: 200px;
        }
        
        .image-box i {
            font-size: 5rem;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-row {
            grid-template-columns: 1fr 1fr;
            padding: 2rem;
        }
        
        .cta-buttons {
            flex-direction: column;
        }
        
        .cta-buttons .btn {
            width: 100%;
        }
    }
</style>
@endpush
@endsection
