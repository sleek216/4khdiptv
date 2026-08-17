@extends('admin.layouts.app')

@section('title', 'Security Settings')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Security</h1>
        <p class="xai-subheading">Two-factor authentication and account protection.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="xai-card-dark p-4">
                <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 700; margin: 0 0 24px; color: var(--xai-text-primary); border-bottom: 1px solid var(--xai-border); padding-bottom: 12px;">Two-factor authentication</h2>

                @if(!$user->google2fa_enabled)
                    <div class="xai-card-light mb-4 py-3 px-4" style="border-color: var(--atlas-amber) !important;">
                        <div style="font-family: var(--font-display); font-size: 13px; color: var(--atlas-amber);">2FA is off. Follow the steps below to protect your account.</div>
                    </div>

                    <div class="row g-4 align-items-center">
                        <div class="col-md-5">
                            <div class="p-3 text-center" style="background: #fff; border: 1px solid var(--xai-border-strong);">
                                {!! $qrCode !!}
                            </div>
                            <div class="mt-3 text-center">
                                <code style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-primary);">Secret: {{ $secret }}</code>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-4">
                                <div style="font-family: var(--font-display); font-size: 13px; font-weight: 700; color: var(--xai-text-primary); margin-bottom: 6px;">Step 1</div>
                                <p style="font-size: 13px; color: var(--xai-text-secondary); margin: 0;">Scan this QR code with your authenticator app.</p>
                            </div>

                            <div class="mb-4">
                                <div style="font-family: var(--font-display); font-size: 13px; font-weight: 700; color: var(--xai-text-primary); margin-bottom: 6px;">Step 2</div>
                                <p style="font-size: 13px; color: var(--xai-text-secondary); margin-bottom: 12px;">Enter the 6-digit code to confirm.</p>

                                <form action="{{ route('admin.security.enable') }}" method="POST">
                                    @csrf
                                    <div class="search-input w-100 mb-3" style="max-width: none; padding-left: 16px;">
                                        <input type="text" name="secret" class="w-100 text-center"
                                               style="letter-spacing: 8px; font-weight: 400; font-size: 20px; background: transparent; border: none; color: var(--xai-text-primary); outline: none; font-family: var(--font-display);"
                                               placeholder="000000" maxlength="6" required>
                                    </div>
                                    <button type="submit" class="btn-xai-primary w-100 py-3 justify-content-center">
                                        <span>Enable 2FA</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="xai-card-light mb-4 py-3 px-4" style="border-color: var(--atlas-success) !important;">
                        <div style="font-family: var(--font-display); font-size: 13px; color: var(--atlas-success);">2FA is enabled on your account.</div>
                    </div>

                    <p style="font-size: 14px; color: var(--xai-text-secondary); line-height: 1.6; margin-bottom: 24px;">
                        Your account is protected with two-factor authentication. Turning it off makes your account less secure.
                    </p>

                    <form action="{{ route('admin.security.disable') }}" method="POST" onsubmit="return confirm('Disable two-factor authentication? This makes your account less secure.')">
                        @csrf
                        <button type="submit" class="btn-xai-secondary py-3 px-5 justify-content-center" style="border-color: #ef4444 !important; color: #ef4444 !important;">
                            <span>Disable 2FA</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="xai-card-dark h-100 p-4">
                <div class="stat-tile-label mb-3">Account status</div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span style="font-size: 13px; color: var(--xai-text-secondary);">Encryption</span>
                    <span style="font-size: 13px; color: var(--xai-text-primary);">AES-256</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <span style="font-size: 13px; color: var(--xai-text-secondary);">2FA status</span>
                    <span style="font-size: 13px; color: {{ $user->google2fa_enabled ? 'var(--atlas-success)' : 'var(--atlas-amber)' }};">{{ $user->google2fa_enabled ? 'Protected' : 'Not enabled' }}</span>
                </div>

                <div class="p-3" style="border: 1px solid var(--xai-border-strong);">
                    <div class="stat-tile-label mb-2">Tip</div>
                    <p style="font-size: 12px; color: var(--xai-text-muted); line-height: 1.5; margin: 0;">
                        Accounts with 2FA enabled are much less likely to be compromised by stolen passwords.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
