@extends('layouts.app')

@section('title', $blog->title . ' — 4khdiptv Blog')

@section('content')
<section class="portal-hero" style="padding-bottom: 40px;">
    <div class="container" style="max-width: 900px;">
        <div data-aos="fade-up">
            <a href="{{ route('blog.index') }}" style="display:inline-flex;align-items:center;gap:8px;color:#94a3b8;text-decoration:none;font-weight:600;margin-bottom:18px;">
                <i class="ph-bold ph-arrow-left"></i> Back to Blog
            </a>
            <div style="display:inline-flex;padding:6px 12px;border-radius:999px;background:rgba(124,58,237,0.18);color:#c4b5fd;font-size:12px;font-weight:800;margin-bottom:16px;">
                {{ $blog->category_label }}
            </div>
            <h1 class="title-display" style="font-size:clamp(32px,5vw,52px);line-height:1.15;margin-bottom:14px;">{{ $blog->title }}</h1>
            <p style="color:#94a3b8;margin:0;">
                {{ optional($blog->published_at ?? $blog->created_at)->format('F d, Y') }}
                · {{ $blog->read_time ?: '3 min read' }}
                · {{ number_format($blog->views ?? 0) }} views
            </p>
            @if($blog->excerpt)
                <p style="color:#cbd5e1;font-size:18px;line-height:1.6;margin-top:18px;">{{ $blog->excerpt }}</p>
            @endif
        </div>
    </div>
</section>

<section style="padding: 20px 0 100px; background: #020408;">
    <div class="container" style="max-width: 900px;">
        <article style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:24px;padding:28px;overflow:hidden;">
            @if($blog->image)
                <div style="margin:-28px -28px 28px;max-height:420px;overflow:hidden;">
                    <img src="{{ str_starts_with($blog->image, 'http') ? $blog->image : asset(ltrim($blog->image, '/')) }}" alt="{{ $blog->title }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                </div>
            @endif

            <div class="article-content">
                {!! $blog->content !!}
            </div>
        </article>

        @if($relatedBlogs->count() > 0)
            <h3 style="color:#fff;font-size:24px;font-weight:800;margin:48px 0 20px;">Related Articles</h3>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
                @foreach($relatedBlogs as $post)
                    <a href="{{ route('blog.show', $post->slug) }}" style="text-decoration:none;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:18px;display:block;">
                        <div style="color:#c4b5fd;font-size:11px;font-weight:800;margin-bottom:8px;">{{ $post->category_label }}</div>
                        <div style="color:#fff;font-weight:700;line-height:1.35;">{{ $post->title }}</div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.article-content { color: #cbd5e1; font-size: 1.05rem; line-height: 1.8; }
.article-content h1, .article-content h2, .article-content h3, .article-content h4 {
    color: #fff; font-weight: 800; margin-top: 1.6em; margin-bottom: 0.55em; line-height: 1.3;
}
.article-content p { margin-bottom: 1.25em; }
.article-content ul, .article-content ol { margin-bottom: 1.25em; padding-left: 1.4em; }
.article-content a { color: #c4b5fd; }
.article-content img { max-width: 100%; height: auto; border-radius: 12px; margin: 1.2em 0; }
.article-content blockquote {
    border-left: 4px solid #7c3aed;
    padding: 1em 1.2em;
    background: rgba(124,58,237,0.1);
    border-radius: 0 12px 12px 0;
    margin: 1.4em 0;
}
</style>
@endpush
