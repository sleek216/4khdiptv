@extends('layouts.app')

@section('title', 'My Referrals - 4khdiptv')

@section('content')
<!-- Page Hero Section -->
<section class="page-hero">
    <div class="page-hero-bg">
        <div class="page-hero-pattern"></div>
        <div class="page-hero-glow page-hero-glow-1"></div>
        <div class="page-hero-glow page-hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="page-hero-content">
            <div class="page-hero-text" data-aos="fade-right" data-aos-duration="800">
                <h1 class="page-hero-title">
                    My <span class="text-gradient">Referrals</span>
                </h1>
                <p class="page-hero-subtitle">
                    Track and manage all your referred users. Monitor your network growth and earnings in real-time.
                </p>
                <div class="hero-cta" style="margin-top: 1.5rem;">
                    <a href="{{ route('profile') }}#affiliate" class="btn btn-glass btn-lg">
                        <i class="ph ph-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon">
                    <i class="ph-fill ph-users-three"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $referrals->total() }}</span>
                    <span class="stat-label">Total Referrals</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="ph-fill ph-check-circle"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $affiliate->referrals()->whereNotNull('converted_at')->count() }}</span>
                    <span class="stat-label">Converted</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="ph-fill ph-percent"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">
                        {{ $referrals->total() > 0 ? number_format(($affiliate->referrals()->whereNotNull('converted_at')->count() / $referrals->total()) * 100, 1) : 0 }}%
                    </span>
                    <span class="stat-label">Conversion Rate</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">${{ number_format($affiliate->referrals->sum(function($ref) { return $ref->commissions->sum('commission_amount'); }), 2) }}</span>
                    <span class="stat-label">Total Earned</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Referrals Table Section -->
<section class="features-section" style="background: var(--gray-50);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Referral <span class="text-gradient">Details</span></h2>
            <p class="section-subtitle">
                Complete list of all users you've referred to the platform
            </p>
        </div>
        
        @if($referrals->count() > 0)
            <div class="table-container" data-aos="fade-up" data-aos-delay="200">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date Referred</th>
                                <th>User Information</th>
                                <th>Status</th>
                                <th>Commission Earned</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referrals as $referral)
                            <tr>
                                <td>
                                    <div class="table-date">
                                        <span class="date-main">{{ $referral->created_at->format('M d, Y') }}</span>
                                        <span class="date-time">{{ $referral->created_at->format('h:i A') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-user">
                                        <div class="user-avatar">
                                            <i class="ph-fill ph-user"></i>
                                        </div>
                                        <div class="user-info">
                                            <span class="user-name">{{ $referral->referredUser->name ?? 'N/A' }}</span>
                                            <span class="user-email">{{ $referral->referredUser->email ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($referral->converted_at)
                                        <span class="status-badge status-success">
                                            <i class="ph-fill ph-check-circle"></i>
                                            <span>Converted</span>
                                        </span>
                                    @else
                                        <span class="status-badge status-pending">
                                            <i class="ph-fill ph-clock"></i>
                                            <span>Pending</span>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-amount">
                                        <span class="amount-value">${{ number_format($referral->commissions->sum('commission_amount'), 2) }}</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($referrals->hasPages())
                    <div class="table-pagination">
                        {{ $referrals->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state" data-aos="fade-up" data-aos-delay="200">
                <div class="empty-state-icon">
                    <i class="ph-duotone ph-users-three"></i>
                </div>
                <h3 class="empty-state-title">No Referrals Yet</h3>
                <p class="empty-state-text">
                    Share your unique referral link to start building your network and earning commissions!
                </p>
                <a href="{{ route('profile') }}#affiliate" class="btn btn-primary btn-lg">
                    <i class="ph-fill ph-link"></i>
                    Get Your Referral Link
                </a>
            </div>
        @endif
    </div>
</section>

<style>
/* Table Container */
.table-container {
    background: var(--white);
    border-radius: var(--radius-2xl);
    border: 1px solid var(--gray-100);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

/* Data Table */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.data-table thead {
    background: var(--gray-50);
    border-bottom: 2px solid var(--gray-200);
}

.data-table th {
    padding: 1.25rem 1.5rem;
    text-align: left;
    font-weight: 700;
    font-size: 0.813rem;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.025em;
    border-bottom: 1px solid var(--gray-200);
}

.data-table tbody tr {
    border-bottom: 1px solid var(--gray-100);
    transition: background var(--transition);
}

.data-table tbody tr:last-child {
    border-bottom: none;
}

.data-table tbody tr:hover {
    background: var(--gray-50);
}

.data-table td {
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
}

/* Table Date */
.table-date {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.date-main {
    font-weight: 600;
    font-size: 0.938rem;
    color: var(--gray-900);
}

.date-time {
    font-size: 0.813rem;
    color: var(--gray-500);
}

/* Table User */
.table-user {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.user-avatar i {
    font-size: 1.5rem;
    color: var(--white);
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.user-name {
    font-weight: 700;
    font-size: 0.938rem;
    color: var(--gray-900);
}

.user-email {
    font-size: 0.813rem;
    color: var(--gray-500);
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.875rem;
}

.status-badge i {
    font-size: 1.125rem;
}

.status-success {
    background: var(--success-light, #D1FAE5);
    color: var(--success-dark, #065F46);
}

.status-pending {
    background: var(--warning-light, #FEF3C7);
    color: var(--warning-dark, #92400E);
}

/* Table Amount */
.table-amount {
    display: flex;
    flex-direction: column;
}

.amount-value {
    font-size: 1.25rem;
    font-weight: 800;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Table Pagination */
.table-pagination {
    padding: 1.5rem 2rem;
    border-top: 1px solid var(--gray-200);
    background: var(--gray-50);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    background: var(--white);
    border-radius: var(--radius-2xl);
    border: 1px solid var(--gray-100);
    box-shadow: var(--shadow-lg);
}

.empty-state-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    background: var(--primary-50, rgba(0, 102, 255, 0.06));
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-state-icon i {
    font-size: 4rem;
    color: var(--primary-500);
}

.empty-state-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: 1rem;
}

.empty-state-text {
    font-size: 1.125rem;
    color: var(--gray-600);
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
    
    .data-table {
        min-width: 600px;
    }
    
    .empty-state {
        padding: 3rem 1.5rem;
    }
}
</style>
@endsection
