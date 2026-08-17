@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')
<div class="mb-4 d-flex flex-wrap justify-content-between align-items-end gap-3">
    <div>
        <h1 class="xai-display">Blog Posts</h1>
        <p class="xai-subheading">Manage website articles. These come from the <strong>blogs</strong> database table — same source as the public /blog page.</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="btn-xai-primary">
        <i class="ph ph-plus"></i>
        <span>Publish New Article</span>
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">{{ session('success') }}</div>
@endif

<div class="xai-card-dark mb-4">
    <form action="{{ route('admin.blogs.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label class="stat-tile-label mb-2">Search</label>
            <div class="search-input w-100" style="max-width:none;">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="col-md-3">
            <label class="stat-tile-label mb-2">Category</label>
            <select name="category" class="form-select" style="background:transparent;border:1px solid var(--xai-border-strong);color:var(--xai-text-primary);padding:10px 12px;border-radius:10px;" onchange="this.form.submit()">
                <option value="all">All Categories</option>
                <option value="tutorials" {{ request('category') === 'tutorials' ? 'selected' : '' }}>Tutorials</option>
                <option value="updates" {{ request('category') === 'updates' ? 'selected' : '' }}>Updates</option>
                <option value="tips" {{ request('category') === 'tips' ? 'selected' : '' }}>Tips & Tricks</option>
                <option value="news" {{ request('category') === 'news' ? 'selected' : '' }}>Industry News</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn-xai-dark w-100 justify-content-center">Search</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.blogs.index') }}" class="btn-xai-secondary w-100 justify-content-center">Reset</a>
        </div>
    </form>
</div>

<div class="xai-card-dark">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="stat-tile-label">Total in database: {{ $blogs->total() }}</div>
    </div>

    @if($blogs->count() > 0)
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Published</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                        <tr>
                            <td>
                                <div style="font-weight:700;">{{ $blog->title }}</div>
                                <div style="font-size:12px;color:var(--xai-text-muted);">/blog/{{ $blog->slug }}</div>
                            </td>
                            <td>{{ $blog->category_label }}</td>
                            <td>
                                @if($blog->is_active)
                                    <span class="status-pill ok">Active</span>
                                @else
                                    <span class="status-pill wait">Hidden</span>
                                @endif
                            </td>
                            <td>{{ $blog->is_featured ? 'Yes' : 'No' }}</td>
                            <td style="color:var(--xai-text-muted);font-size:13px;">
                                {{ optional($blog->published_at ?? $blog->created_at)->format('Y-m-d') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn-xai-dark" style="padding:6px 10px;font-size:12px;">View</a>
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn-xai-dark" style="padding:6px 10px;font-size:12px;">Edit</a>
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this article?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-xai-dark" style="padding:6px 10px;font-size:12px;color:#ef4444;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $blogs->withQueryString()->links('pagination::bootstrap-5') }}</div>
    @else
        <div style="text-align:center;padding:48px 20px;color:var(--xai-text-muted);">
            <div style="font-size:18px;font-weight:700;color:var(--xai-text-primary);margin-bottom:8px;">No blog posts in database</div>
            <p style="margin-bottom:18px;">Public /blog page was previously showing hardcoded demo cards. Create real posts here and they will appear on the site.</p>
            <a href="{{ route('admin.blogs.create') }}" class="btn-xai-primary">
                <i class="ph ph-plus"></i>
                <span>Create first article</span>
            </a>
        </div>
    @endif
</div>
@endsection
