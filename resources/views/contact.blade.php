@extends('layouts.app')

@section('title', 'Contact Us - 4khdiptv')

@section('content')

@php
    $supportEmail = 'support@4khdiptv.org';
    $whatsapp = \App\Models\Setting::get('whatsapp_number');
    $supportPhone = \App\Models\Setting::get('support_phone', $whatsapp ?: '');
    $crispId = \App\Models\Setting::get('crisp_website_id');
@endphp

<!-- Contact Hero -->
<section class="portal-hero contact-hero">
    <div class="parallax-bg">
        <div class="blob" style="width: 450px; height: 450px; background: var(--accent-secondary); top: -200px; left: 0; opacity: 0.1;"></div>
        <div class="blob" style="width: 550px; height: 550px; background: var(--accent-vibrant); bottom: -100px; right: 10%; opacity: 0.15;"></div>
    </div>
    <div class="container">
        <div data-aos="zoom-out">
            <div class="contact-hero-badge"><i class="ph-fill ph-headset"></i> 24/7 LIVE SUPPORT</div>
            <h1 class="title-display">CONTACT <br> <span class="text-vibrant">US.</span></h1>
            <p class="hero-desc-alt">Need help with setup, billing, or streaming? Our team is online 24/7 — email us, start live chat, or send a message below.</p>
        </div>
    </div>
</section>

<section class="contact-interface section-spacer">
    <div class="container">
        @if(session('success'))
            <div class="contact-alert success" data-aos="fade-down">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="contact-alert error" data-aos="fade-down">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="contact-support-strip" data-aos="fade-up">
            <div class="contact-support-card">
                <div class="contact-support-icon chat"><i class="ph-bold ph-chat-circle-dots"></i></div>
                <div>
                    <h3>Live Chat 24/7</h3>
                    <p>Talk to a real agent anytime — fastest way to get help.</p>
                </div>
                @if($crispId)
                    <button type="button" class="btn-portal" onclick="window.$crisp&&$crisp.push(['do','chat:open'])">
                        <span>Open Live Chat</span>
                        <i class="ph-bold ph-arrow-right"></i>
                    </button>
                @else
                    <a href="#contact-form" class="btn-portal">
                        <span>Send Message</span>
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                @endif
            </div>
            <div class="contact-support-card">
                <div class="contact-support-icon mail"><i class="ph-bold ph-envelope-simple"></i></div>
                <div>
                    <h3>Email Support</h3>
                    <p>Write to us and we will reply as soon as possible.</p>
                </div>
                <a href="mailto:{{ $supportEmail }}" class="btn-portal btn-portal-outline">
                    <span>{{ $supportEmail }}</span>
                </a>
            </div>
        </div>

        <div class="contact-grid">
            <!-- Contact nodes -->
            <div class="contact-nodes" data-aos="fade-right">
                <div class="node-cluster">
                    <div class="stream-card node-card">
                        <div class="node-icon"><i class="ph-bold ph-envelope-simple"></i></div>
                        <div class="node-badge">EMAIL</div>
                        <div class="node-value">
                            <a href="mailto:{{ $supportEmail }}">{{ $supportEmail }}</a>
                        </div>
                        <p class="node-hint">Best for billing, renewals, and account help.</p>
                    </div>

                    <div class="stream-card node-card">
                        <div class="node-icon"><i class="ph-bold ph-chat-circle-dots"></i></div>
                        <div class="node-badge">LIVE CHAT</div>
                        <div class="node-value">Available 24/7</div>
                        <p class="node-hint">Instant help for setup and streaming issues.</p>
                        @if($crispId)
                            <button type="button" class="node-chat-btn" onclick="window.$crisp&&$crisp.push(['do','chat:open'])">
                                Start Live Chat <i class="ph-bold ph-arrow-right"></i>
                            </button>
                        @endif
                    </div>

                    @if($supportPhone)
                    <div class="stream-card node-card">
                        <div class="node-icon"><i class="ph-bold ph-phone"></i></div>
                        <div class="node-badge">WHATSAPP / PHONE</div>
                        <div class="node-value">
                            <a href="{{ $whatsapp ? 'https://wa.me/'.preg_replace('/\D+/', '', $whatsapp) : 'tel:'.preg_replace('/\s+/', '', $supportPhone) }}" target="_blank" rel="noopener">
                                {{ $supportPhone }}
                            </a>
                        </div>
                        <p class="node-hint">Message us anytime for quick support.</p>
                    </div>
                    @endif

                    <div class="stream-card node-card">
                        <div class="node-icon"><i class="ph-bold ph-clock"></i></div>
                        <div class="node-badge">SUPPORT HOURS</div>
                        <div class="node-value">24/7 Customer Support</div>
                        <p class="node-hint">We are here day and night — no waiting until Monday.</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="contact-form-area" id="contact-form" data-aos="fade-left">
                <div class="stream-card form-card">
                    <div class="form-card-head">
                        <h2>Send a Message</h2>
                        <p>Fill the form and our support team will get back to you quickly.</p>
                    </div>
                    <form action="{{ route('contact.store') }}" method="POST" class="elite-form">
                        @csrf
                        <div class="form-row">
                            <div class="input-wrap">
                                <label>YOUR NAME</label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name" required>
                            </div>
                            <div class="input-wrap">
                                <label>EMAIL</label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required>
                            </div>
                        </div>

                        <div class="input-wrap">
                            <label>SUBJECT</label>
                            <select name="subject" class="elite-select">
                                <option value="General" {{ old('subject', request('subject')) == 'General' ? 'selected' : '' }}>General Question</option>
                                <option value="Trial" {{ old('subject', request('subject')) == 'Trial' ? 'selected' : '' }}>Free Trial Request</option>
                                <option value="Technical" {{ old('subject', request('subject')) == 'Technical' ? 'selected' : '' }}>Technical Support</option>
                                <option value="Billing" {{ old('subject', request('subject')) == 'Billing' ? 'selected' : '' }}>Billing / Renew</option>
                                <option value="LiveChat" {{ old('subject', request('subject')) == 'LiveChat' ? 'selected' : '' }}>Live Chat Follow-up</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <label>MESSAGE</label>
                            <textarea name="message" rows="5" placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn-portal btn-full">
                            <span>Send Message</span>
                            <i class="ph-bold ph-paper-plane-tilt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .contact-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 22px;
        padding: 8px 16px;
        border-radius: 999px;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #6ee7b7;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.35fr;
        gap: 48px;
        align-items: start;
    }

    .hero-desc-alt {
        color: var(--text-low);
        font-size: 22px;
        max-width: 760px;
        margin: 0 auto;
        line-height: 1.6;
        font-weight: 500;
    }

    .contact-alert {
        margin-bottom: 28px;
        padding: 14px 18px;
        border-radius: 14px;
        font-weight: 600;
    }
    .contact-alert.success {
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.35);
        color: #bbf7d0;
    }
    .contact-alert.error {
        background: rgba(239, 68, 68, 0.12);
        border: 1px solid rgba(239, 68, 68, 0.35);
        color: #fecaca;
    }

    .contact-support-strip {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 48px;
    }

    .contact-support-card {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        padding: 22px;
        border-radius: 22px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.08);
    }
    .contact-support-card h3 {
        margin: 0 0 4px;
        color: #fff;
        font-size: 18px;
    }
    .contact-support-card p {
        margin: 0;
        color: #94a3b8;
        font-size: 14px;
        line-height: 1.5;
        max-width: 280px;
    }
    .contact-support-card .btn-portal {
        margin-left: auto;
        white-space: nowrap;
    }
    .contact-support-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        font-size: 24px;
        flex-shrink: 0;
    }
    .contact-support-icon.chat {
        background: linear-gradient(135deg, rgba(124,58,237,0.35), rgba(219,39,119,0.25));
        color: #fff;
    }
    .contact-support-icon.mail {
        background: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
    }

    .node-cluster {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .node-card {
        padding: 28px !important;
        border-radius: 22px !important;
        background: rgba(255, 255, 255, 0.02) !important;
        position: relative;
    }

    .node-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: rgba(124, 58, 237, 0.18);
        color: #c4b5fd;
        margin-bottom: 14px;
        font-size: 18px;
    }

    .node-badge {
        font-family: var(--font-display);
        font-weight: 900;
        color: var(--accent-vibrant);
        font-size: 11px;
        margin-bottom: 10px;
        letter-spacing: 3px;
        opacity: 0.85;
    }

    .node-value {
        font-weight: 800;
        font-size: 18px;
        letter-spacing: -0.3px;
        color: white;
        word-break: break-word;
    }
    .node-value a {
        color: inherit;
        text-decoration: none;
    }
    .node-value a:hover { color: #c4b5fd; }

    .node-hint {
        margin: 10px 0 0;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.5;
    }

    .node-chat-btn {
        margin-top: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #7c3aed, #db2777);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 10px 16px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
    }

    .form-card {
        padding: 40px !important;
        border-radius: 28px !important;
        background: rgba(255, 255, 255, 0.02) !important;
    }

    .form-card-head {
        margin-bottom: 28px;
    }
    .form-card-head h2 {
        margin: 0 0 8px;
        color: #fff;
        font-size: 28px;
        font-weight: 800;
    }
    .form-card-head p {
        margin: 0;
        color: #94a3b8;
        font-size: 15px;
    }

    .elite-form {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .input-wrap {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .input-wrap label {
        font-size: 10px;
        font-weight: 900;
        color: var(--text-low);
        letter-spacing: 2px;
        text-transform: uppercase;
        padding-left: 4px;
    }

    .elite-form input,
    .elite-form textarea,
    .elite-form select {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        padding: 16px 18px;
        color: white;
        border-radius: 14px;
        font-weight: 600;
        font-family: var(--font-main);
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
    }

    .elite-form input:focus,
    .elite-form textarea:focus,
    .elite-form select:focus {
        border-color: #7c3aed;
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
    }

    .elite-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 18px center;
        background-size: 16px;
        cursor: pointer;
    }

    @media (max-width: 1024px) {
        .contact-grid,
        .contact-support-strip {
            grid-template-columns: 1fr;
            gap: 28px;
        }
        .contact-support-card .btn-portal {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }
        .form-card { padding: 28px 20px !important; }
    }

    @media (max-width: 768px) {
        .form-row { grid-template-columns: 1fr; }
        .node-value { font-size: 16px; }
        .hero-desc-alt { font-size: 16px; }
        .form-card-head h2 { font-size: 22px; }
    }
</style>
@endpush
