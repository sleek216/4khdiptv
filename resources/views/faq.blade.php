@extends('layouts.app')

@section('title', 'Help & FAQ - 4khdiptv')

@section('content')

<!-- FAQ Hero Section -->
<section class="portal-hero faq-hero">
    <div class="matrix-grid-overlay"></div>
    <div class="parallax-bg">
        <div class="blob" style="width: 700px; height: 700px; background: var(--accent-vibrant); top: -200px; right: -100px; opacity: 0.15;"></div>
        <div class="blob" style="width: 500px; height: 500px; background: var(--accent-secondary); bottom: -100px; left: -100px; opacity: 0.1;"></div>
    </div>
    
    <div class="container relative z-20">
        <div data-aos="fade-down">
            <div class="archival-badge">HELP CENTER</div>
            <h1 class="title-display">FREQUENTLY <br> <span class="text-vibrant">ASKED QUESTIONS.</span></h1>
            <p class="hero-subtitle">Quick answers about setup, plans, payments, and watching. Search below or browse by topic.</p>
            
            <div class="support-search-wrap">
                <i class="ph-bold ph-magnifying-glass"></i>
                <input type="text" id="faqSeeker" placeholder="Search for help..." onkeyup="filterFaqs()">
            </div>
        </div>
    </div>
</section>

<!-- Content Architecture -->
<section class="faq-protocol-section">
    <div class="container">
        <!-- Category Nav -->
        <div class="protocol-categories" data-aos="fade-up">
            <button class="cat-pill active" onclick="filterCategory('all')">All Topics</button>
            @foreach($categories as $cat)
            <button class="cat-pill" onclick="filterCategory('{{ Str::slug($cat) }}')">{{ $cat }}</button>
            @endforeach
        </div>

        <!-- Accordion Hub -->
        <div class="faq-accordion-hub" id="faqHub">
            @foreach($faqs as $f)
            <div class="faq-node" data-category="{{ Str::slug($f->category) }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 30 }}">
                <div class="node-trigger" onclick="toggleNode(this)">
                    <div class="node-marker">
                        <span class="index">0{{ $loop->iteration }}</span>
                    </div>
                    <h3 class="node-question">{{ $f->question }}</h3>
                    <div class="node-toggle-icon">
                        <i class="ph-bold ph-plus"></i>
                    </div>
                </div>
                <div class="node-payload">
                    <div class="payload-inner">
                        <p>{{ $f->answer }}</p>
                        @if($f->category)
                        <div class="payload-meta">
                            <span class="meta-label">Topic:</span>
                            <span class="meta-val">{{ $f->category }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Support Terminal -->
        <div class="support-terminal" data-aos="zoom-in">
            <div class="terminal-content">
                <h4 class="terminal-title">STILL NEED HELP?</h4>
                <p class="terminal-desc">Our support team is available 24/7 — just send us a message.</p>
                <div class="terminal-actions">
                    <a href="{{ route('contact') }}" class="btn-portal btn-portal-outline">
                        <i class="ph-bold ph-chat-centered-text"></i>
                        <span>Contact Support</span>
                    </a>
                </div>
            </div>
            <div class="terminal-visual">
                <div class="scanning-line"></div>
                <i class="ph-fill ph-headset"></i>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .faq-hero {
        padding: 140px 0 100px;
        text-align: center;
        background: #020408;
    }

    .archival-badge {
        display: inline-block;
        background: rgba(124, 58, 237, 0.1);
        border: 1px solid rgba(124, 58, 237, 0.2);
        color: var(--accent-vibrant);
        padding: 8px 18px;
        border-radius: 8px;
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 11px;
        letter-spacing: 2px;
        margin-bottom: 32px;
    }

    .hero-subtitle {
        color: var(--text-low);
        font-size: 22px;
        max-width: 700px;
        margin: 0 auto 56px;
        font-weight: 500;
    }

    .support-search-wrap {
        max-width: 600px;
        margin: 0 auto;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 20px;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.4s ease;
    }

    .support-search-wrap:focus-within {
        border-color: var(--accent-vibrant);
        background: rgba(255,255,255,0.04);
        box-shadow: 0 0 30px rgba(124, 58, 237, 0.15);
    }

    .support-search-wrap i {
        color: var(--accent-vibrant);
        font-size: 24px;
    }

    .support-search-wrap input {
        background: transparent;
        border: none;
        outline: none;
        color: white;
        width: 100%;
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .faq-protocol-section {
        padding-bottom: 160px;
        background: #020408;
    }

    .protocol-categories {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 64px;
        flex-wrap: wrap;
    }

    .cat-pill {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        color: var(--text-low);
        padding: 10px 24px;
        border-radius: 99px;
        font-weight: 800;
        font-size: 11px;
        letter-spacing: 1.5px;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .cat-pill:hover, .cat-pill.active {
        background: var(--accent-glow);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
    }

    .faq-accordion-hub {
        max-width: 1000px;
        margin: 0 auto 100px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .faq-node {
        background: rgba(255,255,255,0.015);
        border: 1px solid rgba(255,255,255,0.04);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .node-trigger {
        padding: 32px 40px;
        display: flex;
        align-items: center;
        gap: 24px;
        cursor: pointer;
        transition: all 0.4s ease;
    }

    .node-marker {
        width: 44px;
        height: 44px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
    }

    .index {
        font-family: var(--font-display);
        font-weight: 900;
        color: var(--accent-vibrant);
        font-size: 14px;
    }

    .node-question {
        font-family: var(--font-display);
        font-size: 24px;
        font-weight: 700;
        flex: 1;
        transition: all 0.4s ease;
    }

    .node-toggle-icon {
        font-size: 24px;
        color: rgba(255, 255, 255, 0.2);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .faq-node.is-open {
        background: rgba(255,255,255,0.04);
        border-color: rgba(124, 58, 237, 0.3);
        box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.8);
    }

    .faq-node.is-open .node-marker {
        background: var(--accent-vibrant);
        border-color: var(--accent-vibrant);
        box-shadow: 0 0 20px rgba(124, 58, 237, 0.4);
    }

    .faq-node.is-open .index {
        color: white;
    }

    .faq-node.is-open .node-question {
        color: white;
        transform: translateX(10px);
    }

    .faq-node.is-open .node-toggle-icon {
        transform: rotate(45deg);
        color: var(--accent-vibrant);
    }

    .node-payload {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .payload-inner {
        padding: 0 40px 40px 108px;
    }

    .payload-inner p {
        color: var(--text-low);
        font-size: 17px;
        line-height: 1.8;
        font-weight: 500;
        margin-bottom: 24px;
    }

    .payload-meta {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        display: flex;
        gap: 8px;
    }

    .meta-label { color: rgba(255, 255, 255, 0.2); }
    .meta-val { color: var(--accent-vibrant); }

    /* Support Terminal Card */
    .support-terminal {
        max-width: 1000px;
        margin: 0 auto;
        background: linear-gradient(135deg, #0a0d14 0%, #05060a 100%);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 32px;
        padding: 56px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .terminal-title {
        font-family: var(--font-display);
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 12px;
        letter-spacing: -1px;
    }

    .terminal-desc {
        color: var(--text-low);
        font-size: 18px;
        margin-bottom: 32px;
        font-weight: 600;
    }

    .terminal-visual {
        width: 160px;
        height: 160px;
        background: rgba(124, 58, 237, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 72px;
        color: var(--accent-vibrant);
        position: relative;
    }

    .scanning-line {
        position: absolute;
        width: 200%;
        height: 4px;
        background: linear-gradient(90deg, transparent, var(--accent-vibrant), transparent);
        top: 0;
        left: -50%;
        animation: portal-scan 4s infinite linear;
        opacity: 0.3;
    }

    @keyframes portal-scan {
        0% { top: 0; }
        100% { top: 100%; }
    }

    @media (max-width: 768px) {
        .support-terminal {
            flex-direction: column;
            text-align: center;
            gap: 40px;
        }
        .payload-inner {
            padding: 0 32px 32px 32px;
        }
        .node-trigger {
            padding: 24px;
        }
        .node-question {
            font-size: 18px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function toggleNode(trigger) {
        const node = trigger.parentElement;
        const openNode = document.querySelector('.faq-node.is-open');
        
        if (openNode && openNode !== node) {
            openNode.classList.remove('is-open');
            openNode.querySelector('.node-payload').style.maxHeight = '0';
        }

        const payload = node.querySelector('.node-payload');
        node.classList.toggle('is-open');
        
        if (node.classList.contains('is-open')) {
            payload.style.maxHeight = payload.scrollHeight + 'px';
        } else {
            payload.style.maxHeight = '0';
        }
    }

    function filterFaqs() {
        const val = document.getElementById('faqSeeker').value.toLowerCase();
        const nodes = document.querySelectorAll('.faq-node');
        
        nodes.forEach(node => {
            const txt = node.innerText.toLowerCase();
            node.style.display = txt.includes(val) ? 'block' : 'none';
        });
    }

    function filterCategory(cat) {
        const nodes = document.querySelectorAll('.faq-node');
        const pills = document.querySelectorAll('.cat-pill');
        
        pills.forEach(p => p.classList.remove('active'));
        event.currentTarget.classList.add('active');

        nodes.forEach(node => {
            if (cat === 'all' || node.getAttribute('data-category') === cat) {
                node.style.display = 'block';
            } else {
                node.style.display = 'none';
            }
        });
    }
</script>
@endpush

@endsection
