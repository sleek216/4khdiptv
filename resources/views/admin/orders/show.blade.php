@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-in">
        <div>
            <h1 class="xai-display">ORDER DETAILS</h1>
            <p class="xai-subheading">Detailed breakdown of <strong>Order {{ $order->order_number }}</strong>. Status: 
                <span style="color: {{ $order->order_status == 'completed' ? '#10b981' : '#f59e0b' }}; font-family: var(--font-display); letter-spacing: 1px;">{{ strtoupper($order->order_status) }}</span>
            </p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn-xai-secondary">
                <i class="ph ph-printer"></i>
                <span>PRINT</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn-xai-dark">
                <i class="ph ph-arrow-left"></i>
                <span>BACK</span>
            </a>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-8">
            <!-- Mission Summary -->
            <div class="xai-card-dark p-5 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1.5px;">ORDER SUMMARY</div>
                    <div class="d-flex gap-2">
                        <span style="color: var(--xai-text-primary); font-family: var(--font-display); padding: 4px 12px; border: 1px solid var(--xai-border-strong); border-radius: 0px; font-size: 10px; font-weight: 400; letter-spacing: 1px;">
                            PAYMENT: {{ strtoupper($order->payment_status) }}
                        </span>
                        <span style="color: var(--xai-text-primary); font-family: var(--font-display); padding: 4px 12px; border: 1px solid var(--xai-border-strong); border-radius: 0px; font-size: 10px; font-weight: 400; letter-spacing: 1px;">
                            METHOD: {{ strtoupper($order->payment_method) }}
                        </span>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">CUSTOMER INFORMATION</div>
                        <div style="font-size: 16px; font-weight: 400; color: var(--xai-text-primary);">{{ $order->customer_name }}</div>
                        <div style="font-size: 13px; color: var(--xai-text-secondary);">{{ $order->customer_email }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">PACKAGE DETAILS</div>
                        <div style="font-size: 16px; font-weight: 400; color: var(--xai-text-primary);">{{ $order->package->name ?? 'CUSTOM PACKAGE' }}</div>
                        <div style="font-size: 13px; color: var(--xai-text-secondary);">Total Amount: <span style="color: var(--xai-text-primary); font-weight: 400;">${{ number_format($order->amount, 2) }}</span></div>
                    </div>
                    <div class="col-md-6">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">PHONE NUMBER</div>
                        <div style="font-size: 14px; color: var(--xai-text-primary);">{{ $order->customer_phone ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">ORDER DATE</div>
                        <div style="font-size: 14px; color: var(--xai-text-primary); font-family: var(--font-display);">{{ $order->created_at->format('Y.m.d H:i') }} UTC</div>
                    </div>
                </div>

                @if($order->selected_countries)
                    <div class="mt-5 pt-4" style="border-top: 1px solid var(--xai-border);">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;">COUNTRY ACCESS</div>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($order->countries as $country)
                                <span style="background: transparent; color: var(--xai-text-secondary); padding: 4px 12px; border-radius: 0px; font-size: 11px; border: 1px solid var(--xai-border-strong); font-family: var(--font-display);">{{ strtoupper($country->name) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($order->notes)
                    <div class="mt-4 pt-4" style="border-top: 1px solid var(--xai-border);">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">CUSTOMER NOTES</div>
                        <div style="font-size: 13px; color: var(--xai-text-secondary); font-style: italic;">> {{ $order->notes }}</div>
                    </div>
                @endif

                @if($order->stripe_payment_id)
                    <div class="mt-4 pt-4" style="border-top: 1px solid var(--xai-border);">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">STRIPE PAYMENT ID</div>
                        <div style="font-family: var(--font-display); font-size: 11px; color: var(--xai-text-primary); border: 1px solid var(--xai-border-strong); padding: 4px 8px; border-radius: 0px; display: inline-block;">{{ $order->stripe_payment_id }}</div>
                    </div>
                @endif
            </div>

            <!-- Status Control -->
            <div class="xai-card-dark p-5 mb-4">
                <div style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 32px;">UPDATE ORDER STATUS</div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label class="config-label">ORDER STATUS</label>
                            <div class="d-flex gap-2">
                                <div class="input-vault flex-grow-1">
                                    <i class="ph ph-activity"></i>
                                    <select name="order_status" class="config-input">
                                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>PROCESSING</option>
                                        <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>COMPLETED</option>
                                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn-xai-primary py-0 px-4" style="height: 52px;">
                                    <i class="ph ph-check" style="margin: 0; font-size: 20px;"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('admin.orders.update-payment-status', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label class="config-label">PAYMENT STATUS</label>
                            <div class="d-flex gap-2">
                                <div class="input-vault flex-grow-1">
                                    <i class="ph ph-currency-dollar"></i>
                                    <select name="payment_status" class="config-input">
                                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                        <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>COMPLETED</option>
                                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>FAILED</option>
                                        <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>REFUNDED</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn-xai-primary py-0 px-4" style="height: 52px;">
                                    <i class="ph ph-check" style="margin: 0; font-size: 20px;"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-5">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_status" value="{{ $order->order_status }}">
                        <label class="config-label">ADMIN NOTES</label>
                        <div class="input-vault mb-3">
                            <i class="ph ph-note-pencil" style="top: 24px;"></i>
                            <textarea name="admin_notes" class="config-input" rows="3" style="padding-top: 16px;" placeholder="Add private notes...">{{ $order->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn-xai-secondary w-100 py-3 text-center d-block">
                            <span>SAVE NOTES</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Email Hub -->
            <div class="xai-card-dark p-5">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1.5px;">EMAIL COMMUNICATION</div>
                    @if($order->email_sent_at)
                        <span style="font-family: var(--font-display); font-size: 10px; color: #10b981; font-weight: 400; letter-spacing: 1px;">LAST_SENT: {{ $order->email_sent_at->format('Y.m.d H:i') }}</span>
                    @endif
                </div>

                <form action="{{ route('admin.orders.send-email', $order) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="config-label">EMAIL SUBJECT</label>
                        <div class="input-vault">
                            <i class="ph ph-envelope-simple"></i>
                            <input type="text" name="subject" class="config-input" value="Your subscription details - {{ $order->order_number }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="config-label">MESSAGE CONTENT</label>
                        <div class="input-vault">
                            <i class="ph ph-chat-text" style="top: 24px;"></i>
                            <textarea name="message" class="config-input" rows="4" style="padding-top: 16px;" required>Thanks for your order. Below are your subscription details.</textarea>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="custom-xai-switch">
                            <input type="checkbox" id="include_credentials" name="include_credentials" value="1">
                            <label for="include_credentials"></label>
                            <span class="ms-3" style="font-size: 13px; color: var(--xai-text-primary); font-family: var(--font-display); letter-spacing: 1px;">INCLUDE CREDENTIALS</span>
                        </div>
                    </div>

                    <div id="credentials-fields" style="display: none;" class="mt-4 pt-4 border-top border-xai">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="config-label">USERNAME</label>
                                <div class="input-vault">
                                    <i class="ph ph-user-focus"></i>
                                    <input type="text" name="username" class="config-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="config-label">PASSWORD</label>
                                <div class="input-vault">
                                    <i class="ph ph-password"></i>
                                    <input type="text" name="password" class="config-input">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="config-label">M3U URL</label>
                                <div class="input-vault">
                                    <i class="ph ph-link"></i>
                                    <input type="text" name="m3u_url" class="config-input">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="config-label">PORTAL URL</label>
                                <div class="input-vault">
                                    <i class="ph ph-globe"></i>
                                    <input type="url" name="portal_url" class="config-input" placeholder="http://portal.node.com:port">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-xai-primary w-100 py-3 mt-4 text-center d-block">
                        <i class="ph ph-paper-plane-tilt"></i>
                        <span>SEND EMAIL</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- User Account -->
            @if($order->user)
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px;">CUSTOMER ACCOUNT</div>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width: 48px; height: 48px; background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px; display: flex; align-items: center; justify-content: center; font-family: var(--font-display); font-weight: 400; color: var(--xai-text-primary);">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div style="font-weight: 400; color: var(--xai-text-primary);">{{ $order->user->name }}</div>
                            <div style="font-size: 12px; color: var(--xai-text-secondary);">{{ $order->user->email }}</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $order->user) }}" class="btn-xai-secondary w-100 py-2 d-block text-center">
                        <span>VIEW CUSTOMER</span>
                    </a>
                </div>
            @endif

            <!-- Timeline -->
            <div class="xai-card-dark p-5 mb-4">
                <div style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: var(--xai-text-secondary); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px;">ORDER TIMELINE</div>
                @if($order->activated_at)
                    <div class="mb-4">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">ACTIVATED AT</div>
                        <div style="font-size: 14px; color: var(--xai-text-primary); font-family: var(--font-display);">{{ $order->activated_at->format('Y.m.d H:i') }}</div>
                    </div>
                @endif
                @if($order->expires_at)
                    <div class="mb-4">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">EXPIRES AT</div>
                        <div style="font-size: 14px; color: var(--xai-text-primary); font-family: var(--font-display);">{{ $order->expires_at->format('Y.m.d H:i') }}</div>
                    </div>
                    <div class="mt-4 pt-4 border-top border-xai">
                        @if($order->is_active)
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 8px; height: 8px; background: #10b981; border-radius: 0px;"></div>
                                <span style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: #10b981; letter-spacing: 1px;">ACTIVE</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 8px; height: 8px; background: #ef4444; border-radius: 0px;"></div>
                                <span style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: #ef4444; letter-spacing: 1px;">EXPIRED</span>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="p-4 text-center" style="background: transparent; border: 1px solid var(--xai-border-strong); border-radius: 0px;">
                        <span style="font-family: var(--font-display); font-size: 12px; color: var(--xai-text-muted);">AWAITING ACTIVATION</span>
                    </div>
                @endif
            </div>

            <!-- Danger Zone -->
            <div class="xai-card-dark p-5" style="border-color: rgba(239, 68, 68, 0.3);">
                <div style="font-family: var(--font-display); font-size: 11px; font-weight: 400; color: #ef4444; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 24px;">DANGER ZONE</div>
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Confirm deletion of this order? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-xai-dark w-100 py-3 text-center d-block border-danger" style="color: #ef4444;">
                        <span>DELETE ORDER</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .border-xai { border-color: var(--xai-border) !important; }
    
    .config-label {
        font-family: var(--font-display);
        font-size: 11px;
        font-weight: 400;
        color: var(--xai-text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
        display: block;
    }
    
    .input-vault {
        position: relative;
        background: transparent;
        border: 1px solid var(--xai-border-strong);
        border-radius: 0px;
        transition: border 0.2s;
    }
    
    .input-vault i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--xai-text-muted);
        font-size: 20px;
    }
    
    .config-input {
        background: transparent;
        border: none;
        width: 100%;
        padding: 16px 20px 16px 56px;
        color: var(--xai-text-primary);
        font-size: 14px;
        font-family: var(--font-main);
    }
    
    .config-input:focus { outline: none; }
    
    .input-vault:focus-within {
        border-color: var(--xai-focus-ring);
        outline: 2px solid var(--xai-focus-ring);
        outline-offset: -1px;
    }
    
    /* Custom Switch for xAI */
    .custom-xai-switch {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .custom-xai-switch input { display: none; }
    .custom-xai-switch label {
        width: 44px;
        height: 24px;
        background: transparent;
        border-radius: 0px;
        position: relative;
        transition: all 0.2s;
        border: 1px solid var(--xai-border-strong);
        margin: 0;
        cursor: pointer;
    }
    .custom-xai-switch label::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        background: var(--xai-text-muted);
        border-radius: 0px;
        top: 3px;
        left: 3px;
        transition: all 0.2s;
    }
    .custom-xai-switch input:checked + label {
        border-color: var(--xai-text-primary);
    }
    .custom-xai-switch input:checked + label::after {
        left: 23px;
        background: var(--xai-text-primary);
    }
</style>
@endpush

@push('scripts')
<script>
document.getElementById('include_credentials').addEventListener('change', function() {
    const fields = document.getElementById('credentials-fields');
    if (this.checked) {
        fields.style.display = 'block';
    } else {
        fields.style.display = 'none';
    }
});
</script>
@endpush

