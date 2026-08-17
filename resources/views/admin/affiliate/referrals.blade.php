@extends('admin.layouts.app')

@section('title', 'Referral History')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Referrals</h1>
        <p class="xai-subheading">Users signed up through affiliate links and their conversion status.</p>
    </div>

    <div class="xai-tabs mb-4">
        <a href="{{ route('admin.affiliate.index') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.index') ? 'active' : '' }}">
            <i class="ph ph-chart-line-up"></i>
            <span>Overview</span>
        </a>
        <a href="{{ route('admin.affiliate.affiliates') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.affiliates') ? 'active' : '' }}">
            <i class="ph ph-users"></i>
            <span>Affiliates</span>
        </a>
        <a href="{{ route('admin.affiliate.referrals') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.referrals') ? 'active' : '' }}">
            <i class="ph ph-arrows-merge"></i>
            <span>Referrals</span>
        </a>
        <a href="{{ route('admin.affiliate.commissions') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.commissions') ? 'active' : '' }}">
            <i class="ph ph-hand-coins"></i>
            <span>Commissions</span>
        </a>
        <a href="{{ route('admin.affiliate.payouts') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.payouts') ? 'active' : '' }}">
            <i class="ph ph-wallet"></i>
            <span>Payouts</span>
        </a>
        <a href="{{ route('admin.affiliate.settings') }}" class="xai-tab {{ request()->routeIs('admin.affiliate.settings') ? 'active' : '' }}">
            <i class="ph ph-sliders"></i>
            <span>Settings</span>
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-teal);">
                <span class="stat-tile-label">Total referrals</span>
                <div class="stat-tile-value">{{ $referrals->total() }}</div>
                <div class="stat-tile-foot">All referred users</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-success);">
                <span class="stat-tile-label">Converted users</span>
                <div class="stat-tile-value" style="color: var(--atlas-success);">{{ \App\Models\Referral::whereNotNull('converted_at')->count() }}</div>
                <div class="stat-tile-foot">Made a purchase</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="xai-card-dark h-100" style="border-top: 3px solid #2F6FED;">
                <span class="stat-tile-label">Conversion rate</span>
                <div class="stat-tile-value">
                    {{ number_format(\App\Models\Referral::count() > 0 ? (\App\Models\Referral::whereNotNull('converted_at')->count() / \App\Models\Referral::count()) * 100 : 0, 1) }}%
                </div>
                <div class="stat-tile-foot">Referrals who bought</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="xai-card-dark h-100" style="border-top: 3px solid var(--atlas-amber);">
                <span class="stat-tile-label">Total commissions</span>
                <div class="stat-tile-value">${{ number_format(\App\Models\Commission::sum('commission_amount'), 2) }}</div>
                <div class="stat-tile-foot">All-time earnings</div>
            </div>
        </div>
    </div>

    <div class="xai-card-light p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Date</th>
                        <th>Affiliate</th>
                        <th>New user</th>
                        <th>Status</th>
                        <th class="text-end">Earnings</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referrals as $referral)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">{{ $referral->created_at->format('M d, Y') }}</div>
                                <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">{{ $referral->created_at->format('H:i') }} UTC</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 12px;">
                                        {{ substr($referral->affiliate->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 13px;">{{ $referral->affiliate->user->name ?? 'Unknown' }}</div>
                                        <span style="font-size: 10px; color: var(--xai-text-muted); border: 1px solid var(--xai-border-strong); padding: 1px 6px; font-family: var(--font-display);">{{ $referral->referral_code }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 400; color: var(--xai-text-muted); font-size: 12px;">
                                        {{ substr($referral->referredUser->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 13px;">{{ $referral->referredUser->name ?? 'Unknown' }}</div>
                                        <div style="font-size: 10px; color: var(--xai-text-muted);">{{ $referral->referredUser->email ?? 'No email' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($referral->converted_at)
                                    <div class="d-flex flex-column gap-1">
                                        <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-success); letter-spacing: 0.5px; border: 1px solid var(--atlas-success); padding: 2px 8px; width: fit-content;">Converted</span>
                                        <div style="font-size: 10px; color: var(--xai-text-muted);">{{ $referral->converted_at->diffForHumans() }}</div>
                                    </div>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-amber); letter-spacing: 0.5px; border: 1px solid var(--atlas-amber); padding: 2px 8px; width: fit-content;">Pending</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($referral->commissions->count() > 0)
                                    <div style="font-family: var(--font-display); font-weight: 400; color: var(--atlas-success); font-size: 14px;">+${{ number_format($referral->commissions->sum('commission_amount'), 2) }}</div>
                                    <div style="font-size: 10px; color: var(--xai-text-muted);">{{ $referral->commissions->count() }} orders</div>
                                @else
                                    <span style="color: var(--xai-text-muted); font-size: 11px;">No revenue</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex flex-column align-items-end gap-2">
                            <td class="text-end pe-4">
                                <div class="d-flex flex-column align-items-end gap-2">
                                    @if($referral->commissions->whereIn('status', ['approved', 'paid'])->count() > 0)
                                        <span class="btn-xai-secondary" style="padding: 6px 10px; font-size: 10px; width: 140px; justify-content: center; text-align: center; line-height: 1.1; color: var(--atlas-success); border-color: var(--atlas-success); background: rgba(16, 185, 129, 0.08); pointer-events: none;">
                                            ✓ Approved
                                        </span>
                                    @else
                                        <form action="{{ route('admin.affiliate.referrals.approve', $referral) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-xai-primary" style="padding: 6px 10px; font-size: 10px; width: 140px; justify-content: center; text-align: center; line-height: 1.1;" title="Approve commission">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                    <button type="button" class="btn-xai-secondary" style="padding: 6px 10px; font-size: 10px; width: 140px; justify-content: center; text-align: center; line-height: 1.1;" onclick="openAdjustCommissionModal({{ $referral->id }})" title="Adjust commission percentage">
                                        Adjust commission
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <p style="font-family: var(--font-display); font-size: 12px;">No referrals found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $referrals->links('pagination::bootstrap-5') }}
    </div>

    <div id="adjustCommissionModal" style="display: none; position: fixed; inset: 0; z-index: 2000;">
        <div style="position: absolute; inset: 0; background: var(--xai-bg); opacity: 0.92;"></div>
        <div style="position: relative; max-width: 520px; margin: 12vh auto 0; border: 1px solid var(--xai-border-strong); background: var(--xai-surface); padding: 24px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div style="font-family: var(--font-display); font-size: 14px; color: var(--xai-text-primary);">
                    Adjust commission
                </div>
                <button type="button" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px;" onclick="closeAdjustCommissionModal()">Close</button>
            </div>

            <form id="adjustCommissionForm" method="POST" data-action-template="{{ route('admin.affiliate.referrals.adjust-commission', ['referral' => '__REFERRAL__']) }}">
                @csrf
                <div class="mb-3">
                    <label for="commission_rate" style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-bottom: 8px; display: block;">
                        Commission percentage
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        max="100"
                        name="commission_rate"
                        id="commission_rate"
                        required
                        placeholder="e.g. 20"
                        style="width: 100%; background: transparent; border: 1px solid var(--xai-border-strong); color: var(--xai-text-primary); padding: 10px 12px; font-family: var(--font-display);"
                    />
                    <div style="font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">This credits the commission immediately based on the referred user's paid order amount.</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn-xai-secondary" style="padding: 6px 14px; font-size: 11px;" onclick="closeAdjustCommissionModal()">Cancel</button>
                    <button type="submit" class="btn-xai-primary" style="padding: 6px 14px; font-size: 11px;">Save &amp; confirm</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAdjustCommissionModal(referralId) {
            const modal = document.getElementById('adjustCommissionModal');
            const form = document.getElementById('adjustCommissionForm');
            const input = document.getElementById('commission_rate');

            const template = form.getAttribute('data-action-template');
            form.action = template.replace('__REFERRAL__', String(referralId));

            modal.style.display = 'block';
            input.value = '';
            setTimeout(() => input.focus(), 0);
        }

        function closeAdjustCommissionModal() {
            const modal = document.getElementById('adjustCommissionModal');
            modal.style.display = 'none';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeAdjustCommissionModal();
            }
        });
    </script>
@endsection
