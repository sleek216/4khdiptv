@extends('layouts.app')

@section('title', 'My Profile - 4khdiptv')

@section('content')
<div class="profile-page-wrapper">
    <!-- Background Elements -->
    <div class="profile-bg">
        <div class="profile-bg-gradient"></div>
        <div class="profile-bg-pattern"></div>
        <div class="profile-glow profile-glow-1"></div>
        <div class="profile-glow profile-glow-2"></div>
    </div>

    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header" data-aos="fade-down">
            <div class="profile-header-content">
                <div class="header-avatar-section">
                    <div class="profile-avatar-wrapper">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="profile-status-badge">
                            <span class="status-indicator"></span>
                            <span>Active Member</span>
                        </div>
                    </div>
                </div>
                
                <div class="header-info-section">
                    <div class="header-top">
                        <h1 class="profile-welcome">Welcome back, <span class="text-gradient">{{ $user->name }}</span></h1>
                        <div class="profile-badges">
                            <span class="badge badge-glass">
                                <i class="ph-fill ph-user"></i> {{ $user->email }}
                            </span>
                            @if($user->isAdmin())
                            <span class="badge badge-admin">
                                <i class="ph-fill ph-crown"></i> Administrator
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="header-stats">
                        <div class="header-stat-item">
                            <div class="stat-icon">
                                <i class="ph-fill ph-shopping-cart"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">{{ $orders->count() }}</span>
                                <span class="stat-label">Total Orders</span>
                            </div>
                        </div>
                        <div class="header-stat-item">
                            <div class="stat-icon icon-success">
                                <i class="ph-fill ph-check-circle"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">{{ $orders->where('is_active', true)->count() }}</span>
                                <span class="stat-label">Active Plans</span>
                            </div>
                        </div>
                        <div class="header-stat-item">
                            <div class="stat-icon icon-purple">
                                <i class="ph-fill ph-currency-dollar"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">${{ number_format($orders->sum('amount'), 0) }}</span>
                                <span class="stat-label">Total Spent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-layout-grid">
            <!-- Sidebar Navigation -->
            <aside class="profile-sidebar" data-aos="fade-right" data-aos-delay="100">
                <div class="sidebar-menu">
                    <a href="#overview" class="sidebar-link active" onclick="switchTab(event, 'overview')">
                        <i class="ph-fill ph-squares-four"></i>
                        <span>Overview</span>
                        @if(($userUnreadOrdersCount ?? 0) > 0)
                            <span class="badge badge-admin">{{ $userUnreadOrdersCount }}</span>
                        @endif
                    </a>
                    <a href="#settings" class="sidebar-link" onclick="switchTab(event, 'settings')">
                        <i class="ph-fill ph-gear"></i>
                        <span>Account Settings</span>
                    </a>
                    <a href="#security" class="sidebar-link" onclick="switchTab(event, 'security')">
                        <i class="ph-fill ph-lock-key"></i>
                        <span>Security</span>
                    </a>

                    <a href="#affiliate" class="sidebar-link" onclick="switchTab(event, 'affiliate')">
                        <i class="ph-fill ph-gift"></i>
                        <span>Affiliate Program</span>
                    </a>
                    
                    <div class="sidebar-divider"></div>
                    
                    @if($user->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link link-admin">
                        <i class="ph-fill ph-monitor"></i>
                        <span>Admin Dashboard</span>
                    </a>
                    @endif
                    
                    <a href="{{ route('packages.index') }}" class="sidebar-link link-primary">
                        <i class="ph-fill ph-plus-circle"></i>
                        <span>Buy New Package</span>
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-link link-danger">
                            <i class="ph-fill ph-sign-out"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="profile-main-content">
                <!-- Alerts -->
                @if(session('success'))
                <div class="alert-glass alert-success" data-aos="fade-in">
                    <div class="alert-icon"><i class="ph-fill ph-check-circle"></i></div>
                    <div class="alert-message">{{ session('success') }}</div>
                    <button class="alert-close" onclick="this.parentElement.remove()"><i class="ph ph-x"></i></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert-glass alert-error" data-aos="fade-in">
                    <div class="alert-icon"><i class="ph-fill ph-warning-circle"></i></div>
                    <div class="alert-message">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Overview Tab -->
                <div id="overview" class="tab-content active" data-aos="fade-up" data-aos-delay="200">
                    <div class="content-header">
                        <h2>Order History</h2>
                        <p>Manage your subscriptions and view past orders</p>
                    </div>

                    <div class="orders-container">
                        @forelse($orders as $order)
                        <div class="order-card-glass">
                            <div class="order-status-line {{ $order->is_active ? 'active' : 'expired' }}"></div>
                            <div class="order-main-info">
                                <div class="order-package-icon">
                                    <i class="ph-fill ph-television-simple"></i>
                                </div>
                                <div class="order-details">
                                    <h3>{{ $order->package->name ?? 'Premium Package' }}</h3>
                                    <span class="order-id">#{{ $order->order_number }}</span>
                                </div>
                            </div>
                            
                            <div class="order-meta-info">
                                <div class="meta-item">
                                    <span class="meta-label">Duration</span>
                                    <span class="meta-value">{{ $order->package->duration_label ?? '1 Month' }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Amount</span>
                                    <span class="meta-value price">${{ number_format($order->amount, 0) }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Status</span>
                                    <span class="status-badge {{ $order->is_active ? 'status-active' : 'status-expired' }}">
                                        {{ $order->is_active ? 'Active' : ucfirst($order->order_status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="order-actions">
                                @if($order->expires_at)
                                <div class="expiry-date">
                                    <i class="ph ph-calendar-blank"></i>
                                    <span>{{ $order->is_active ? 'Expires' : 'Expired' }} {{ $order->expires_at->format('M d, Y') }}</span>
                                </div>
                                @endif
                                @if(!$order->is_active)
                                <a href="{{ route('packages.index') }}" class="btn-renew">
                                    Renew Now
                                </a>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="empty-state-glass">
                            <div class="empty-icon">
                                <i class="ph-duotone ph-shopping-cart-simple"></i>
                            </div>
                            <h3>No active subscriptions</h3>
                            <p>You haven't purchased any packages yet. Start streaming today!</p>
                            <a href="{{ route('packages.index') }}" class="btn-primary-glow">
                                Browse Packages <i class="ph-bold ph-arrow-right"></i>
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Settings Tab -->
                <div id="settings" class="tab-content" style="display: none;">
                    <div class="content-header">
                        <h2>Account Settings</h2>
                        <p>Update your personal information</p>
                    </div>

                    <div class="glass-form-card">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-user"></i>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="Your Name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-envelope"></i>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="email@example.com">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-phone"></i>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+1 (555) 000-0000">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Country</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-globe"></i>
                                        <input type="text" name="country" value="{{ old('country', $user->country) }}" placeholder="Your Country">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn-primary-glow">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Tab -->
                <div id="security" class="tab-content" style="display: none;">
                    <div class="content-header">
                        <h2>Security</h2>
                        <p>Protect your account with a strong password</p>
                    </div>

                    <div class="glass-form-card">
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label>Current Password</label>
                                <div class="input-wrapper">
                                    <i class="ph ph-lock-open"></i>
                                    <input type="password" name="current_password" required placeholder="Enter current password">
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-lock-key"></i>
                                        <input type="password" name="password" required placeholder="Min 8 characters">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-check-square"></i>
                                        <input type="password" name="password_confirmation" required placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn-primary-glow">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Affiliate Tab -->
                <div id="affiliate" class="tab-content" style="display: none;">
                    <div class="content-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h2>Affiliate Program</h2>
                                <p>Earn 20% commission by referring friends</p>
                            </div>
                            <span class="badge badge-success" style="background: rgba(16, 185, 129, 0.1); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.2);">
                                <i class="ph-fill ph-check-circle"></i> Active
                            </span>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                        
                        <!-- Total Earnings -->
                        <div class="order-card-glass" style="display: block; padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <div class="stat-icon" style="width: 40px; height: 40px; font-size: 1.25rem;"><i class="ph-fill ph-currency-dollar"></i></div>
                                <h3 style="font-size: 0.875rem; color: var(--text-secondary); text-transform: uppercase;">Earnings</h3>
                            </div>
                            <p style="font-size: 1.75rem; font-weight: 700; color: #fff; margin: 0;">${{ number_format($stats['total_earnings'] ?? 0, 2) }}</p>
                        </div>

                        <!-- Pending -->
                        <div class="order-card-glass" style="display: block; padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(245, 158, 11, 0.1); color: #fbbf24; font-size: 1.25rem;"><i class="ph-fill ph-clock"></i></div>
                                <h3 style="font-size: 0.875rem; color: var(--text-secondary); text-transform: uppercase;">Pending</h3>
                            </div>
                            <p style="font-size: 1.75rem; font-weight: 700; color: #fff; margin: 0;">${{ number_format($stats['pending_earnings'] ?? 0, 2) }}</p>
                        </div>

                        <!-- Referrals -->
                        <div class="order-card-glass" style="display: block; padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6; font-size: 1.25rem;"><i class="ph-fill ph-users"></i></div>
                                <h3 style="font-size: 0.875rem; color: var(--text-secondary); text-transform: uppercase;">Referrals</h3>
                            </div>
                            <p style="font-size: 1.75rem; font-weight: 700; color: #fff; margin: 0;">{{ $stats['total_referrals'] ?? 0 }}</p>
                        </div>

                        <!-- Clicks -->
                        <div class="order-card-glass" style="display: block; padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(0, 212, 255, 0.1); color: #00d4ff; font-size: 1.25rem;"><i class="ph-fill ph-cursor-click"></i></div>
                                <h3 style="font-size: 0.875rem; color: var(--text-secondary); text-transform: uppercase;">Clicks</h3>
                            </div>
                            <p style="font-size: 1.75rem; font-weight: 700; color: #fff; margin: 0;">{{ $affiliate->clicks ?? 0 }}</p>
                        </div>

                    </div>

                    <!-- Referral Link & Code -->
                    <div class="glass-form-card" style="background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 82, 204, 0.2) 100%); border: 1px solid rgba(0, 102, 255, 0.2);">
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #fff; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="ph-fill ph-link"></i> Your Referral Tools
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label style="color: rgba(255,255,255,0.8);">Referral Link</label>
                                <div class="input-wrapper" style="background: rgba(0, 0, 0, 0.2);">
                                    <i class="ph ph-link"></i>
                                    <input type="text" id="referralLink" value="{{ auth()->user()->referral_link }}" readonly style="background: transparent; border: none; font-family: monospace;">
                                    <button type="button" onclick="copyToClipboard('referralLink', this)" style="background: rgba(255,255,255,0.1); border: none; color: white; padding: 4px 12px; border-radius: 6px; cursor: pointer;">
                                        <i class="ph ph-copy"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label style="color: rgba(255,255,255,0.8);">Referral Code</label>
                                <div class="input-wrapper" style="background: rgba(0, 0, 0, 0.2);">
                                    <i class="ph ph-tag"></i>
                                    <input type="text" id="referralCode" value="{{ $affiliate->referral_code }}" readonly style="background: transparent; border: none; font-family: monospace; font-weight: bold; letter-spacing: 1px;">
                                    <button type="button" onclick="copyToClipboard('referralCode', this)" style="background: rgba(255,255,255,0.1); border: none; color: white; padding: 4px 12px; border-radius: 6px; cursor: pointer;">
                                        <i class="ph ph-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="form-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                        <a href="{{ route('affiliate.referrals') }}" class="btn-primary-glow" style="text-align: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <i class="ph ph-users"></i> View Referrals
                        </a>
                        <a href="{{ route('affiliate.commissions') }}" class="btn-primary-glow" style="text-align: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <i class="ph ph-receipt"></i> Commissions
                        </a>
                        <a href="{{ route('affiliate.payouts') }}" class="btn-primary-glow" style="text-align: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <i class="ph ph-wallet"></i> Payouts
                        </a>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check for hash in URL
    if (window.location.hash) {
        const tabId = window.location.hash.substring(1);
        const tabLink = document.querySelector(`.sidebar-link[href="#${tabId}"]`);
        if (tabLink) {
            tabLink.click();
        }
    }
});

function switchTab(event, tabId) {
    if (event) event.preventDefault();
    
    // Update URL hash without scrolling
    history.pushState(null, null, `#${tabId}`);
    
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.style.display = 'none';
        tab.classList.remove('active');
    });
    
    // Show selected tab
    const selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.style.display = 'block';
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => selectedTab.classList.add('active'), 10);
    }
    
    // Update menu links
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Activate link
    const activeLink = document.querySelector(`.sidebar-link[href="#${tabId}"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function copyToClipboard(elementId, btn) {
    const input = document.getElementById(elementId);
    input.select();
    input.setSelectionRange(0, 99999); // For mobile devices
    
    navigator.clipboard.writeText(input.value).then(() => {
        const originalInfo = btn.innerHTML;
        btn.innerHTML = '<i class="ph-fill ph-check"></i>';
        btn.style.color = '#34D399';
        
        setTimeout(() => {
            btn.innerHTML = originalInfo;
            btn.style.color = '';
        }, 2000);
    });
}
</script>
@endpush

@push('styles')
<style>
/* =========================================
   4khdiptv Account Studio â€” unique dashboard
   (not glass/neon-blue clone)
   ========================================= */
:root {
    --acc-bg: #0c0a0f;
    --acc-panel: #15121c;
    --acc-panel-2: #1c1826;
    --acc-line: rgba(255, 255, 255, 0.08);
    --acc-text: #f4f0ea;
    --acc-muted: #a89fb0;
    --acc-accent: #db2777;
    --acc-accent-2: #7c3aed;
    --acc-ok: #34d399;
}

.profile-page-wrapper {
    position: relative;
    min-height: 100vh;
    padding: 120px 0 80px;
    background:
        radial-gradient(ellipse 80% 50% at 10% -10%, rgba(219, 39, 119, 0.16), transparent 55%),
        radial-gradient(ellipse 60% 40% at 100% 0%, rgba(124, 58, 237, 0.12), transparent 50%),
        var(--acc-bg);
    color: var(--acc-text);
    overflow-x: hidden;
}

.profile-bg,
.profile-bg-gradient,
.profile-bg-pattern,
.profile-glow,
.profile-glow-1,
.profile-glow-2 {
    display: none !important;
}

.profile-page-wrapper .container {
    position: relative;
    z-index: 2;
}

/* Header â€” editorial strip */
.profile-header {
    margin-bottom: 28px;
    border: 1px solid var(--acc-line);
    border-radius: 28px;
    background: linear-gradient(145deg, var(--acc-panel) 0%, #120f18 100%);
    padding: 28px;
    box-shadow: none;
    backdrop-filter: none;
}

.profile-header-content {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 22px;
    align-items: center;
}

.profile-avatar-wrapper { position: relative; display: inline-block; }

.profile-avatar {
    width: 84px;
    height: 84px;
    border-radius: 22px;
    display: grid;
    place-items: center;
    font-size: 32px;
    font-weight: 800;
    letter-spacing: -1px;
    color: #fff;
    background: linear-gradient(135deg, var(--acc-accent-2), var(--acc-accent));
    border: 1px solid rgba(255,255,255,0.12);
    box-shadow: none;
}

.profile-status-badge {
    position: absolute;
    left: 50%;
    bottom: -10px;
    transform: translateX(-50%);
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 10px;
    border-radius: 999px;
    background: #1a1522;
    border: 1px solid rgba(52, 211, 153, 0.35);
    color: var(--acc-ok);
    font-size: 11px;
    font-weight: 700;
}

.status-indicator {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--acc-ok);
    box-shadow: none;
    animation: none;
}

.profile-welcome {
    margin: 0 0 10px;
    font-size: clamp(22px, 3vw, 34px);
    font-weight: 800;
    letter-spacing: -0.03em;
    color: var(--acc-text);
    line-height: 1.15;
}

.profile-welcome .text-gradient {
    background: linear-gradient(90deg, #f9a8d4, #c4b5fd);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
}

.profile-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }

.badge-glass,
.badge-admin {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 12px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 600;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--acc-line);
    color: var(--acc-muted);
    backdrop-filter: none;
}

.badge-admin {
    color: #f9a8d4;
    border-color: rgba(219, 39, 119, 0.35);
    background: rgba(219, 39, 119, 0.1);
}

.header-stats {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.header-stat-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 16px;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--acc-line);
}

.stat-icon,
.stat-icon.icon-success,
.stat-icon.icon-purple {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    background: rgba(124, 58, 237, 0.18);
    color: #c4b5fd;
    font-size: 18px;
    box-shadow: none;
}

.stat-icon.icon-success {
    background: rgba(52, 211, 153, 0.14);
    color: var(--acc-ok);
}

.stat-icon.icon-purple {
    background: rgba(219, 39, 119, 0.14);
    color: #f9a8d4;
}

.stat-value {
    display: block;
    font-size: 20px;
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
}

.stat-label {
    display: block;
    font-size: 12px;
    color: var(--acc-muted);
    margin-top: 2px;
}

/* Layout: top tabs instead of left sidebar */
.profile-layout-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: stretch;
}

.profile-sidebar {
    width: 100%;
    position: static !important;
    background: transparent;
    border: none;
    padding: 0;
    backdrop-filter: none;
    box-shadow: none;
}

.sidebar-menu {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding: 10px;
    border-radius: 18px;
    background: var(--acc-panel);
    border: 1px solid var(--acc-line);
}

.sidebar-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 16px;
    border-radius: 999px;
    color: var(--acc-muted);
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
    background: transparent;
    border: 1px solid transparent;
    transition: 0.2s ease;
}

.sidebar-link i { font-size: 16px; }

.sidebar-link:hover {
    color: #fff;
    background: rgba(255,255,255,0.04);
}

.sidebar-link.active {
    color: #fff;
    background: linear-gradient(135deg, var(--acc-accent-2), var(--acc-accent));
    border-color: transparent;
    box-shadow: none;
}

.sidebar-divider { display: none; }

.sidebar-link.link-admin {
    color: #f9a8d4;
    border-color: rgba(219, 39, 119, 0.3);
}

.sidebar-link.link-primary {
    color: #c4b5fd;
    border-color: rgba(124, 58, 237, 0.35);
}

.sidebar-link.link-danger {
    color: #fca5a5;
    border: none;
    background: transparent;
    cursor: pointer;
    font-family: inherit;
}

.logout-form { margin: 0; }

.profile-main-content {
    width: 100%;
    background: var(--acc-panel);
    border: 1px solid var(--acc-line);
    border-radius: 24px;
    padding: 28px;
    backdrop-filter: none;
    box-shadow: none;
}

.content-header {
    margin-bottom: 22px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--acc-line);
}

.content-header h2 {
    margin: 0 0 6px;
    font-size: 24px;
    font-weight: 800;
    color: #fff;
    letter-spacing: -0.02em;
}

.content-header p {
    margin: 0;
    color: var(--acc-muted);
    font-size: 14px;
}

.orders-container { display: flex; flex-direction: column; gap: 14px; }

.order-card-glass {
    display: grid;
    grid-template-columns: 1.2fr 1fr auto;
    gap: 18px;
    align-items: center;
    padding: 18px;
    border-radius: 18px;
    background: var(--acc-panel-2);
    border: 1px solid var(--acc-line);
    position: relative;
    overflow: hidden;
    backdrop-filter: none;
}

.order-status-line {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
}

.order-status-line.active { background: var(--acc-ok); }
.order-status-line.expired { background: #f87171; }

.order-package-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: grid;
    place-items: center;
    background: rgba(124, 58, 237, 0.16);
    color: #c4b5fd;
    font-size: 22px;
}

.order-main-info { display: flex; align-items: center; gap: 14px; }
.order-details h3 { margin: 0 0 4px; font-size: 16px; color: #fff; }
.order-id { color: var(--acc-muted); font-size: 12px; }

.order-meta-info { display: flex; gap: 18px; flex-wrap: wrap; }
.meta-label { display: block; font-size: 11px; color: var(--acc-muted); margin-bottom: 4px; }
.meta-value { font-weight: 700; color: #fff; font-size: 14px; }
.meta-value.price { color: #f9a8d4; }

.status-badge {
    display: inline-flex;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}
.status-active { background: rgba(52,211,153,0.12); color: var(--acc-ok); }
.status-expired { background: rgba(248,113,113,0.12); color: #fca5a5; }

.order-actions { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
.expiry-date { color: var(--acc-muted); font-size: 12px; display: flex; gap: 6px; align-items: center; }

.btn-renew {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(219, 39, 119, 0.15);
    border: 1px solid rgba(219, 39, 119, 0.4);
    color: #f9a8d4;
    text-decoration: none;
    font-weight: 700;
    font-size: 13px;
}

.empty-state-glass {
    text-align: center;
    padding: 56px 24px;
    border-radius: 20px;
    border: 1px dashed rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.02);
}

.empty-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto 16px;
    border-radius: 20px;
    display: grid;
    place-items: center;
    font-size: 34px;
    color: #c4b5fd;
    background: rgba(124, 58, 237, 0.14);
}

.empty-state-glass h3 { margin: 0 0 8px; color: #fff; font-size: 22px; }
.empty-state-glass p { margin: 0 0 22px; color: var(--acc-muted); }

.glass-form-card {
    background: var(--acc-panel-2);
    border: 1px solid var(--acc-line);
    border-radius: 18px;
    padding: 24px;
    backdrop-filter: none;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 12px;
    font-weight: 700;
    color: var(--acc-muted);
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.input-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 14px;
    border-radius: 12px;
    background: rgba(0,0,0,0.25);
    border: 1px solid var(--acc-line);
}

.input-wrapper i { color: #c4b5fd; }
.input-wrapper input,
.input-wrapper select {
    flex: 1;
    background: transparent;
    border: none;
    color: #fff;
    padding: 14px 0;
    outline: none;
    font-family: inherit;
}

.form-actions { margin-top: 22px; }

.btn-primary-glow {
    background: linear-gradient(135deg, var(--acc-accent-2), var(--acc-accent));
    color: #fff;
    padding: 12px 22px;
    border-radius: 999px;
    border: none;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 10px 28px rgba(219, 39, 119, 0.25);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-primary-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(124, 58, 237, 0.3);
    color: #fff;
}

.alert-glass {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 18px;
    backdrop-filter: none;
}

.alert-success {
    background: rgba(52, 211, 153, 0.1);
    border: 1px solid rgba(52, 211, 153, 0.28);
    color: #6ee7b7;
}

.alert-error {
    background: rgba(248, 113, 113, 0.1);
    border: 1px solid rgba(248, 113, 113, 0.28);
    color: #fca5a5;
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    color: currentColor;
    cursor: pointer;
}

@media (max-width: 900px) {
    .header-stats { grid-template-columns: 1fr; }
    .profile-header-content { grid-template-columns: 1fr; text-align: center; justify-items: center; }
    .profile-badges { justify-content: center; }
    .order-card-glass { grid-template-columns: 1fr; }
    .order-actions { align-items: flex-start; }
    .form-grid { grid-template-columns: 1fr; }
    .profile-main-content { padding: 18px; }
}
</style>
@endpush
