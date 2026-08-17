@extends('admin.layouts.app')

@section('title', 'Edit Package')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <h1 class="xai-display">EDIT PACKAGE</h1>
        <p class="xai-subheading">Update parameters for the <strong class="text-white">{{ $package->name }}</strong> package. Update pricing, duration, and features.</p>
    </div>

    <form action="{{ route('admin.packages.update', $package) }}" method="POST">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="xai-card-dark p-4 mb-4" style="border: 1px solid rgba(239,68,68,0.35);">
                <div style="color:#fca5a5; font-weight:700; margin-bottom:8px;">Could not save package:</div>
                <ul style="margin:0; padding-left:18px; color:#fecaca;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Primary Specs -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">PACKAGE INFORMATION</div>

                    <div class="mb-5">
                        <label class="xai-label">PACKAGE NAME</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-tag" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="@error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name', $package->name) }}" required>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="xai-label">DESCRIPTION</label>
                        <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                            <textarea class="w-100" name="description" rows="3" style="background: transparent; border: none; color: var(--xai-text-primary); outline: none; resize: vertical;">{{ old('description', $package->description) }}</textarea>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="xai-label">PRICE ($)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-currency-dollar" style="color: var(--xai-text-muted);"></i>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">STRIKE PRICE ($)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-tag-chevron" style="color: var(--xai-text-muted);"></i>
                                <input type="number" step="0.01" name="original_price" value="{{ old('original_price', $package->original_price) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <label class="xai-label">DURATION (MONTHS)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-calendar" style="color: var(--xai-text-muted);"></i>
                                <input type="number" name="duration_months" value="{{ old('duration_months', $package->duration_months) }}" min="0" placeholder="1, 3, 6, 12...">
                            </div>
                            <div style="font-size:11px;color:var(--xai-text-muted);margin-top:6px;">Home page shows 1-month plans first. Set this correctly.</div>
                        </div>
                        <div class="col-md-4">
                            <label class="xai-label">DURATION (DAYS)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-clock" style="color: var(--xai-text-muted);"></i>
                                <input type="number" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="xai-label">LABEL (e.g. 1 Month)</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-text-t" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="duration_label" value="{{ old('duration_label', $package->getRawOriginal('duration_label')) }}" placeholder="e.g., 1 Month">
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="xai-label">CONNECTIONS / DEVICES</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-users-three" style="color: var(--xai-text-muted);"></i>
                                <input type="number" name="connections" value="{{ old('connections', $package->connections ?? $package->devices ?? 1) }}" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">DISPLAY ORDER</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-list-numbers" style="color: var(--xai-text-muted);"></i>
                                <input type="number" name="sort_order" value="{{ old('sort_order', $package->sort_order ?? 0) }}" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Matrix -->
                <div class="xai-card-dark p-5">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px;">FEATURES</div>
                        <button type="button" class="btn-xai-dark px-3 py-2" onclick="addFeature()">
                            <span>ADD FEATURE</span>
                        </button>
                    </div>

                    <div id="features-container">
                        @php
                            $featuresList = $package->features_list;
                            if (!is_array($featuresList)) {
                                $featuresList = [];
                            }
                        @endphp
                        @if(count($featuresList))
                            @foreach($featuresList as $feature)
                                <div class="d-flex gap-3 mb-3">
                                    <div class="search-input flex-grow-1" style="max-width: none;">
                                        <i class="ph ph-check-circle" style="color: var(--xai-text-muted);"></i>
                                        <input type="text" name="features_list[]" value="{{ is_array($feature) ? ($feature['name'] ?? '') : $feature }}" placeholder="Feature description...">
                                    </div>
                                    <button type="button" class="btn-xai-dark text-danger p-0" style="width: 44px; border-color: transparent;" onclick="this.parentElement.remove()">
                                        <i class="ph ph-trash" style="font-size: 16px; color: #ff4444;"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex gap-3 mb-3">
                                <div class="search-input flex-grow-1" style="max-width: none;">
                                    <i class="ph ph-check-circle" style="color: var(--xai-text-muted);"></i>
                                    <input type="text" name="features_list[]" placeholder="Feature description...">
                                </div>
                                <button type="button" class="btn-xai-dark text-danger p-0" style="width: 44px; border-color: transparent;" onclick="this.parentElement.remove()">
                                    <i class="ph ph-trash" style="font-size: 16px; color: #ff4444;"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Status Configuration -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">SETTINGS</div>
                    
                    <div class="d-flex align-items-center mb-4">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_active" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS ACTIVE</label>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_featured" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS FEATURED</label>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <input type="checkbox" id="is_trial" name="is_trial" value="1" {{ old('is_trial', $package->is_trial) ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_trial" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS TRIAL</label>
                    </div>

                    <div class="d-flex align-items-center">
                        <input type="checkbox" id="is_reseller" name="is_reseller" value="1" {{ old('is_reseller', $package->is_reseller) ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_reseller" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS RESELLER</label>
                    </div>
                </div>

                <!-- Operational Actions -->
                <div class="xai-card-dark p-5">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">ACTIONS</div>
                    <button type="submit" class="btn-xai-dark w-100 py-3 mb-3 justify-content-center">
                        <span>UPDATE PACKAGE</span>
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
    div.className = 'd-flex gap-3 mb-3';
    div.innerHTML = `
        <div class="search-input flex-grow-1" style="max-width: none;">
            <i class="ph ph-check-circle" style="color: var(--xai-text-muted);"></i>
            <input type="text" name="features_list[]" placeholder="Entitlement description...">
        </div>
        <button type="button" class="btn-xai-dark text-danger p-0" style="width: 44px; border-color: transparent;" onclick="this.parentElement.remove()">
            <i class="ph ph-trash" style="font-size: 16px; color: #ff4444;"></i>
        </button>
    `;
    container.appendChild(div);
}
</script>
@endpush
