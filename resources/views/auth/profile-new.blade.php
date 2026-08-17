@extends('layouts.app')

@section('title', 'My Profile - 4khdiptv')

@section('content')
<!-- Profile Hero Section -->
<section class="profile-hero-section">
    <div class="profile-hero-bg">
        <div class="hero-pattern"></div>
        <div class="hero-glow hero-glow-1"></div>
        <div class="hero-glow hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="profile-hero-wrapper" data-aos="fade-up">
            <div class="profile-hero-card">
                <div class="profile-avatar-section">
                    <div class="avatar-large">
                        <span class="avatar-initials">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        <div class="avatar-status-ring"></div>
                        <div class="avatar-status-dot"></div>
                    </div>
                    <div class="avatar-info">
                        <div class="profile-badges-top">
                            <span class="badge-pill badge-pill--primary">
                                <i class="ph-fill ph-user-circle"></i>
                                Premium Member
                            </span>
                            @if($user->isAdmin())
                            <span class="badge-pill badge-pill--gold">
                                <i class="ph-fill ph-crown"></i>
                                Administrator
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="profile-info-section">
                    <h1 class="profile-name">{{ $user->name }}</h1>
                    
                    <div class="profile-meta-list">
                        <div class="meta-item">
                            <i class="ph-fill ph-envelope"></i>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="ph-fill ph-calendar-check"></i>
                            <span>Joined {{ $user->created_at->format('F Y') }}</span>
                        </div>
                        @if($user->phone)
                        <div class="meta-item">
                            <i class="ph-fill ph-phone"></i>
                            <span>{{ $user->phone }}</span>
                        </div>
                        @endif
                        @if($user->country)
                        <div class="meta-item">
                            <i class="ph-fill ph-map-pin"></i>
                            <span>{{ $user->country }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="profile-stats-section">
                    <div class="stat-card stat-card--blue">
                        <div class="stat-icon-wrapper">
                            <i class="ph-fill ph-shopping-bag"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ $orders->count() }}</span>
                            <span class="stat-text">Total Orders</span>
                        </div>
                    </div>
                    <div class="stat-card stat-card--green">
                        <div class="stat-icon-wrapper">
                            <i class="ph-fill ph-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ $orders->where('is_active', true)->count() }}</span>
                            <span class="stat-text">Active Plans</span>
                        </div>
                    </div>
                    <div class="stat-card stat-card--purple">
                        <div class="stat-icon-wrapper">
                            <i class="ph-fill ph-currency-circle-dollar"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">${{ number_format($orders->sum('amount'), 0) }}</span>
                            <span class="stat-text">Total Spent</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Content Section -->
<section class="profile-main-section">
    <div class="container">
        <!-- Success/Error Alerts -->
        @if(session('success'))
        <div class="alert-pro alert-pro--success" data-aos="fade-in">
            <div class="alert-pro-icon">
                <i class="ph-fill ph-check-circle"></i>
            </div>
            <div class="alert-pro-content">
                <strong>Success!</strong>
                <p>{{ session('success') }}</p>
            </div>
            <button type="button" class="alert-pro-close" onclick="this.parentElement.remove()">
                <i class="ph ph-x"></i>
            </button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert-pro alert-pro--error" data-aos="fade-in">
            <div class="alert-pro-icon">
                <i class="ph-fill ph-warning-circle"></i>
            </div>
            <div class="alert-pro-content">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="alert-pro-close" onclick="this.parentElement.remove()">
                <i class="ph ph-x"></i>
            </button>
        </div>
        @endif

        <div class="profile-layout">
            <!-- Sidebar -->
            <aside class="profile-sidebar-pro" data-aos="fade-right">
                @if($user->isAdmin())
                <div class="sidebar-widget sidebar-widget--admin">
                    <div class="widget-icon">
                        <i class="ph-fill ph-crown-simple"></i>
                    </div>
                    <h3 class="widget-title">Admin Dashboard</h3>
                    <p class="widget-desc">Manage your IPTV service, users, and content</p>
                    <a href="{{ route('admin.dashboard') }}" class="widget-btn widget-btn--gold">
                        <i class="ph-fill ph-gear-six"></i>
                        <span>Open Dashboard</span>
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
                @endif

                <div class="sidebar-widget">
                    <h3 class="widget-title widget-title--icon">
                        <i class="ph-fill ph-lightning"></i>
                        Quick Actions
                    </h3>
                    <nav class="quick-nav">
                        <a href="{{ route('packages.index') }}" class="quick-nav-item">
                            <i class="ph-fill ph-package"></i>
                            <span>Browse Packages</span>
                        </a>
                        <a href="#personal-info" class="quick-nav-item">
                            <i class="ph-fill ph-user-circle-gear"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a href="#security-settings" class="quick-nav-item">
                            <i class="ph-fill ph-shield-checkered"></i>
                            <span>Security Settings</span>
                        </a>
                        <a href="#order-history" class="quick-nav-item">
                            <i class="ph-fill ph-clock-counter-clockwise"></i>
                            <span>Order History</span>
                            @if(($userUnreadOrdersCount ?? 0) > 0)
                                <span class="badge-pill badge-pill--primary">{{ $userUnreadOrdersCount }}</span>
                            @endif
                        </a>
                    </nav>
                </div>

                <div class="sidebar-widget sidebar-widget--support">
                    <div class="widget-icon widget-icon--sm">
                        <i class="ph-fill ph-lifebuoy"></i>
                    </div>
                    <h3 class="widget-title">Need Assistance?</h3>
                    <p class="widget-desc">Our support team is available 24/7 to help you</p>
                    <a href="{{ route('contact') }}" class="widget-btn widget-btn--outline">
                        <i class="ph-fill ph-chat-circle-dots"></i>
                        <span>Contact Support</span>
                    </a>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="profile-content-pro">
                <!-- Personal Information Card -->
                <div class="content-card-pro" id="personal-info" data-aos="fade-up">
                    <div class="card-header-pro">
                        <div class="card-icon-pro card-icon-pro--blue">
                            <i class="ph-fill ph-identification-card"></i>
                        </div>
                        <div class="card-header-text">
                            <h2>Personal Information</h2>
                            <p>Update your account details and contact information</p>
                        </div>
                    </div>

                    <div class="card-body-pro">
                        <form action="{{ route('profile.update') }}" method="POST" class="form-pro">
                            @csrf
                            @method('PUT')

                            <div class="form-row-pro">
                                <div class="form-group-pro">
                                    <label class="form-label-pro">
                                        <i class="ph-fill ph-user"></i>
                                        <span>Full Name</span>
                                        <span class="label-required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        class="form-control-pro @error('name') is-invalid @enderror" 
                                        value="{{ old('name', $user->name) }}" 
                                        placeholder="Enter your full name"
                                        required
                                    >
                                    @error('name')
                                    <span class="form-error-pro">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-pro">
                                    <label class="form-label-pro">
                                        <i class="ph-fill ph-at"></i>
                                        <span>Email Address</span>
                                        <span class="label-required">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        class="form-control-pro @error('email') is-invalid @enderror" 
                                        value="{{ old('email', $user->email) }}" 
                                        placeholder="your@email.com"
                                        required
                                    >
                                    @error('email')
                                    <span class="form-error-pro">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row-pro">
                                <div class="form-group-pro">
                                    <label class="form-label-pro">
                                        <i class="ph-fill ph-device-mobile"></i>
                                        <span>Phone Number</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        class="form-control-pro @error('phone') is-invalid @enderror" 
                                        value="{{ old('phone', $user->phone) }}" 
                                        placeholder="+1 (555) 000-0000"
                                    >
                                    @error('phone')
                                    <span class="form-error-pro">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-pro">
                                    <label class="form-label-pro">
                                        <i class="ph-fill ph-globe"></i>
                                        <span>Country</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="country" 
                                        class="form-control-pro @error('country') is-invalid @enderror" 
                                        value="{{ old('country', $user->country) }}" 
                                        placeholder="United States"
                                    >
                                    @error('country')
                                    <span class="form-error-pro">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-actions-pro">
                                <button type="submit" class="btn-pro btn-pro--primary btn-pro--lg">
                                    <i class="ph-fill ph-floppy-disk"></i>
                                    <span>Save Changes</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings Card -->
                <div class="content-card-pro" id="security-settings" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-header-pro">
                        <div class="card-icon-pro card-icon-pro--red">
                            <i class="ph-fill ph-lock-key"></i>
                        </div>
                        <div class="card-header-text">
                            <h2>Security & Password</h2>
                            <p>Update your password to keep your account secure</p>
                        </div>
                    </div>

                    <div class="card-body-pro">
                        <form action="{{ route('profile.password') }}" method="POST" class="form-pro">
                            @csrf
                            @method('PUT')

                            <div class="form-group-pro form-group-pro--full">
                                <label class="form-label-pro">
                                    <i class="ph-fill ph-lock"></i>
                                    <span>Current Password</span>
                                    <span class="label-required">*</span>
                                </label>
                                <input 
                                    type="password" 
                                    name="current_password" 
                                    class="form-control-pro @error('current_password') is-invalid @enderror" 
                                    placeholder="Enter your current password"
                                    required
                                >
                                @error('current_password')
                                <span class="form-error-pro">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row-pro">
                                <div class="form-group-pro">
                                    <label class="form-label-pro">
                                        <i class="ph-fill ph-key"></i>
                                        <span>New Password</span>
                                        <span class="label-required">*</span>
                                    </label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        class="form-control-pro @error('password') is-invalid @enderror" 
                                        placeholder="Minimum 8 characters"
                                        required
                                    >
                                    @error('password')
                                    <span class="form-error-pro">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group-pro">
                                    <label class="form-label-pro">
                                        <i class="ph-fill ph-password"></i>
                                        <span>Confirm Password</span>
                                        <span class="label-required">*</span>
                                    </label>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        class="form-control-pro" 
                                        placeholder="Re-enter your new password"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="form-actions-pro">
                                <button type="submit" class="btn-pro btn-pro--red btn-pro--lg">
                                    <i class="ph-fill ph-shield-check"></i>
                                    <span>Update Password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order History Card -->
                <div class="content-card-pro" id="order-history" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-header-pro">
                        <div class="card-icon-pro card-icon-pro--purple">
                            <i class="ph-fill ph-receipt"></i>
                        </div>
                        <div class="card-header-text">
                            <h2>Order History</h2>
                            <p>Track all your subscriptions and transactions</p>
                        </div>
                    </div>

                    <div class="card-body-pro card-body-pro--orders">
                        @forelse($orders as $order)
                        <div class="order-item-pro">
                            <div class="order-timeline-marker">
                                <span class="timeline-dot timeline-dot--{{ $order->is_active ? 'active' : 'inactive' }}">
                                    <i class="ph-fill ph-{{ $order->is_active ? 'check' : 'x' }}-circle"></i>
                                </span>
                                <span class="timeline-line"></span>
                            </div>
                            
                            <div class="order-content-pro">
                                <div class="order-head">
                                    <div class="order-title-section">
                                        <h3 class="order-package-name">{{ $order->package->name ?? 'N/A' }}</h3>
                                        <span class="order-number-badge">#{{ $order->order_number }}</span>
                                    </div>
                                    <div class="order-status-badges">
                                        @if($order->is_active)
                                            <span class="status-tag status-tag--success">
                                                <i class="ph-fill ph-check-circle"></i> Active
                                            </span>
                                        @else
                                            <span class="status-tag status-tag--{{ $order->status_badge ?? 'default' }}">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="order-details-grid">
                                    <div class="order-detail-box">
                                        <i class="ph-fill ph-calendar-blank"></i>
                                        <div>
                                            <span class="detail-label">Purchased</span>
                                            <span class="detail-value">{{ $order->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="order-detail-box">
                                        <i class="ph-fill ph-coins"></i>
                                        <div>
                                            <span class="detail-label">Amount</span>
                                            <span class="detail-value">${{ number_format($order->amount, 2) }}</span>
                                        </div>
                                    </div>
                                    @if($order->package)
                                    <div class="order-detail-box">
                                        <i class="ph-fill ph-timer"></i>
                                        <div>
                                            <span class="detail-label">Duration</span>
                                            <span class="detail-value">{{ $order->package->duration_label ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @if($order->expires_at)
                                    <div class="order-detail-box">
                                        <i class="ph-fill ph-{{ $order->is_active ? 'hourglass' : 'warning-circle' }}"></i>
                                        <div>
                                            <span class="detail-label">{{ $order->is_active ? 'Expires' : 'Expired' }}</span>
                                            <span class="detail-value">{{ $order->expires_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state-pro">
                            <div class="empty-icon-pro">
                                <i class="ph-fill ph-shopping-cart-simple"></i>
                            </div>
                            <h3 class="empty-title">No Orders Yet</h3>
                            <p class="empty-text">You haven't made any purchases yet. Explore our premium packages and start streaming today!</p>
                            <a href="{{ route('packages.index') }}" class="btn-pro btn-pro--primary btn-pro--lg">
                                <i class="ph-fill ph-package"></i>
                                <span>View Packages</span>
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>
@endsection
