<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow, noarchive">

    <title>Control Center Authentication — 4khdiptv</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #0A0F14;
            --bg-card: rgba(15, 23, 32, 0.85);
            --border-color: rgba(255, 255, 255, 0.1);
            --border-focus: #0B6E6A;
            --text-main: #FFFFFF;
            --text-muted: #8FB0AC;
            --accent-teal: #0B6E6A;
            --accent-teal-glow: rgba(11, 110, 106, 0.4);
            --font-display: 'Sora', sans-serif;
            --font-main: 'Source Sans 3', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(at 10% 20%, rgba(11, 110, 106, 0.18) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(196, 92, 38, 0.12) 0px, transparent 50%);
            color: var(--text-main);
            font-family: var(--font-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .admin-login-card {
            width: 100%;
            max-width: 440px;
            background: var(--bg-card);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 40px 36px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        .portal-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .shield-icon {
            width: 56px;
            height: 56px;
            background: rgba(11, 110, 106, 0.2);
            border: 1px solid var(--accent-teal);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #2dd4bf;
            margin-bottom: 16px;
            box-shadow: 0 0 20px var(--accent-teal-glow);
        }

        .portal-title {
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .portal-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            letter-spacing: 0.02em;
        }

        .form-label {
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 600;
            color: #E2E8F0;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 14px;
            color: #FFFFFF;
            font-size: 14px;
            width: 100%;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.07);
            border-color: #2dd4bf;
            box-shadow: 0 0 0 3px var(--accent-teal-glow);
            color: #FFFFFF;
        }

        .form-control-custom::placeholder {
            color: #64748B;
        }

        .btn-portal-submit {
            background: linear-gradient(135deg, #0B6E6A 0%, #0d9488 100%);
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.02em;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(11, 110, 106, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-portal-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(11, 110, 106, 0.6);
            color: #FFFFFF;
        }

        .btn-portal-submit:active {
            transform: translateY(0);
        }

        .custom-alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 12px 14px;
            color: #fca5a5;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-alert-success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 10px;
            padding: 12px 14px;
            color: #86efac;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .portal-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 12px;
            color: #64748B;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
    </style>
</head>
<body>

    <div class="admin-login-card">
        <div class="portal-header">
            <div class="shield-icon">
                <i class="ph-fill ph-shield-check"></i>
            </div>
            <h1 class="portal-title">Administrator Portal</h1>
            <p class="portal-subtitle">Secure Gateway & Command Center</p>
        </div>

        @if(session('success'))
            <div class="custom-alert-success">
                <i class="ph-fill ph-check-circle" style="font-size: 18px;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="custom-alert">
                <i class="ph-fill ph-warning-circle" style="font-size: 18px;"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @php
            $isLocked = session()->has('lockout_seconds') && session('lockout_seconds') > 0;
            $lockoutSeconds = session('lockout_seconds', 0);
        @endphp

        @if($isLocked)
            <div class="custom-alert" style="background: rgba(239, 68, 68, 0.2); border-color: rgba(239, 68, 68, 0.5); flex-direction: column; align-items: flex-start; gap: 8px;">
                <div class="d-flex align-items-center gap-2" style="font-weight: 700; color: #fca5a5;">
                    <i class="ph-fill ph-lock" style="font-size: 20px;"></i>
                    <span>SECURITY LOCKOUT ACTIVATED</span>
                </div>
                <div style="font-size: 13px; color: #fecaca;">
                    Too many failed attempts. Inputs are locked for:
                    <strong id="lockoutTimer" style="font-family: var(--font-display); font-size: 16px; color: #ffffff; background: rgba(0,0,0,0.4); padding: 2px 8px; border-radius: 6px; margin-left: 4px;"></strong>
                </div>
            </div>
        @elseif($errors->any())
            <div class="custom-alert">
                <i class="ph-fill ph-warning-circle" style="font-size: 18px;"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" id="adminLoginForm">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="ph-bold ph-user"></i> Administrator Email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control-custom" 
                    placeholder="admin@4khdiptv.org" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    autocomplete="username"
                    {{ $isLocked ? 'disabled readonly style=opacity:0.4;cursor:not-allowed;' : '' }}
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="ph-bold ph-lock-key"></i> Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control-custom" 
                    placeholder="••••••••••••" 
                    required
                    autocomplete="current-password"
                    {{ $isLocked ? 'disabled readonly style=opacity:0.4;cursor:not-allowed;' : '' }}
                >
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="form-check" style="cursor: pointer;">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" style="background-color: rgba(255,255,255,0.06); border-color: var(--border-color);" {{ $isLocked ? 'disabled' : '' }}>
                    <label class="form-check-label" for="remember" style="font-size: 13px; color: var(--text-muted); cursor: pointer;">
                        Keep session active
                    </label>
                </div>
            </div>

            <button type="submit" id="submitBtn" class="btn-portal-submit" {{ $isLocked ? 'disabled style=opacity:0.5;cursor:not-allowed;background:#374151;box-shadow:none;' : '' }}>
                @if($isLocked)
                    <i class="ph-bold ph-lock"></i> Portal Locked
                @else
                    <i class="ph-bold ph-key"></i> Authenticate Access
                @endif
            </button>
        </form>

        <div class="portal-footer">
            <i class="ph-bold ph-lock"></i> 256-bit TLS Encrypted & Monitored
        </div>
    </div>

    @if($isLocked)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let remainingSeconds = {{ (int) $lockoutSeconds }};
            const timerEl = document.getElementById('lockoutTimer');
            const submitBtn = document.getElementById('submitBtn');
            const emailInput = document.getElementById('email');
            const passInput = document.getElementById('password');

            function updateDisplay() {
                if (remainingSeconds <= 0) {
                    if (timerEl) timerEl.innerText = "00:00 - Unlocked";
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.style = "";
                        submitBtn.innerHTML = '<i class="ph-bold ph-key"></i> Authenticate Access';
                    }
                    if (emailInput) {
                        emailInput.disabled = false;
                        emailInput.readOnly = false;
                        emailInput.style = "";
                    }
                    if (passInput) {
                        passInput.disabled = false;
                        passInput.readOnly = false;
                        passInput.style = "";
                    }
                    return;
                }

                const minutes = Math.floor(remainingSeconds / 60);
                const seconds = remainingSeconds % 60;
                const formatted = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

                if (timerEl) timerEl.innerText = formatted;
                if (submitBtn) submitBtn.innerHTML = '<i class="ph-bold ph-lock"></i> Locked (' + formatted + ')';

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
