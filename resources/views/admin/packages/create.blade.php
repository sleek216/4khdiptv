@extends('admin.layouts.app')

@section('title', 'Create Package')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <h1 class="xai-display">CREATE PACKAGE</h1>
        <p class="xai-subheading">Set up a new subscription package, pricing, and features.</p>
    </div>

    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf
        
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Protocol Blueprint -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">PACKAGE INFORMATION</div>

                    <div class="mb-4">
                        <label for="name" class="xai-label">PACKAGE NAME *</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-tag" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                   id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Gold Monthly Plan">
                        </div>
                        @error('name')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 11px; letter-spacing: 1px;">ERROR: {{ strtoupper($message) }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="xai-label">DESCRIPTION</label>
                        <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                            <textarea class="w-100 {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                      id="description" name="description" rows="3" placeholder="Describe the package capabilities..." style="background: transparent; border: none; color: var(--xai-text-primary); outline: none; resize: vertical;">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="price" class="xai-label">PRICE ($) *</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-currency-dollar" style="color: var(--xai-text-muted);"></i>
                                <input type="number" step="0.01" class="{{ $errors->has('price') ? 'is-invalid' : '' }}" 
                                       id="price" name="price" value="{{ old('price') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="original_price" class="xai-label">STRIKE PRICE ($)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-tag-chevron" style="color: var(--xai-text-muted);"></i>
                                <input type="number" step="0.01" class="{{ $errors->has('original_price') ? 'is-invalid' : '' }}" 
                                       id="original_price" name="original_price" value="{{ old('original_price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <label for="duration_months" class="xai-label">DURATION (MONTHS)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-calendar" style="color: var(--xai-text-muted);"></i>
                                <input type="number" id="duration_months" name="duration_months" value="{{ old('duration_months', 1) }}" min="0" placeholder="1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="duration_days" class="xai-label">DURATION (DAYS)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-clock" style="color: var(--xai-text-muted);"></i>
                                <input type="number" id="duration_days" name="duration_days" value="{{ old('duration_days') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="duration_label" class="xai-label">LABEL (e.g. 1 Month)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-text-t" style="color: var(--xai-text-muted);"></i>
                                <input type="text" id="duration_label" name="duration_label" 
                                       value="{{ old('duration_label', '1 Month') }}" placeholder="e.g. 1 Month / Free Trial" required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="connections" class="xai-label">CONNECTIONS *</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-users-three" style="color: var(--xai-text-muted);"></i>
                                <input type="number" id="connections" name="connections" 
                                       value="{{ old('connections', 1) }}" required min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="sort_order" class="xai-label">DISPLAY ORDER</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-list-numbers" style="color: var(--xai-text-muted);"></i>
                                <input type="number" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', 0) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Arsenal -->
                <div class="xai-card-dark p-5">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px;">FEATURES</div>
                        <button type="button" class="btn-xai-dark px-3 py-2" onclick="addFeature()">
                            <span>ADD FEATURE</span>
                        </button>
                    </div>

                    <div id="features-container">
                        <div class="search-input mb-3 d-flex align-items-center pe-3 w-100" style="max-width: none;">
                            <i class="ph ph-check-circle" style="position: static; transform: none; margin-left: 20px; color: var(--xai-text-muted);"></i>
                            <input type="text" class="flex-grow-1" name="features_list[]" placeholder="Enter feature description..." style="background: transparent; border: none; color: var(--xai-text-primary); padding: 8px 16px; outline: none;">
                            <button type="button" class="btn-xai-dark text-danger p-2" style="width: 32px; height: 32px; border-color: transparent; padding: 0;" onclick="this.parentElement.remove()">
                                <i class="ph ph-x" style="position: static; transform: none; font-size: 14px; color: #ff4444;"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Deployment Configuration -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">SETTINGS</div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_active" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS ACTIVE</label>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_featured" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS FEATURED</label>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <input type="checkbox" id="is_trial" name="is_trial" value="1" {{ old('is_trial') ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_trial" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS TRIAL</label>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                        <input type="checkbox" id="is_reseller" name="is_reseller" value="1" {{ old('is_reseller') ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_reseller" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS RESELLER</label>
                    </div>
                </div>

                <div class="xai-card-dark p-5">
                    <button type="submit" class="btn-xai-dark w-100 py-3 mb-3 justify-content-center">
                        <span>CREATE PACKAGE</span>
                    </button>
                    <a href="{{ route('admin.packages.index') }}" class="btn-xai-dark w-100 py-3 justify-content-center" style="background: transparent; color: var(--xai-text-secondary); text-decoration: none;">
                        <span>CANCEL</span>
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
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'search-input mb-3 d-flex align-items-center pe-3 w-100';
    div.style.maxWidth = 'none';
    div.innerHTML = `
        <i class="ph ph-check-circle" style="position: static; transform: none; margin-left: 20px; color: var(--xai-text-muted);"></i>
        <input type="text" class="flex-grow-1" name="features_list[]" placeholder="Enter capability string..." style="background: transparent; border: none; color: var(--xai-text-primary); padding: 8px 16px; outline: none;">
        <button type="button" class="btn-xai-dark text-danger p-2" style="width: 32px; height: 32px; border-color: transparent; padding: 0;" onclick="this.parentElement.remove()">
            <i class="ph ph-x" style="position: static; transform: none; font-size: 14px; color: #ff4444;"></i>
        </button>
    `;
    container.appendChild(div);
}
</script>
@endpush
