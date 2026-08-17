<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - 4khdiptv</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        :root {
            --bg: #070b14;
            --panel: rgba(15, 23, 42, 0.78);
            --line: rgba(255, 255, 255, 0.12);
            --accent: #7c3aed;
            --accent-2: #db2777;
            --muted: #94a3b8;
            --font-main: 'Hanken Grotesk', sans-serif;
            --font-d: 'Outfit', sans-serif;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: #fff;
            font-family: var(--font-main);
        }
        .auth-shell {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            min-height: 100vh;
        }
        .auth-visual {
            position: relative;
            background:
                radial-gradient(circle at 10% 20%, rgba(124, 58, 237, 0.35), transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(219, 39, 119, 0.25), transparent 45%),
                linear-gradient(135deg, #0b1329 0%, #050811 100%);
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
            border-right: 1px solid var(--line);
        }
        .brand-pill {
            position: absolute;
            top: 40px;
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
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn-main:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }
        .auth-footer {
            text-align: center;
            margin-top: 18px;
            color: var(--muted);
            font-size: 14px;
        }
        .auth-footer a { color: var(--accent); font-weight: 700; text-decoration: none; }
        .status-box {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #6ee7b7;
            border-radius: 12px;
            padding: 12px 14px;
            margin-bottom: 14px;
            font-size: 13px;
            font-weight: 600;
        }
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
            .auth-visual { min-height: 240px; padding: 28px 24px; }
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
            <h1>Reset your <span>Account Password</span></h1>
            <p>Enter your account email address and we'll send you instructions to reset your password securely.</p>
            <div class="stats">
                <span class="stat-chip">Secure 2FA</span>
                <span class="stat-chip">Instant Recovery</span>
                <span class="stat-chip">24/7 Live Support</span>
            </div>
        </div>
    </section>

    <section class="auth-panel">
        <div class="form-card">
            <a href="{{ route('login') }}" class="back-link"><i class="ph ph-arrow-left"></i> Back to Sign In</a>
            <h2>Forgot Password</h2>
            <p class="lead">Enter your email address to receive a password reset link.</p>

            @if(session('status'))
                <div class="status-box">
                    <i class="ph ph-check-circle me-1"></i>{{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="err-box">
                    @foreach($errors->all() as $error)
                        <div><i class="ph ph-warning-circle me-1"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input-vault">
                    <label>Email Address</label>
                    <i class="ph ph-envelope"></i>
                    <input class="framer-input" type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required autofocus>
                </div>

                <button type="submit" class="btn-main">Send Reset Link</button>
            </form>

            <div class="auth-footer">
                Remembered your password? <a href="{{ route('login') }}">Sign In</a>
            </div>
        </div>
    </section>
</div>
</body>
</html>