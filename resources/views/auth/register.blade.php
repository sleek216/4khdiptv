<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | 4khdiptv</title>
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
                linear-gradient(160deg, rgba(5,12,24,0.35) 0%, rgba(5,12,24,0.82) 55%, rgba(5,12,24,0.95) 100%),
                url('{{ asset('iptv_multi_device_sync_1776669948393.png') }}') center/cover no-repeat;
        }
        .auth-visual::before {
            content: '';
            position: absolute;
            inset: auto -10% -20% auto;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(124, 58, 237,0.35), transparent 70%);
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
            letter-spacing: -0.3px;
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
            max-width: 560px;
        }
        .visual-copy h1 span { color: var(--accent); }
        .visual-copy p {
            position: relative;
            max-width: 480px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.55;
            margin: 0 0 28px;
        }
        .perk-list {
            position: relative;
            display: grid;
            gap: 12px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .perk-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #e8eef6;
            font-size: 14px;
            font-weight: 600;
        }
        .perk-list i {
            width: 28px; height: 28px; border-radius: 8px;
            background: rgba(124, 58, 237,0.16);
            color: var(--accent);
            display: inline-flex; align-items: center; justify-content: center;
        }
        .auth-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background:
                radial-gradient(circle at 80% 10%, rgba(124, 58, 237,0.12), transparent 35%),
                linear-gradient(180deg, #0b1322 0%, #070b14 100%);
        }
        .form-card {
            width: 100%;
            max-width: 460px;
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
        .framer-input, .framer-select {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #fff;
            font-size: 14px;
            padding: 6px 16px 12px 48px;
        }
        .framer-select {
            appearance: none;
            padding-right: 36px;
            cursor: pointer;
        }
        .framer-select option { color: #111; }
        .optional-tag {
            font-size: 10px;
            font-weight: 700;
            color: var(--accent-2);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-left: 6px;
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
        }
        .btn-main:hover { filter: brightness(1.05); }
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
            .auth-visual {
                min-height: 280px;
                padding: 28px 24px;
                justify-content: flex-end;
            }
            .brand-pill { top: 20px; left: 24px; }
            .visual-copy h1 { font-size: 32px; }
            .perk-list { display: none; }
            .form-card { border-radius: 18px; }
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
            <h1>Join the <span>4K</span> streaming experience</h1>
            <p>Create your free account and start watching 20,000+ live channels plus movies, sports, and news from 150+ countries.</p>
            <ul class="perk-list">
                <li><i class="ph-bold ph-television"></i> Live TV in HD &amp; 4K</li>
                <li><i class="ph-bold ph-film-slate"></i> 100,000+ VOD titles</li>
                <li><i class="ph-bold ph-device-mobile"></i> Watch on TV, phone &amp; tablet</li>
                <li><i class="ph-bold ph-lightning"></i> Easy setup in minutes</li>
            </ul>
        </div>
    </section>

    <section class="auth-panel">
        <div class="form-card">
            <a href="{{ route('home') }}" class="back-link"><i class="ph ph-arrow-left"></i> Back to Home</a>
            <h2>Create Account</h2>
            <p class="lead">Fill in your details below to get started. Country and phone are optional.</p>

            @if($errors->any())
                <div class="err-box">
                    @foreach($errors->all() as $error)
                        <div><i class="ph ph-warning-circle me-1"></i>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="input-vault">
                    <label>Full Name</label>
                    <i class="ph ph-user"></i>
                    <input class="framer-input" type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required autofocus>
                </div>

                <div class="input-vault">
                    <label>Email</label>
                    <i class="ph ph-envelope"></i>
                    <input class="framer-input" type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-vault">
                            <label>Phone <span class="optional-tag">Optional</span></label>
                            <i class="ph ph-phone"></i>
                            <input class="framer-input" type="tel" name="phone" value="{{ old('phone') }}" placeholder="+1 555 000 0000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-vault">
                            <label>Country <span class="optional-tag">Optional</span></label>
                            <i class="ph ph-globe"></i>
                            @if(!empty($countries))
                                <select class="framer-select" name="country">
                                    <option value="">Select country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" @selected(old('country') === $country)>{{ $country }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input class="framer-input" type="text" name="country" value="{{ old('country') }}" placeholder="Your country">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-vault">
                            <label>Password</label>
                            <i class="ph ph-lock-key"></i>
                            <input class="framer-input" type="password" name="password" placeholder="Min. 8 characters" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-vault">
                            <label>Confirm Password</label>
                            <i class="ph ph-shield-check"></i>
                            <input class="framer-input" type="password" name="password_confirmation" placeholder="Type password again" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-main">Create Account</button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="{{ route('login') }}">Sign In</a>
            </div>
        </div>
    </section>
</div>
</body>
</html>
