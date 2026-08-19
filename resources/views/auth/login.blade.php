<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | 4khdiptv</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #0b1220;
            --panel: rgba(10, 16, 28, 0.78);
            --line: rgba(255,255,255,0.12);
            --muted: #a9b4c4;
            --text: #f4f7fb;
            --accent: #7c3aed;
            --accent-2: #db2777;
            --font-d: 'Outfit', sans-serif;
            --font-b: 'Hanken Grotesk', sans-serif;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: var(--font-b);
            background: #05080f;
        }
        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
        }
        .auth-visual {
            position: relative;
            overflow: hidden;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            background:
                linear-gradient(160deg, rgba(5,12,24,0.3) 0%, rgba(5,12,24,0.8) 55%, rgba(5,12,24,0.95) 100%),
                url('{{ asset('iptv_streaming_passes_art_1776670125902.png') }}') center/cover no-repeat;
        }
        .auth-visual::before {
            content: '';
            position: absolute;
            inset: auto -10% -20% auto;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(219, 39, 119,0.28), transparent 70%);
            pointer-events: none;
        }
        .brand-pill {
            position: absolute;
            top: 36px;
            left: 48px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #fff;
            font-family: var(--font-d);
            font-weight: 800;
        }
        .brand-mark {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--accent); color: #fff;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 800;
        }
        .visual-copy h1 {
            position: relative;
            font-family: var(--font-d);
            font-size: clamp(36px, 5vw, 56px);
            line-height: 1.05;
            font-weight: 800;
            letter-spacing: -1.5px;
            margin: 0 0 16px;
            max-width: 540px;
        }
        .visual-copy h1 span { color: var(--accent-2); }
        .visual-copy p {
            position: relative;
            max-width: 460px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.55;
            margin: 0 0 28px;
        }
        .stats {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .stat-chip {
            border: 1px solid rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.06);
            border-radius: 999px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        .auth-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background:
                radial-gradient(circle at 20% 10%, rgba(219, 39, 119,0.12), transparent 35%),
                linear-gradient(180deg, #0b1322 0%, #070b14 100%);
        }
        .form-card {
            width: 100%;
            max-width: 440px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 28px;
            backdrop-filter: blur(14px);
        }
        .form-card h2 {
            font-family: var(--font-d);
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin: 0 0 6px;
        }
        .form-card .lead {
            color: var(--muted);
            margin-bottom: 22px;
            font-size: 14px;
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
        }
        .back-link:hover { color: #fff; }
        .input-vault {
            position: relative;
            border: 1px solid var(--line);
            border-radius: 12px;
            margin-bottom: 14px;
            background: rgba(255,255,255,0.02);
            transition: border-color .2s, box-shadow .2s;
        }
        .input-vault:focus-within {
            border-color: rgba(124, 58, 237,0.7);
            box-shadow: 0 0 0 3px rgba(124, 58, 237,0.15);
        }
        .input-vault label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 12px 16px 0 48px;
        }
        .input-vault > i {
            position: absolute;
            left: 16px;
            bottom: 12px;
            color: var(--accent);
            font-size: 18px;
        }
        .framer-input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #fff;
            font-size: 14px;
            padding: 6px 16px 12px 48px;
        }
        .row-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 4px 0 8px;
            color: var(--muted);
            font-size: 13px;
        }
        .row-meta label { display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
        .row-meta a { color: var(--accent); font-weight: 700; text-decoration: none; }
        .btn-main {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 14px 18px;
            margin-top: 10px;
            background: linear-gradient(135deg, #7c3aed, #db2777);
            color: #ffffff;
            font-family: var(--font-d);
            font-weight: 800;
            font-size: 15px;
        }
        .auth-footer {
            text-align: center;
            margin-top: 18px;
            color: var(--muted);
            font-size: 14px;
        }
        .auth-footer a { color: var(--accent); font-weight: 700; text-decoration: none; }
        .err-box {
            background: rgba(180,35,24,0.12);
            border: 1px solid rgba(180,35,24,0.35);
            color: #ffb4ae;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 14px;
            font-size: 13px;
            font-weight: 600;
        }
        @media (max-width: 991px) {
            .auth-shell { grid-template-columns: 1fr; }
            .auth-visual { min-height: 260px; padding: 28px 24px; }
            .brand-pill { top: 20px; left: 24px; }
            .visual-copy h1 { font-size: 32px; }
            .stats { display: none; }
        }
    </style>
</head>
<body>
<div class="auth-shell">
    <section class="auth-visual">
        <a href="{{ route('home') }}" class="brand-pill">
            <span class="brand-mark">4K</span>
            <span>4khdiptv</span>
        </a>
        <div class="visual-copy">
            <h1>Welcome back to <span>4K streaming</span></h1>
            <p>Sign in to manage your plan, continue watching, and access support anytime.</p>
            <div class="stats">
                <span class="stat-chip">20,000+ Channels</span>
                <span class="stat-chip">100,000+ VOD</span>
                <span class="stat-chip">150+ Countries</span>
            </div>
        </div>
    </section>

    <section class="auth-panel">
        <div class="form-card">
            <a href="{{ route('home') }}" class="back-link"><i class="ph ph-arrow-left"></i> Back to Home</a>
            <h2>Sign In</h2>
            <p class="lead">Enter your email and password to continue.</p>

            @php
                $isLocked = session()->has('lockout_seconds') && session('lockout_seconds') > 0;
                $lockoutSeconds = session('lockout_seconds', 0);
            @endphp

            @if($isLocked)
                <div class="err-box" style="background: rgba(219, 39, 119, 0.18); border-color: rgba(219, 39, 119, 0.5); padding: 14px 16px;">
                    <div style="font-weight: 800; font-family: var(--font-d); color: #f472b6; margin-bottom: 4px; display: flex; align-items: center; gap: 8px;">
                        <i class="ph-fill ph-lock-key" style="font-size: 18px;"></i>
                        <span>ACCOUNT ACCESS TEMPORARILY LOCKED</span>
                    </div>
                    <div style="font-size: 13px; color: #fce7f3;">
                        5 failed attempts reached. Form inputs are locked for:
                        <strong id="custLockoutTimer" style="background: rgba(0,0,0,0.5); padding: 2px 8px; border-radius: 6px; color: #ffffff; font-size: 15px; margin-left: 4px;"></strong>
                    </div>
                </div>
            @elseif($errors->any())
                <div class="err-box">
                    @foreach($errors->all() as $error)
                        <div><i class="ph ph-warning-circle me-1"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="userLoginForm">
                @csrf
                <div class="input-vault" style="{{ $isLocked ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                    <label>Email</label>
                    <i class="ph ph-envelope"></i>
                    <input class="framer-input" type="email" id="custEmail" name="email" value="{{ old('email') }}" placeholder="you@email.com" required autofocus {{ $isLocked ? 'disabled readonly' : '' }}>
                </div>
                <div class="input-vault" style="{{ $isLocked ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                    <label>Password</label>
                    <i class="ph ph-lock-key"></i>
                    <input class="framer-input" type="password" id="custPass" name="password" placeholder="Your password" required {{ $isLocked ? 'disabled readonly' : '' }}>
                </div>

                <div class="row-meta">
                    <label>
                        <input type="checkbox" name="remember" style="accent-color:#7c3aed;" {{ $isLocked ? 'disabled' : '' }}>
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" id="custSubmitBtn" class="btn-main" {{ $isLocked ? 'disabled style=opacity:0.5;cursor:not-allowed;background:#374151;' : '' }}>
                    @if($isLocked)
                        <i class="ph ph-lock"></i> Locked Out
                    @else
                        Sign In
                    @endif
                </button>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        </div>
    </section>
</div>

@if($isLocked)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let remainingSeconds = {{ (int) $lockoutSeconds }};
        const timerEl = document.getElementById('custLockoutTimer');
        const submitBtn = document.getElementById('custSubmitBtn');
        const emailInput = document.getElementById('custEmail');
        const passInput = document.getElementById('custPass');

        function updateDisplay() {
            if (remainingSeconds <= 0) {
                if (timerEl) timerEl.innerText = "00:00 - Unlocked";
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style = "";
                    submitBtn.innerText = 'Sign In';
                }
                if (emailInput) {
                    emailInput.disabled = false;
                    emailInput.readOnly = false;
                    emailInput.closest('.input-vault').style = "";
                }
                if (passInput) {
                    passInput.disabled = false;
                    passInput.readOnly = false;
                    passInput.closest('.input-vault').style = "";
                }
                return;
            }

            const minutes = Math.floor(remainingSeconds / 60);
            const seconds = remainingSeconds % 60;
            const formatted = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

            if (timerEl) timerEl.innerText = formatted;
            if (submitBtn) submitBtn.innerHTML = '<i class="ph ph-lock"></i> Locked (' + formatted + ')';

            remainingSeconds--;
        }

        updateDisplay();
        const countdownInterval = setInterval(function () {
            if (remainingSeconds <= 0) {
                clearInterval(countdownInterval);
                updateDisplay();
            } else {
                updateDisplay();
            }
        }, 1000);
    });
</script>
@endif
</body>
</html>
