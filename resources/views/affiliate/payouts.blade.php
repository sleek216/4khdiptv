@extends('layouts.app')

@section('title', 'My Payouts - 4khdiptv')

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
                    My <span class="text-gradient">Payouts</span>
                </h1>
                <p class="page-hero-subtitle">
                    View and manage your payout requests. Track withdrawal history and current balance.
                </p>
                <div class="hero-cta" style="margin-top: 1.5rem;">
                    @if($affiliate->paid_earnings >= 50)
                        <a href="{{ route('affiliate.payout.request') }}" class="btn btn-primary btn-lg">
                            <i class="ph-fill ph-money"></i>
                            Request Payout
                        </a>
                    @endif
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
                    <i class="ph-fill ph-wallet"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">${{ number_format($affiliate->paid_earnings, 2) }}</span>
                    <span class="stat-label">Paid Earnings</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="ph-fill ph-clock"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">${{ number_format($affiliate->pending_earnings, 2) }}</span>
                    <span class="stat-label">Pending Earnings</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="ph-fill ph-check-circle"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">${{ number_format($affiliate->payouts()->where('status', 'completed')->sum('amount'), 2) }}</span>
                    <span class="stat-label">Total Withdrawn</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $payouts->total() }}</span>
                    <span class="stat-label">Total Requests</span>
                </div>
            </div>
        </div>
    </div>
</section>

@if($affiliate->paid_earnings < 50)
<!-- Alert Section -->
<section style="padding: 0 0 3rem;">
    <div class="container">
        <div class="alert-box" data-aos="fade-up">
            <div class="alert-icon">
                <i class="ph-fill ph-info"></i>
            </div>
            <div class="alert-content">
                <h4 class="alert-title">Minimum Payout: $50</h4>
                <p class="alert-text">
                    You need <strong>${{ number_format(50 - $affiliate->paid_earnings, 2) }}</strong> more in paid earnings to request a payout.
                </p>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Payouts Table Section -->
<section class="features-section" style="background: var(--gray-50);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Payout <span class="text-gradient">History</span></h2>
            <p class="section-subtitle">
                Track all your withdrawal requests and their current status
            </p>
        </div>
        
        @if($payouts->count() > 0)
            <div class="table-container" data-aos="fade-up" data-aos-delay="200">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Processed Date</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payouts as $payout)
                            <tr>
                                <td>
                                    <div class="table-date">
                                        <span class="date-main">{{ $payout->created_at->format('M d, Y') }}</span>
                                        <span class="date-time">{{ $payout->created_at->format('h:i A') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-amount">
                                        <span class="amount-value">${{ number_format($payout->amount, 2) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-payment">
                                        <span class="payment-method">{{ str_replace('_', ' ', ucfirst($payout->payment_method)) }}</span>
                                        @php
                                            $details = is_string($payout->payment_details) ? json_decode($payout->payment_details, true) : $payout->payment_details;
                                        @endphp
                                        @if($details)
                                            <span class="payment-detail">
                                                @if($payout->payment_method === 'paypal')
                                                    {{ $details['email'] ?? '' }}
                                                @elseif($payout->payment_method === 'crypto')
                                                    {{ isset($details['address']) ? substr($details['address'], 0, 12) . '...' : '' }}
                                                @elseif($payout->payment_method === 'bank_transfer')
                                                    {{ $details['bank_name'] ?? '' }}
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($payout->status === 'completed')
                                        <span class="status-badge status-success">
                                            <i class="ph-fill ph-check-circle"></i>
                                            <span>Completed</span>
                                        </span>
                                    @elseif($payout->status === 'pending')
                                        <span class="status-badge status-pending">
                                            <i class="ph-fill ph-clock"></i>
                                            <span>Pending</span>
                                        </span>
                                    @elseif($payout->status === 'processing')
                                        <span class="status-badge status-info">
                                            <i class="ph-fill ph-spinner"></i>
                                            <span>Processing</span>
                                        </span>
                                    @elseif($payout->status === 'rejected')
                                        <span class="status-badge status-danger">
                                            <i class="ph-fill ph-x-circle"></i>
                                            <span>Rejected</span>
                                        </span>
                                    @else
                                        <span class="status-badge status-default">
                                            <span>{{ ucfirst($payout->status) }}</span>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($payout->processed_at)
                                        <div class="table-date">
                                            <span class="date-main">{{ $payout->processed_at->format('M d, Y') }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payout->admin_notes)
                                        <span class="table-notes">{{ Str::limit($payout->admin_notes, 30) }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($payouts->hasPages())
                    <div class="table-pagination">
                        {{ $payouts->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state" data-aos="fade-up" data-aos-delay="200">
                <div class="empty-state-icon">
                    <i class="ph-duotone ph-wallet"></i>
                </div>
                <h3 class="empty-state-title">No Payouts Yet</h3>
                <p class="empty-state-text">
                    Once you reach the minimum threshold of $50, you can request a payout.
                </p>
                @if($affiliate->paid_earnings >= 50)
                    <a href="{{ route('affiliate.payout.request') }}" class="btn btn-primary btn-lg">
                        <i class="ph-fill ph-money"></i>
                        Request Your First Payout
                    </a>
                @else
                    <a href="{{ route('profile') }}#affiliate" class="btn btn-primary btn-lg">
                        <i class="ph-fill ph-arrow-left"></i>
                        Continue Earning
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<style>
/* Alert Box */
.alert-box {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    padding: 1.5rem 2rem;
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    border-radius: var(--radius-xl);
}

.alert-icon {
    width: 48px;
    height: 48px;
    background: rgba(255, 193, 7, 0.2);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.alert-icon i {
    font-size: 1.5rem;
    color: #F59E0B;
}

.alert-content {
    flex: 1;
}

.alert-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 0.5rem;
}

.alert-text {
    font-size: 0.938rem;
    color: var(--gray-700);
    margin: 0;
}

/* Table Payment */
.table-payment {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.payment-method {
    font-weight: 700;
    font-size: 0.938rem;
    color: var(--gray-900);
    text-transform: capitalize;
}

.payment-detail {
    font-size: 0.813rem;
    color: var(--gray-500);
}

/* Table Notes */
.table-notes {
    font-size: 0.875rem;
    color: var(--gray-600);
}

.text-muted {
    color: var(--gray-400);
}

.status-info {
    background: var(--primary-50, rgba(0, 102, 255, 0.1));
    color: var(--primary-700, #0052CC);
}

.status-danger {
    background: rgba(239, 68, 68, 0.1);
    color: #991B1B;
}

.status-default {
    background: var(--gray-100);
    color: var(--gray-700);
}

/* Reuse common table styles */
.table-container {
    background: var(--white);
    border-radius: var(--radius-2xl);
    border: 1px solid var(--gray-100);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

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

.table-pagination {
    padding: 1.5rem 2rem;
    border-top: 1px solid var(--gray-200);
    background: var(--gray-50);
}

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

@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
    
    .data-table {
        min-width: 900px;
    }
    
    .empty-state {
        padding: 3rem 1.5rem;
    }
    
    .alert-box {
        flex-direction: column;
    }
}
</style>
@endsection
