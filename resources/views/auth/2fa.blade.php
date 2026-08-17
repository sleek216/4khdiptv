@extends('layouts.app')

@section('title', '2FA Verification')

@section('content')
<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-xl overflow-hidden">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h4 class="mb-0">2FA Verification</h4>
                    </div>
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="display-1 text-primary mb-3">
                                <i class="ph ph-shield-check"></i>
                            </div>
                            <h5>Two-Factor Authentication</h5>
                            <p class="text-muted">Open your authenticator app and enter the 6-digit code to continue.</p>
                        </div>

                        <form action="{{ route('2fa.verify') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label font-semibold">Verification Code</label>
                                <input type="text" name="one_time_password" class="form-control form-control-lg text-center tracking-widest font-bold" placeholder="000 000" maxlength="6" autofocus required>
                                @error('one_time_password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                Verify & Login
                            </button>
                            
                            <a href="{{ route('login') }}" class="btn btn-link w-100 text-muted">Back to Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .tracking-widest { letter-spacing: 0.5em; }
    .display-1 i { font-size: 4rem; }
</style>
@endsection
