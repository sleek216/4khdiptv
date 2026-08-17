@extends('admin.layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <h1 class="xai-display">USER PROFILE</h1>
                <p class="xai-subheading">Comprehensive profile for <strong class="text-white">{{ $user->name }}</strong>. View order history and manage account security.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn-xai-dark" style="text-decoration: none;">
                <span>BACK TO USERS</span>
            </a>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-4">
            <!-- Entity Profile -->
            <div class="xai-card-dark p-5 mb-4 text-center">
                <div class="mx-auto mb-4" style="width: 64px; height: 64px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 24px;">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h2 style="font-family: var(--font-main); font-size: 20px; font-weight: 400; margin-bottom: 8px; color: var(--xai-text-primary);">{{ $user->name }}</h2>
                <div style="font-size: 12px; color: var(--xai-text-muted); font-family: var(--font-display); margin-bottom: 24px;">ID: {{ $user->id }}</div>
                
                <div class="d-flex justify-content-center gap-2 mb-4">
                    @if($user->is_admin)
                        <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-text-primary); color: var(--xai-text-primary); letter-spacing: 1px;">ADMIN</span>
                    @else
                        <span style="font-family: var(--font-display); font-size: 11px; padding: 4px 8px; border: 1px solid var(--xai-border-strong); color: var(--xai-text-secondary); letter-spacing: 1px;">CUSTOMER</span>
                    @endif
                </div>

                <div class="row g-2 mt-4 pt-4 border-top" style="border-color: var(--xai-border) !important;">
                    <div class="col-6">
                        <div style="font-size: 16px; font-weight: 400; color: var(--xai-text-primary); font-family: var(--font-display);">{{ $user->orders->count() }}</div>
                        <div style="font-size: 10px; color: var(--xai-text-secondary); font-family: var(--font-display); text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">TOTAL ORDERS</div>
                    </div>
                    <div class="col-6">
                        <div style="font-size: 16px; font-weight: 400; color: var(--xai-text-primary); font-family: var(--font-display);">${{ number_format($user->orders->sum('amount'), 2) }}</div>
                        <div style="font-size: 10px; color: var(--xai-text-secondary); font-family: var(--font-display); text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">TOTAL SPENT</div>
                    </div>
                </div>
            </div>

            <!-- Identity Markers -->
            <div class="xai-card-dark p-5 mb-4">
                <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">USER INFORMATION</div>
                <div class="mb-4">
                    <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">PHONE</div>
                    <div style="font-size: 14px; color: var(--xai-text-primary);">{{ $user->phone ?? 'N/A' }}</div>
                </div>
                <div class="mb-4">
                    <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">COUNTRY</div>
                    <div style="font-size: 14px; color: var(--xai-text-primary);">{{ $user->country ?? 'N/A' }}</div>
                </div>
                <div class="mb-4">
                    <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">LAST LOGIN</div>
                    <div style="font-size: 14px; color: var(--xai-text-primary); font-family: var(--font-display);">{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'NEVER' }}</div>
                </div>
                <div>
                    <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">JOINED DATE</div>
                    <div style="font-size: 14px; color: var(--xai-text-primary); font-family: var(--font-display);">{{ $user->created_at->format('Y-m-d') }}</div>
                </div>
            </div>

            <!-- Affiliate Settings -->
            <div class="xai-card-dark p-5 mb-4">
                <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">AFFILIATE SETTINGS</div>
                <form action="{{ route('admin.users.update-commission-rate', $user) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="xai-label">COMMISSION RATE (%)</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-percent" style="color: var(--xai-text-muted);"></i>
                            <input type="number" name="custom_commission_rate" 
                                value="{{ $user->affiliate->custom_commission_rate ?? '' }}"
                                placeholder="DEFAULT ({{ \App\Models\Setting::get('affiliate_commission_rate', 20) }}%)"
                                step="0.01" min="0" max="100">
                        </div>
                    </div>
                    <button type="submit" class="btn-xai-dark w-100 py-2 justify-content-center">
                        <span>UPDATE SETTINGS</span>
                    </button>
                </form>
            </div>

            <!-- Security Reset -->
            <div class="xai-card-dark p-5 mb-4">
                <div style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-primary); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid var(--xai-border-strong); padding-bottom: 8px;">SECURITY OVERRIDE</div>
                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="xai-label">NEW PASSWORD</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-key" style="color: var(--xai-text-muted);"></i>
                            <input type="password" name="password" required placeholder="ENTER KEY">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="xai-label">CONFIRM PASSWORD</label>
                        <div class="search-input w-100" style="max-width: none;">
                            <i class="ph ph-shield-check" style="color: var(--xai-text-muted);"></i>
                            <input type="password" name="password_confirmation" required placeholder="CONFIRM PASSWORD">
                        </div>
                    </div>
                    <button type="submit" class="btn-xai-dark w-100 py-2 justify-content-center">
                        <span>RESET PASSWORD</span>
                    </button>
                </form>
            </div>

            @if($user->id !== auth()->id())
                <div class="xai-card-dark p-5" style="border: 1px solid #ff4444;">
                    <div style="font-family: var(--font-display); font-size: 12px; color: #ff4444; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px; border-bottom: 1px solid #ff4444; padding-bottom: 8px;">DANGER ZONE</div>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('WARNING: DESTRUCTIVE ACTION. CONFIRM NODE TERMINATION?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-xai-dark w-100 py-2 justify-content-center" style="border-color: #ff4444; color: #ff4444;">
                            <span>DELETE USER</span>
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="col-lg-8">
            <!-- Order History -->
            <div class="xai-card-light p-0 mb-4">
                <div class="p-4 border-bottom" style="border-color: var(--xai-border) !important;">
                    <div class="d-flex align-items-center gap-3">
                        <h2 style="font-family: var(--font-display); font-size: 16px; font-weight: 400; letter-spacing: 1px; margin: 0; color: var(--xai-text-primary);">ORDER HISTORY</h2>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="xai-table">
                        <thead>
                            <tr>
                                <th class="ps-4">ORDER NO.</th>
                                <th>PACKAGE &amp; DURATION</th>
                                <th>AMOUNT</th>
                                <th>BOUGHT AT</th>
                                <th>EXPIRY DATE</th>
                                <th>STATUS</th>
                                <th class="text-end pe-4">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->orders as $order)
                                @php
                                    $isExpired = $order->expires_at && $order->expires_at->isPast();
                                    $isExpiringSoon = $order->expires_at && !$isExpired && $order->expires_at->diffInDays(now()) <= 3;
                                @endphp
                                <tr class="align-middle">
                                    <td class="ps-4">
                                        <div style="font-family: var(--font-display); font-size: 13px; font-weight: 700; color: var(--xai-text-primary);">
                                            {{ $order->order_number }}
                                        </div>
                                        <div style="font-size: 11px; color: var(--xai-text-muted);">{{ strtoupper($order->payment_method ?? 'N/A') }}</div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: var(--xai-text-primary);">{{ $order->package->name ?? 'Custom Plan' }}</div>
                                        <div style="font-size: 11px; color: var(--xai-text-muted);">{{ $order->package->duration_label ?? 'Standard Duration' }}</div>
                                    </td>
                                    <td style="font-family: var(--font-display); font-weight: 700; color: #059669;">${{ number_format($order->amount, 2) }}</td>
                                    <td style="font-size: 12px; color: var(--xai-text-secondary); font-family: var(--font-display);">
                                        {{ $order->created_at->format('M d, Y • h:i A') }}
                                    </td>
                                    <td style="font-size: 12px; font-family: var(--font-display);">
                                        @if($order->expires_at)
                                            <div style="font-weight: 600; color: {{ $isExpired ? '#ef4444' : ($isExpiringSoon ? '#f59e0b' : '#059669') }};">
                                                {{ $order->expires_at->format('M d, Y • h:i A') }}
                                            </div>
                                            <div style="font-size: 10px; color: var(--xai-text-muted);">
                                                {{ $isExpired ? 'Expired ' . $order->expires_at->diffForHumans() : 'Expires in ' . $order->expires_at->diffForHumans(null, true) }}
                                            </div>
                                        @else
                                            <span style="color: var(--xai-text-muted); font-size: 11px;">Lifetime / Open</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($isExpired)
                                            <span style="font-size: 11px; padding: 3px 8px; border-radius: 4px; background: #fee2e2; color: #dc2626; font-weight: 700;">EXPIRED</span>
                                        @elseif($isExpiringSoon)
                                            <span style="font-size: 11px; padding: 3px 8px; border-radius: 4px; background: #fef3c7; color: #d97706; font-weight: 700;">EXPIRING SOON</span>
                                        @elseif($order->order_status === 'completed')
                                            <span style="font-size: 11px; padding: 3px 8px; border-radius: 4px; background: #dcfce7; color: #15803d; font-weight: 700;">ACTIVE</span>
                                        @else
                                            <span style="font-size: 11px; padding: 3px 8px; border-radius: 4px; background: #f1f5f9; color: #475569; font-weight: 700;">{{ strtoupper($order->order_status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary" style="padding: 4px 12px; font-size: 12px; font-weight: 600;" title="View Order">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div style="color: var(--xai-text-muted);">
                                            <div style="font-family: var(--font-display); font-size: 13px; letter-spacing: 1px;">NO SUBSCRIPTIONS OR ORDERS FOUND</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .xai-label {
        font-family: var(--font-display);
        font-size: 11px;
        font-weight: 400;
        color: var(--xai-text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: block;
    }
</style>
@endpush
