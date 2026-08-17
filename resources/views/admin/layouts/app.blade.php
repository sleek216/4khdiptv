<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>4khdiptv Admin — @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=2">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            /* Harbor Desk — light ops console (100% different from old dark xAI shell) */
            --xai-bg: #E7EEF2;
            --xai-text-primary: #15202B;
            --xai-text-secondary: #3D4F5F;
            --xai-text-muted: #6B7C8A;
            --xai-text-disabled: #9AA8B3;

            --xai-border: rgba(21, 32, 43, 0.08);
            --xai-border-strong: rgba(21, 32, 43, 0.16);
            --xai-surface: #FFFFFF;
            --xai-surface-hover: #F3F7F9;

            --atlas-ink: #15202B;
            --atlas-teal: #0B6E6A;
            --atlas-teal-soft: #D8EFED;
            --atlas-amber: #C45C26;
            --atlas-amber-soft: #F8E6DC;
            --atlas-success: #1F7A4C;
            --atlas-success-soft: #D9F0E4;
            --atlas-danger: #B42318;
            --atlas-danger-soft: #F9E0DD;
            --atlas-sidebar: #0F2A2F;
            --atlas-sidebar-text: #D7E6E4;
            --atlas-sidebar-muted: #8FB0AC;
            --atlas-rail: #F7FBFC;

            --xai-focus-ring: rgba(11, 110, 106, 0.35);

            --font-display: 'Sora', sans-serif;
            --font-main: 'Source Sans 3', sans-serif;

            --sidebar-width: 268px;
            --header-height: 72px;
            --radius: 10px;
            --radius-sm: 6px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--xai-bg);
            background-image:
                radial-gradient(rgba(11, 110, 106, 0.06) 1px, transparent 1px);
            background-size: 18px 18px;
            color: var(--xai-text-primary);
            font-family: var(--font-main);
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
            background: transparent;
        }

        /* ===== Sidebar: deep teal dock (unique vs old flat dark gray) ===== */
        .sidebar {
            width: var(--sidebar-width);
            background:
                linear-gradient(165deg, #12363C 0%, var(--atlas-sidebar) 48%, #0A1F24 100%);
            border-right: none;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            padding: 28px 18px 20px;
            box-shadow: 8px 0 32px rgba(15, 42, 47, 0.12);
            transition: transform 0.28s ease;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 4px;
            background: linear-gradient(180deg, var(--atlas-teal) 0%, #F0A06A 100%);
        }

        .brand-block {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 28px;
            padding: 8px 10px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: var(--atlas-teal);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: var(--font-display);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-name {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 15px;
            color: #fff;
            letter-spacing: -0.2px;
            text-transform: none;
            line-height: 1.2;
        }

        .brand-name small {
            display: block;
            font-family: var(--font-main);
            font-size: 11px;
            font-weight: 500;
            color: var(--atlas-sidebar-muted);
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .nav-label {
            font-family: var(--font-display);
            font-size: 10px;
            font-weight: 600;
            color: var(--atlas-sidebar-muted);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 18px 10px 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: var(--atlas-sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            border-radius: var(--radius-sm);
            transition: background 0.18s ease, color 0.18s ease;
            margin-bottom: 3px;
            border-left: none !important;
        }

        .nav-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
        }

        .nav-item.active {
            color: #fff;
            background: rgba(11, 110, 106, 0.55);
            box-shadow: inset 0 0 0 1px rgba(216, 239, 237, 0.2);
        }

        .sidebar i { font-size: 18px; opacity: 0.95; }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            margin-right: -6px;
            padding-right: 6px;
        }

        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.18);
            border-radius: 4px;
        }

        .sidebar-foot {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-status {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,0.05);
        }

        .sidebar-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #3DDC97;
        }

        .sidebar-status-text {
            font-size: 12px;
            color: var(--atlas-sidebar-muted);
            line-height: 1.3;
        }

        .sidebar-status-text strong {
            display: block;
            color: #fff;
            font-weight: 600;
            font-size: 12px;
        }

        /* ===== Main ===== */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-width: 0;
            background: transparent;
            display: flex;
            flex-direction: column;
        }

        header.top-bar {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: rgba(247, 251, 252, 0.86);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom: 1px solid var(--xai-border);
        }

        .page-container {
            flex: 1;
            padding: 32px 28px 56px;
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
        }

        .menu-toggle {
            border: 1px solid var(--xai-border-strong);
            background: #fff;
            color: var(--atlas-ink);
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 42, 47, 0.45);
            z-index: 999;
        }

        .sidebar-backdrop.show { display: block; }

        /* Typography (kept class names so all admin pages restyle) */
        .xai-display {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(28px, 4vw, 40px);
            line-height: 1.15;
            color: var(--xai-text-primary);
            margin-bottom: 10px;
            letter-spacing: -1px;
            text-transform: none;
        }

        .xai-subheading {
            font-family: var(--font-main);
            font-size: 16px;
            font-weight: 400;
            color: var(--xai-text-secondary);
            max-width: 640px;
            line-height: 1.55;
        }

        /* Cards */
        .xai-card-dark,
        .xai-card-light {
            background: var(--xai-surface);
            border-radius: var(--radius);
            padding: 22px;
            border: 1px solid var(--xai-border);
            box-shadow: 0 1px 0 rgba(21, 32, 43, 0.03);
            transition: border-color 0.2s, transform 0.2s;
        }

        .xai-card-dark:hover,
        .xai-card-light:hover {
            border-color: rgba(11, 110, 106, 0.35);
        }

        /* Buttons */
        .btn-xai-primary {
            background: var(--atlas-teal);
            color: #fff;
            border: 1px solid var(--atlas-teal);
            padding: 11px 18px;
            font-weight: 600;
            font-family: var(--font-display);
            border-radius: var(--radius-sm);
            font-size: 13px;
            letter-spacing: 0;
            text-transform: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s, transform 0.15s;
            box-shadow: none;
        }

        .btn-xai-primary:hover {
            background: #095955;
            color: #fff;
            border-color: #095955;
        }

        .btn-xai-secondary,
        .btn-xai-dark {
            background: #fff;
            color: var(--atlas-ink);
            border: 1px solid var(--xai-border-strong);
            padding: 11px 18px;
            font-weight: 600;
            font-family: var(--font-display);
            border-radius: var(--radius-sm);
            font-size: 13px;
            letter-spacing: 0;
            text-transform: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s, border-color 0.2s;
            box-shadow: none;
        }

        .btn-xai-secondary:hover,
        .btn-xai-dark:hover {
            background: var(--atlas-teal-soft);
            border-color: rgba(11, 110, 106, 0.35);
            color: var(--atlas-ink);
        }

        /* Tables */
        .xai-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .xai-table th {
            padding: 14px 16px;
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 600;
            color: var(--xai-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid var(--xai-border-strong);
            text-align: left;
            background: var(--atlas-rail);
        }

        .xai-table td {
            padding: 16px;
            border-bottom: 1px solid var(--xai-border);
            color: var(--xai-text-primary);
            font-size: 14px;
            font-family: var(--font-main);
            vertical-align: middle;
            background: #fff;
        }

        .xai-table tr:last-child td { border-bottom: none; }

        /* Search */
        .search-input {
            background: #fff;
            border-radius: 999px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid var(--xai-border-strong);
            width: min(340px, 52vw);
            transition: border 0.2s, box-shadow 0.2s;
        }

        .search-input:focus-within {
            outline: none;
            border-color: var(--atlas-teal);
            box-shadow: 0 0 0 3px var(--xai-focus-ring);
        }

        .search-input input {
            background: transparent;
            border: none;
            color: var(--xai-text-primary);
            font-size: 14px;
            font-family: var(--font-main);
            width: 100%;
        }

        .search-input input::placeholder { color: var(--xai-text-disabled); }
        .search-input input:focus { outline: none; }

        /* Tabs */
        .xai-tabs {
            display: flex;
            gap: 8px;
            border-bottom: none;
            margin-bottom: 28px;
            padding: 6px;
            overflow-x: auto;
            scrollbar-width: none;
            background: #fff;
            border: 1px solid var(--xai-border);
            border-radius: var(--radius);
        }

        .xai-tabs::-webkit-scrollbar { display: none; }

        .xai-tab {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            color: var(--xai-text-muted);
            text-decoration: none !important;
            font-family: var(--font-display);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.2px;
            transition: all 0.2s ease;
            position: relative;
            text-transform: none;
            white-space: nowrap;
            border-radius: var(--radius-sm);
        }

        .xai-tab:hover { color: var(--atlas-ink); background: var(--xai-surface-hover); }

        .xai-tab.active {
            color: #fff;
            background: var(--atlas-teal);
        }

        .xai-tab.active::after { display: none; }
        .xai-tab i { font-size: 16px; }

        .xai-badge {
            font-family: var(--font-display);
            font-size: 10px;
            color: #fff;
            background: var(--atlas-amber);
            padding: 2px 7px;
            letter-spacing: 0;
            font-weight: 700;
            min-width: 18px;
            text-align: center;
            border-radius: 999px;
        }

        .nav-item.active .xai-badge {
            background: #fff;
            color: var(--atlas-teal);
        }

        /* Forms in admin pages */
        .form-control, .form-select, textarea.form-control, input.form-control {
            background: #fff !important;
            border: 1px solid var(--xai-border-strong) !important;
            color: var(--atlas-ink) !important;
            border-radius: var(--radius-sm) !important;
            min-height: 44px;
        }

        .form-control:focus, .form-select:focus, textarea.form-control:focus {
            border-color: var(--atlas-teal) !important;
            box-shadow: 0 0 0 3px var(--xai-focus-ring) !important;
        }

        .form-label {
            font-family: var(--font-display);
            font-size: 12px;
            font-weight: 600;
            color: var(--xai-text-secondary);
            margin-bottom: 6px;
        }

        .alert {
            border-radius: var(--radius-sm);
            border: 1px solid var(--xai-border);
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            background: var(--atlas-teal-soft);
            color: var(--atlas-teal);
            border: 1px solid rgba(11, 110, 106, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 14px;
        }

        .user-meta strong {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--atlas-ink);
        }

        .user-meta span {
            font-size: 12px;
            color: var(--xai-text-muted);
            font-family: var(--font-display);
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .stat-tile-label {
            font-family: var(--font-display);
            font-size: 11px;
            font-weight: 600;
            color: var(--xai-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .stat-tile-value {
            font-family: var(--font-display);
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -1px;
            color: var(--atlas-ink);
            margin-top: 10px;
        }

        .stat-tile-foot {
            margin-top: 10px;
            font-size: 13px;
            color: var(--xai-text-muted);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            font-family: var(--font-display);
        }

        .status-pill.ok {
            background: var(--atlas-success-soft);
            color: var(--atlas-success);
        }

        .status-pill.wait {
            background: var(--atlas-amber-soft);
            color: var(--atlas-amber);
        }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb {
            background: rgba(21, 32, 43, 0.18);
            border-radius: 8px;
        }

        @media (max-width: 991px) {
            .sidebar { transform: translateX(-105%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .page-container { padding: 24px 16px 40px; }
            header.top-bar { padding: 0 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar(false)"></div>

    <div class="admin-layout">
        <aside class="sidebar" id="mainSidebar">
            <a href="{{ route('admin.dashboard') }}" class="brand-block">
                <div class="brand-logo">4K</div>
                <span class="brand-name">
                    4khdiptv
                    <small>Admin Desk</small>
                </span>
            </a>

            <div class="sidebar-nav">
                <div class="nav-label">Overview</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ph ph-gauge"></i>
                    <span>Dashboard</span>
                </a>

                <div class="nav-label">Sales</div>
                <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="ph ph-receipt"></i>
                    <span>Orders</span>
                    @if(isset($adminUnreadOrdersCount) && $adminUnreadOrdersCount > 0)
                        <span class="xai-badge ms-auto">{{ $adminUnreadOrdersCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.packages.index') }}" class="nav-item {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                    <i class="ph ph-package"></i>
                    <span>Packages</span>
                </a>
                <a href="{{ route('admin.coupons.index') }}" class="nav-item {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <i class="ph ph-ticket"></i>
                    <span>Coupons</span>
                </a>

                <div class="nav-label">People</div>
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="ph ph-users-three"></i>
                    <span>Users</span>
                    @if(isset($adminUnreadUsersCount) && $adminUnreadUsersCount > 0)
                        <span class="xai-badge ms-auto">{{ $adminUnreadUsersCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="ph ph-chat-circle-dots"></i>
                    <span>Messages</span>
                    @if(isset($adminUnreadContactsCount) && $adminUnreadContactsCount > 0)
                        <span class="xai-badge ms-auto">{{ $adminUnreadContactsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.affiliate.index') }}" class="nav-item {{ request()->routeIs('admin.affiliate.*') ? 'active' : '' }}">
                    <i class="ph ph-handshake"></i>
                    <span>Affiliates</span>
                </a>

                <div class="nav-label">Content</div>
                @if(Route::has('admin.blogs.index'))
                <a href="{{ route('admin.blogs.index') }}" class="nav-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="ph ph-article"></i>
                    <span>Blog</span>
                </a>
                @endif
                <a href="{{ route('admin.announcement.index') }}" class="nav-item {{ request()->routeIs('admin.announcement.*') ? 'active' : '' }}">
                    <i class="ph ph-megaphone"></i>
                    <span>Announcements</span>
                </a>
                <a href="{{ route('admin.countries.index') }}" class="nav-item {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">
                    <i class="ph ph-globe-hemisphere-west"></i>
                    <span>Countries</span>
                </a>

                <div class="nav-label">System</div>
                <a href="{{ route('admin.export.system-backup') }}" class="nav-item">
                    <i class="ph ph-download-simple"></i>
                    <span>Backup (CSV)</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="ph ph-sliders-horizontal"></i>
                    <span>Settings</span>
                </a>
                <a href="{{ route('admin.security.index') }}" class="nav-item {{ request()->routeIs('admin.security.*') ? 'active' : '' }}">
                    <i class="ph ph-shield-check"></i>
                    <span>Security</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0 mt-3">
                    @csrf
                    <button type="submit" class="nav-item w-100 bg-transparent border-0 text-start" style="cursor: pointer;">
                        <i class="ph ph-sign-out"></i>
                        <span>Sign out</span>
                    </button>
                </form>
            </div>

            <div class="sidebar-foot">
                <div class="sidebar-status">
                    <div class="sidebar-status-dot"></div>
                    <div class="sidebar-status-text">
                        <strong>System online</strong>
                        Harbor Desk · v2
                    </div>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-bar">
                <div class="d-flex align-items-center gap-3">
                    <button class="menu-toggle d-lg-none" type="button" onclick="toggleSidebar()" aria-label="Open menu">
                        <i class="ph ph-list" style="font-size: 22px;"></i>
                    </button>
                    <div class="d-none d-lg-flex search-input">
                        <i class="ph ph-magnifying-glass" style="color: var(--xai-text-muted);"></i>
                        <input type="text" placeholder="Search admin...">
                    </div>
                </div>

                <div class="user-chip">
                    <div class="d-none d-md-block user-meta text-end">
                        <strong>{{ auth()->user()->name }}</strong>
                        <span>Administrator</span>
                    </div>
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                </div>
            </header>

            <div class="page-container">
                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar(force) {
            const sidebar = document.getElementById('mainSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const open = typeof force === 'boolean' ? force : !sidebar.classList.contains('mobile-open');
            sidebar.classList.toggle('mobile-open', open);
            backdrop.classList.toggle('show', open);
        }
    </script>
    @stack('scripts')
</body>
</html>
