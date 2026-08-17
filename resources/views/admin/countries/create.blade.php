@extends('admin.layouts.app')

@section('title', 'Add Country')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Add country</h1>
        <p class="xai-subheading">Create a new country entry for regional availability.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="xai-card-dark p-4">
                <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Country details</h2>

                <form action="{{ route('admin.countries.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="xai-label">Country name</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-map-pin" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="@error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required placeholder="United States">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="xai-label">ISO code</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-fingerprint" style="color: var(--xai-text-muted);"></i>
                                <input type="text" class="@error('code') is-invalid @enderror"
                                    name="code" value="{{ old('code') }}" maxlength="3" required placeholder="US">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">Flag emoji</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-flag" style="color: var(--xai-text-muted);"></i>
                                <input type="text" class="@error('flag') is-invalid @enderror"
                                    name="flag" value="{{ old('flag') }}" placeholder="🇺🇸">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">Sort order</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-sort-ascending" style="color: var(--xai-text-muted);"></i>
                            <input type="number" class="@error('sort_order') is-invalid @enderror"
                                name="sort_order" value="{{ old('sort_order', 0) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="accent-color: var(--atlas-teal); width: 16px; height: 16px; margin-right: 12px;">
                            <label for="is_active" style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary); cursor: pointer;">Active (visible on site)</label>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn-xai-primary py-3 px-5 justify-content-center">
                            <span>Save country</span>
                        </button>
                        <a href="{{ route('admin.countries.index') }}" class="btn-xai-secondary py-3 px-4 justify-content-center" style="text-decoration: none;">
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="xai-card-dark p-4">
                <div class="stat-tile-label mb-3">Tips</div>
                <p style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.6; margin-bottom: 16px;">
                    Use standard ISO country codes so listings stay consistent. Examples:
                </p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach(['US', 'UK', 'DE', 'FR', 'CA', 'AU'] as $c)
                        <span style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 2px 6px;">{{ $c }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .xai-label {
        font-family: var(--font-display);
        font-size: 11px;
        font-weight: 400;
        color: var(--xai-text-secondary);
        margin-bottom: 8px;
        display: block;
    }
</style>
@endpush
