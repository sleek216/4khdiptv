@extends('admin.layouts.app')

@section('title', 'Email Configuration')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Email</h1>
        <p class="xai-subheading">SMTP settings for system and customer emails.</p>
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

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="{{ route('admin.settings.update-email') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">SMTP server</h2>

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="xai-label">SMTP host</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-globe" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="mail_host"
                                    value="{{ $emailSettings['mail_host'] ?? '' }}"
                                    placeholder="smtp.example.com">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="xai-label">Port</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-plug" style="color: var(--xai-text-muted);"></i>
                                <input type="number" name="mail_port"
                                    value="{{ $emailSettings['mail_port'] ?? '' }}"
                                    placeholder="587">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="xai-label">Username</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-user" style="color: var(--xai-text-muted);"></i>
                                <input type="text" name="mail_username"
                                    value="{{ $emailSettings['mail_username'] ?? '' }}"
                                    placeholder="you@example.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-label">Password</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-lock-key" style="color: var(--xai-text-muted);"></i>
                                <input type="password" name="mail_password"
                                    value="{{ $emailSettings['mail_password'] ?? '' }}"
                                    placeholder="••••••••••••">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="xai-label">Encryption</label>
                            <div class="search-input w-100" style="max-width: none; padding-left: 16px;">
                                <select class="w-100" name="mail_encryption" style="background: transparent; border: none; color: var(--xai-text-primary); outline: none; appearance: none; cursor: pointer; font-family: var(--font-display); font-size: 13px;">
                                    <option value="tls" {{ ($emailSettings['mail_encryption'] ?? '') === 'tls' ? 'selected' : '' }} style="background: var(--xai-bg);">TLS</option>
                                    <option value="ssl" {{ ($emailSettings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }} style="background: var(--xai-bg);">SSL</option>
                                    <option value="null" {{ ($emailSettings['mail_encryption'] ?? '') === 'null' ? 'selected' : '' }} style="background: var(--xai-bg);">None</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xai-card-dark p-4 mb-4">
                    <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">From address</h2>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="xai-label">From email</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-at" style="color: var(--xai-text-muted);"></i>
                                <input type="email" class="@error('mail_from_address') is-invalid @enderror"
                                    name="mail_from_address"
                                    value="{{ $emailSettings['mail_from_address'] ?? '' }}"
                                    placeholder="noreply@example.com">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="xai-label">From name</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-identification-badge" style="color: var(--xai-text-muted);"></i>
                                <input type="text" class="@error('mail_from_name') is-invalid @enderror"
                                    name="mail_from_name"
                                    value="{{ $emailSettings['mail_from_name'] ?? '' }}"
                                    placeholder="Your site name">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="xai-label">Admin notification email</label>
                            <div class="search-input w-100" style="max-width: none;">
                                <i class="ph ph-warning-circle" style="color: var(--xai-text-muted);"></i>
                                <input type="email" class="@error('admin_notification_email') is-invalid @enderror"
                                    name="admin_notification_email"
                                    value="{{ $emailSettings['admin_notification_email'] ?? '' }}"
                                    placeholder="admin@example.com">
                            </div>
                            <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">Order alerts and important notices go here.</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-xai-primary py-3 px-5 justify-content-center">
                        <span>Save email settings</span>
                    </button>
                </div>
            </form>
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
