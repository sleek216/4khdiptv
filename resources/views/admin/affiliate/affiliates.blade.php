@extends('admin.layouts.app')

@section('title', 'Affiliate Partners')

@section('content')
    <div class="mb-4">
        <h1 class="xai-display">Affiliates</h1>
        <p class="xai-subheading">Partners in the program, their sales, and commission rates.</p>
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

    <div class="xai-card-light p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="xai-table">
                <thead>
                    <tr>
                        <th class="ps-4">Affiliate</th>
                        <th>Code</th>
                        <th>Commission</th>
                        <th>Sales</th>
                        <th>Revenue</th>
                        <th>Earnings</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($affiliates as $affiliate)
                        <tr class="align-middle">
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 32px; height: 32px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">
                                        {{ substr($affiliate->user->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 400; color: var(--xai-text-primary); font-size: 14px;">{{ $affiliate->user->name ?? 'Unknown' }}</div>
                                        <div style="font-size: 11px; color: var(--xai-text-muted); font-family: var(--font-display);">{{ $affiliate->user->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-family: var(--font-display); color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 2px 8px; font-size: 11px;">
                                    {{ $affiliate->referral_code }}
                                </span>
                            </td>
                            <td>
                                @if($affiliate->custom_commission_rate)
                                    <span style="color: var(--xai-text-primary); font-family: var(--font-display); font-size: 12px;">{{ $affiliate->custom_commission_rate }}% <span style="font-size: 9px; color: var(--xai-text-muted);">(custom)</span></span>
                                @else
                                    <span style="color: var(--xai-text-secondary); font-family: var(--font-display); font-size: 12px;">{{ \App\Models\Setting::get('affiliate_commission_rate', 20) }}% <span style="font-size: 9px; color: var(--xai-text-muted);">(default)</span></span>
                                @endif
                            </td>
                            <td style="font-family: var(--font-display); font-size: 13px;">
                                {{ number_format($affiliate->total_referrals) }}
                            </td>
                            <td style="font-family: var(--font-display); font-size: 13px;">
                                ${{ number_format($affiliate->total_sales, 2) }}
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span style="font-family: var(--font-display); font-weight: 400; color: var(--atlas-success); font-size: 13px;">${{ number_format($affiliate->total_earnings, 2) }}</span>
                                    <span style="font-size: 10px; color: var(--xai-text-muted);">Paid: ${{ number_format($affiliate->paid_earnings, 2) }}</span>
                                </div>
                            </td>
                            <td>
                                @if($affiliate->is_active)
                                    <span style="font-family: var(--font-display); font-size: 10px; color: var(--atlas-success); letter-spacing: 0.5px; border: 1px solid var(--atlas-success); padding: 2px 8px;">Active</span>
                                @else
                                    <span style="font-family: var(--font-display); font-size: 10px; color: #ef4444; letter-spacing: 0.5px; border: 1px solid #ef4444; padding: 2px 8px;">Suspended</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.users.show', $affiliate->user) }}" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px;">
                                        View
                                    </a>

                                    <button type="button" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px;" onclick="openCommissionRateModal({{ $affiliate->user->id }}, '{{ $affiliate->custom_commission_rate !== null ? (float) $affiliate->custom_commission_rate : '' }}')">
                                        Set rate
                                    </button>

                                    <form action="{{ route('admin.affiliate.affiliates.toggle', $affiliate) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px; {{ $affiliate->is_active ? 'color: #ef4444; border-color: #ef4444;' : 'color: var(--atlas-success); border-color: var(--atlas-success);' }}">
                                            {{ $affiliate->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div style="color: var(--xai-text-muted);">
                                    <p style="font-family: var(--font-display); font-size: 12px;">No affiliates found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $affiliates->links('pagination::bootstrap-5') }}
    </div>

    <!-- Commission Rate Modal -->
    <div id="commissionRateModal" style="display: none; position: fixed; inset: 0; z-index: 2000;">
        <div style="position: absolute; inset: 0; background: var(--xai-bg); opacity: 0.92;"></div>
        <div style="position: relative; max-width: 520px; margin: 12vh auto 0; border: 1px solid var(--xai-border-strong); background: var(--xai-surface); padding: 24px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div style="font-family: var(--font-display); font-size: 14px; color: var(--xai-text-primary);">
                    Set custom commission rate
                </div>
                <button type="button" class="btn-xai-secondary" style="padding: 4px 12px; font-size: 11px;" onclick="closeCommissionRateModal()">Close</button>
            </div>

            <form id="commissionRateForm" method="POST" data-action-template="{{ route('admin.users.update-commission-rate', ['user' => '__USER__']) }}">
                @csrf
                <div class="mb-3">
                    <label for="custom_commission_rate" style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-muted); margin-bottom: 8px; display: block;">
                        Commission percentage (leave empty for default)
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        max="100"
                        name="custom_commission_rate"
                        id="custom_commission_rate"
                        placeholder="e.g. 15"
                        style="width: 100%; background: transparent; border: 1px solid var(--xai-border-strong); color: var(--xai-text-primary); padding: 10px 12px; font-family: var(--font-display);"
                    />
                    <div style="font-size: 11px; color: var(--xai-text-muted); margin-top: 8px;">This affects future commissions created for this affiliate.</div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn-xai-secondary" style="padding: 6px 14px; font-size: 11px;" onclick="closeCommissionRateModal()">Cancel</button>
                    <button type="submit" class="btn-xai-primary" style="padding: 6px 14px; font-size: 11px;">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCommissionRateModal(userId, currentRate) {
            const modal = document.getElementById('commissionRateModal');
            const form = document.getElementById('commissionRateForm');
            const input = document.getElementById('custom_commission_rate');

            const template = form.getAttribute('data-action-template');
            form.action = template.replace('__USER__', String(userId));

            input.value = currentRate || '';
            modal.style.display = 'block';
            setTimeout(() => input.focus(), 0);
        }

        function closeCommissionRateModal() {
            document.getElementById('commissionRateModal').style.display = 'none';
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeCommissionRateModal();
            }
        });
    </script>
@endsection
