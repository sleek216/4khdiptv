@extends('layouts.app')

@section('title', 'IPTV Insights - 4khdiptv')

@section('content')
@php
    $currentCategory = request('category', 'all');
@endphp

<!-- Page Hero Section -->
<section class="page-hero">
    <div class="page-hero-bg">
        <div class="page-hero-pattern"></div>
        <div class="page-hero-glow page-hero-glow-1"></div>
        <div class="page-hero-glow page-hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="page-hero-content" style="grid-template-columns: 1fr; text-align: center; justify-items: center;">
            <div class="page-hero-text" data-aos="fade-up">
                <div class="page-hero-badge">
                    <i class="ph-fill ph-newspaper"></i>
                    <span>Insights Feed</span>
                </div>
                
                <h1 class="page-hero-title">
                    IPTV <span class="text-gradient">Insights Hub</span>
                </h1>
                
                <p class="page-hero-subtitle" style="max-width: 650px; margin: 0 auto 2rem;">
                    Find IPTV news, setup walkthroughs, tips, and updates from 4khdiptv.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Categories -->
<section class="blog-categories-section">
    <div class="container">
        <div class="blog-categories" data-aos="fade-up">
            @foreach([
                'all' => ['All Articles', 'ph-squares-four'],
                'tutorials' => ['Tutorials', 'ph-graduation-cap'],
                'updates' => ['Updates', 'ph-bell-ringing'],
                'tips' => ['Tips & Tricks', 'ph-lightbulb-filament'],
                'news' => ['Industry News', 'ph-newspaper-clipping'],
            ] as $key => $meta)
                <a href="{{ route('blog.index', $key === 'all' ? [] : ['category' => $key]) }}"
                   class="category-btn {{ $currentCategory === $key ? 'active' : '' }}">
                    <i class="ph {{ $meta[1] }}"></i>
                    {{ $meta[0] }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Blog Posts Grid (DB-driven) -->
<section class="blog-posts-section">
    <div class="container">
        <div class="blog-grid">
            @if($featuredBlog && $currentCategory === 'all')
            <article class="blog-card blog-card-featured" data-aos="fade-up" data-category="{{ $featuredBlog->category }}">
                <div class="blog-card-image">
                    @if($featuredBlog->image)
                        <img src="{{ str_starts_with($featuredBlog->image, 'http') ? $featuredBlog->image : asset(ltrim($featuredBlog->image, '/')) }}" alt="{{ $featuredBlog->title }}" class="blog-cover-img">
                    @else
                        <div class="blog-image-placeholder">
                            <i class="ph-fill ph-fire"></i>
                        </div>
                    @endif
                    <div class="blog-card-overlay"></div>
                    <span class="blog-category-tag featured">
                        <i class="ph-fill ph-star"></i>
                        Featured
                    </span>
                </div>
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date">
                            <i class="ph ph-calendar"></i>
                            {{ optional($featuredBlog->published_at ?? $featuredBlog->created_at)->format('M d, Y') }}
                        </span>
                        <span class="blog-read-time">
                            <i class="ph ph-clock"></i>
                            {{ $featuredBlog->read_time ?: '3 min read' }}
                        </span>
                    </div>
                    <h2 class="blog-card-title">{{ $featuredBlog->title }}</h2>
                    <p class="blog-card-excerpt">
                        {{ $featuredBlog->excerpt ?: Str::limit(strip_tags($featuredBlog->content), 160) }}
                    </p>
                    <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="blog-read-more">
                        Open Article
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endif

            @forelse($blogs as $post)
            <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}" data-category="{{ $post->category }}">
                <div class="blog-card-image">
                    @if($post->image)
                        <img src="{{ str_starts_with($post->image, 'http') ? $post->image : asset(ltrim($post->image, '/')) }}" alt="{{ $post->title }}" class="blog-cover-img">
                    @else
                        <div class="blog-image-placeholder {{ ['cyan','green','purple','orange'][$loop->index % 4] }}">
                            <i class="ph-fill ph-article"></i>
                        </div>
                    @endif
                    <div class="blog-card-overlay"></div>
                    <span class="blog-category-tag {{ $post->category }}">{{ $post->category_label }}</span>
                </div>
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date">
                            <i class="ph ph-calendar"></i>
                            {{ optional($post->published_at ?? $post->created_at)->format('M d, Y') }}
                        </span>
                        <span class="blog-read-time">
                            <i class="ph ph-clock"></i>
                            {{ $post->read_time ?: '3 min read' }}
                        </span>
                    </div>
                    <h3 class="blog-card-title">{{ $post->title }}</h3>
                    <p class="blog-card-excerpt">
                        {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="blog-read-more">
                        View Story
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
            </article>
            @empty
                @if(!($featuredBlog && $currentCategory === 'all'))
                <div class="blog-empty" data-aos="fade-up">
                    <i class="ph-duotone ph-newspaper"></i>
                    <h3>No articles yet</h3>
                    <p>New posts from admin will appear here automatically.</p>
                </div>
                @endif
            @endforelse
        </div>

        @if(method_exists($blogs, 'hasPages') && $blogs->hasPages())
            <div class="blog-load-more" data-aos="fade-up">
                {{ $blogs->withQueryString()->links() }}
            </div>
        @endif
    </div>
</section>

<style>
.blog-categories-section {
    padding: 2rem 0;
    background: var(--bg-void);
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.blog-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}
.category-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.03);
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
}
.category-btn.active,
.category-btn:hover {
    background: linear-gradient(135deg, #7c3aed, #db2777);
    border-color: transparent;
    color: #fff;
}
.blog-posts-section { padding: 60px 0 100px; }
.blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.blog-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 22px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.blog-card-featured {
    grid-column: span 2;
    grid-row: span 2;
}
.blog-card-image {
    position: relative;
    min-height: 180px;
    background: #111;
}
.blog-card-featured .blog-card-image { min-height: 320px; }
.blog-cover-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    inset: 0;
}
.blog-image-placeholder {
    min-height: 180px;
    display: grid;
    place-items: center;
    font-size: 42px;
    color: #c4b5fd;
    background: linear-gradient(135deg, rgba(124,58,237,0.25), rgba(219,39,119,0.18));
}
.blog-image-placeholder.cyan { background: linear-gradient(135deg, rgba(34,211,238,0.2), rgba(59,130,246,0.15)); color: #67e8f9; }
.blog-image-placeholder.green { background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(52,211,153,0.12)); color: #6ee7b7; }
.blog-image-placeholder.purple { background: linear-gradient(135deg, rgba(124,58,237,0.25), rgba(168,85,247,0.15)); color: #c4b5fd; }
.blog-image-placeholder.orange { background: linear-gradient(135deg, rgba(249,115,22,0.2), rgba(251,191,36,0.12)); color: #fdba74; }
.blog-card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.55) 100%);
    pointer-events: none;
}
.blog-category-tag {
    position: absolute;
    top: 14px; left: 14px;
    z-index: 2;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
    background: rgba(0,0,0,0.55);
    color: #fff;
}
.blog-category-tag.featured { background: linear-gradient(135deg, #7c3aed, #db2777); }
.blog-card-content { padding: 20px; display: flex; flex-direction: column; gap: 10px; flex: 1; }
.blog-meta { display: flex; gap: 14px; flex-wrap: wrap; color: #94a3b8; font-size: 12px; }
.blog-card-title { margin: 0; color: #fff; font-size: 20px; line-height: 1.3; }
.blog-card-featured .blog-card-title { font-size: 28px; }
.blog-card-excerpt { margin: 0; color: #94a3b8; font-size: 14px; line-height: 1.6; flex: 1; }
.blog-read-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #c4b5fd;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    margin-top: 8px;
}
.blog-read-more:hover { color: #fff; }
.blog-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: #94a3b8;
    border: 1px dashed rgba(255,255,255,0.12);
    border-radius: 20px;
}
.blog-empty i { font-size: 48px; color: #c4b5fd; }
.blog-empty h3 { color: #fff; margin: 12px 0 8px; }
.blog-load-more { margin-top: 40px; display: flex; justify-content: center; }
@media (max-width: 1024px) {
    .blog-grid { grid-template-columns: repeat(2, 1fr); }
    .blog-card-featured { grid-column: span 2; grid-row: span 1; }
}
@media (max-width: 768px) {
    .blog-grid { grid-template-columns: 1fr; }
    .blog-card-featured { grid-column: span 1; }
}
</style>
@endsection
