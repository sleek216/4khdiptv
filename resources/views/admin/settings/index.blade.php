@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Settings</h1>
        <p class="xai-subheading">Site name, WhatsApp, and live chat configuration.</p>
    </div>

    <div class="xai-tabs mb-4">
        <a href="{{ route('admin.settings.index') }}" class="xai-tab {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
            <span>General</span>
        </a>
        <a href="{{ route('admin.settings.stripe') }}" class="xai-tab {{ request()->routeIs('admin.settings.stripe') ? 'active' : '' }}">
            <span>Stripe</span>
        </a>
        <a href="{{ route('admin.settings.nowpayments') }}" class="xai-tab {{ request()->routeIs('admin.settings.nowpayments') ? 'active' : '' }}">
            <span>Crypto</span>
        </a>
        <a href="{{ route('admin.settings.email') }}" class="xai-tab {{ request()->routeIs('admin.settings.email') ? 'active' : '' }}">
            <span>Email</span>
        </a>
    </div>

    @if(session('success'))
        <div class="xai-card-dark mb-4 py-3 px-4" style="border-color: var(--atlas-success) !important;">
            <div style="font-family: var(--font-display); font-size: 13px; color: var(--atlas-success);">Settings saved successfully.</div>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="xai-card-dark mb-4 p-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Support &amp; chat</h2>

                    <div class="mb-4">
                        <label for="whatsapp_number" class="xai-label">WhatsApp number</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-whatsapp" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="{{ $errors->has('whatsapp_number') ? 'is-invalid' : '' }}"
                                   id="whatsapp_number" name="whatsapp_number"
                                   value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}"
                                   placeholder="+1234567890">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">Include country code (E.164 format).</div>
                        @error('whatsapp_number')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 12px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label for="crisp_website_id" class="xai-label">Crisp website ID</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-hash" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="{{ $errors->has('crisp_website_id') ? 'is-invalid' : '' }}"
                                   id="crisp_website_id" name="crisp_website_id"
                                   value="{{ old('crisp_website_id', $settings['crisp_website_id']) }}"
                                   placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">From your Crisp chat dashboard.</div>
                        @error('crisp_website_id')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 12px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="xai-card-dark p-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Site identity</h2>

                    <div class="mb-0">
                        <label class="xai-label">Site name</label>
                        <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                            <input type="text" name="site_name" class="w-100"
                                   value="{{ $settings['site_name'] ?? config('app.name') }}"
                                   placeholder="Your site name" style="background: transparent; border: none; color: var(--xai-text-primary); outline: none;">
                        </div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">Shown in emails, titles, and headers.</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="xai-card-dark h-100 p-4">
                    <div class="stat-tile-label mb-3">Save</div>
                    <p style="font-size: 13px; color: var(--xai-text-secondary); line-height: 1.6; margin-bottom: 24px;">
                        Changes apply across the site after you save.
                    </p>

                    <button type="submit" class="btn-xai-primary w-100 py-3 mb-3 justify-content-center">
                        <span>Save changes</span>
                    </button>
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
