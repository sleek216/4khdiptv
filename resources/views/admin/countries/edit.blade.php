@extends('admin.layouts.app')

@section('title', 'Edit Country')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Edit country</h1>
        <p class="xai-subheading">Update details for <strong style="color: var(--xai-text-primary);">{{ $country->name }}</strong>.</p>
    </div>

    <form action="{{ route('admin.countries.update', $country) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Country details</h2>

                    <div class="mb-4">
                        <label class="xai-label">Country name</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-map-pin" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="@error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $country->name) }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="xai-label">ISO code</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-terminal-window" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="code" value="{{ old('code', $country->code) }}" maxlength="3" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">Flag emoji</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-flag" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="flag" value="{{ old('flag', $country->flag) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="xai-label">Sort order</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-list-numbers" style="color: var(--xai-text-muted);"></i>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $country->sort_order) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Status</h2>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $country->is_active) ? 'checked' : '' }} style="accent-color: var(--atlas-teal); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_active" style="font-family: var(--font-display); font-size: 13px; color: var(--xai-text-primary); cursor: pointer;">Active (visible on site)</label>
                    </div>
                </div>

                <div class="xai-card-dark p-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Actions</h2>
                    <button type="submit" class="btn-xai-primary w-100 py-3 mb-3 justify-content-center">
                        <span>Save changes</span>
                    </button>
                    <a href="{{ route('admin.countries.index') }}" class="btn-xai-secondary w-100 py-3 justify-content-center" style="text-decoration: none;">
                        <span>Cancel</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
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
