@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <h1 class="xai-display">CREATE USER</h1>
        <p class="xai-subheading">Add a new user to the platform registry with secure access credentials.</p>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">USER INFORMATION</div>

                    <div class="mb-4">
                        <label for="name" class="xai-label">FULL NAME *</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-user" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                   id="name" name="name" value="{{ old('name') }}" required placeholder="ENTER FULL NAME">
                        </div>
                        @error('name')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 11px; letter-spacing: 1px;">ERROR: {{ strtoupper($message) }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="xai-label">EMAIL ADDRESS *</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-envelope" style="color: var(--xai-text-muted);"></i>
                            <input type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                   id="email" name="email" value="{{ old('email') }}" required placeholder="ENTER EMAIL ADDRESS">
                        </div>
                        @error('email')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 11px; letter-spacing: 1px;">ERROR: {{ strtoupper($message) }}</div>
                        @enderror
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="phone" class="xai-label">PHONE NUMBER</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-phone" style="color: var(--xai-text-muted);"></i>
                                <input type="text" class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" 
                                       id="phone" name="phone" value="{{ old('phone') }}" placeholder="OPTIONAL">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="country" class="xai-label">COUNTRY</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-globe" style="color: var(--xai-text-muted);"></i>
                                <input type="text" class="{{ $errors->has('country') ? 'is-invalid' : '' }}" 
                                       id="country" name="country" value="{{ old('country') }}" placeholder="OPTIONAL">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xai-card-dark p-5">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">SECURITY SETTINGS</div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="password" class="xai-label">PASSWORD *</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-key" style="color: var(--xai-text-muted);"></i>
                                <input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                       id="password" name="password" required placeholder="MIN 8 CHARS">
                            </div>
                            @error('password')
                                <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 11px; letter-spacing: 1px;">ERROR: {{ strtoupper($message) }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="xai-label">CONFIRM PASSWORD *</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-shield-check" style="color: var(--xai-text-muted);"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="CONFIRM PASSWORD">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">USER ROLE</div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_admin" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS ADMIN</label>
                    </div>
                    <p style="font-size: 12px; color: var(--xai-text-secondary); margin-top: 12px; line-height: 1.5; font-family: var(--font-main);">
                        Grants complete administrative authority across all platform layers. Use with extreme caution.
                    </p>
                </div>

                <div class="xai-card-dark p-5">
                    <button type="submit" class="btn-xai-dark w-100 py-3 mb-3 justify-content-center">
                        <span>CREATE USER</span>
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn-xai-dark w-100 py-3 justify-content-center" style="background: transparent; color: var(--xai-text-secondary);">
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
