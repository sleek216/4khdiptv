@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <h1 class="xai-display">EDIT USER</h1>
        <p class="xai-subheading">Update information and access levels for <strong class="text-white">{{ $user->name }}</strong>.</p>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Identity Matrix -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">USER INFORMATION</div>

                    <div class="mb-4">
                        <label class="xai-label">FULL NAME</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-user" style="color: var(--xai-text-muted);"></i>
                            <input type="text" class="@error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 11px; letter-spacing: 1px;">ERROR: {{ strtoupper($message) }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="xai-label">EMAIL ADDRESS</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-envelope-simple" style="color: var(--xai-text-muted);"></i>
                            <input type="email" class="@error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger mt-2" style="font-family: var(--font-display); font-size: 11px; letter-spacing: 1px;">ERROR: {{ strtoupper($message) }}</div>
                        @enderror
                    </div>

                    <div class="row g-4 mb-0">
                        <div class="col-md-6">
                            <label class="xai-label">PHONE NUMBER</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-phone" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">COUNTRY</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-globe" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="country" value="{{ old('country', $user->country) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Security Clearance -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">USER ROLE</div>
                    <div class="d-flex align-items-center mb-3">
                        <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }} style="accent-color: var(--xai-text-primary); width: 16px; height: 16px; margin-right: 12px;">
                        <label for="is_admin" style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); letter-spacing: 1px; cursor: pointer;">IS ADMIN</label>
                    </div>
                </div>

                <!-- Commands -->
                <div class="xai-card-dark p-5">
                    <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">ACTIONS</div>
                    <button type="submit" class="btn-xai-dark w-100 py-3 mb-3 justify-content-center">
                        <span>UPDATE USER</span>
                    </button>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn-xai-dark w-100 py-3 justify-content-center" style="background: transparent; color: var(--xai-text-secondary); text-decoration: none;">
                        <span>CANCEL</span>
                    </a>
                </div>

                <!-- Risk Assessment -->
                <div class="xai-card-dark p-5 mt-4" style="border: 1px solid #ff4444;">
                    <div style="font-family: var(--font-display); font-size: 12px; color: #ff4444; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px;">SECURITY WARNING</div>
                    <p style="font-size: 12px; color: var(--xai-text-secondary); line-height: 1.6; margin: 0; font-family: var(--font-main);">
                        Granting Admin Access allows full control over the platform. Ensure identity verification is completed before saving changes.
                    </p>
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
