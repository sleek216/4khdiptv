@extends('admin.layouts.app')

@section('title', 'Create Order')

@section('content')
    <div class="mb-5" data-aos="fade-in">
        <h1 class="xai-display">NEW ORDER</h1>
        <p class="xai-subheading">Configure a manual subscription order and attach it to a user profile.</p>
    </div>

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- User Association -->
                <div class="xai-card-light p-5 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-5 border-bottom pb-4" style="border-color: var(--xai-border) !important;">
                        <div>
                            <h2 style="font-family: var(--font-display); font-size: 14px; font-weight: 400; letter-spacing: 1px; margin: 0; color: var(--xai-text-primary); text-transform: uppercase;">CUSTOMER SELECTION</h2>
                            <div style="font-size: 12px; color: var(--xai-text-muted); margin-top: 4px;">Search and select the recipient of this order.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-config-label">SEARCH DATABASE</label>
                        <div class="d-flex gap-2">
                            <div class="xai-input-vault flex-grow-1">
                                <input type="text" id="user_search" class="xai-config-input" placeholder="EMAIL OR NAME">
                            </div>
                            <button type="button" class="btn-xai-dark px-4" id="search_btn" style="min-width: 100px;">
                                FIND
                            </button>
                        </div>
                        <div id="user_results_container" class="mt-3" style="display: none;">
                            <select name="user_id" id="user_id" class="xai-config-input w-100" size="4" 
                                    style="border: 1px solid var(--xai-border-strong); appearance: none;" required>
                                <!-- Options added via JS -->
                            </select>
                        </div>
                        <div class="xai-config-hint">Email search provides the highest precision.</div>
                    </div>
                </div>

                <!-- Product Configuration -->
                <div class="xai-card-light p-5">
                    <div class="d-flex align-items-center gap-3 mb-5 border-bottom pb-4" style="border-color: var(--xai-border) !important;">
                        <div>
                            <h2 style="font-family: var(--font-display); font-size: 14px; font-weight: 400; letter-spacing: 1px; margin: 0; color: var(--xai-text-primary); text-transform: uppercase;">SUBSCRIPTION PARAMETERS</h2>
                            <div style="font-size: 12px; color: var(--xai-text-muted); margin-top: 4px;">Select a service tier and adjust pricing if necessary.</div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="xai-config-label">SELECT PLAN</label>
                        <div class="xai-input-vault">
                            <select name="package_id" id="package_id" class="xai-config-input" style="appearance: none; cursor: pointer;" required>
                                <option value="">CHOOSE TIER</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" data-price="{{ $package->price }}">
                                        {{ $package->name }} [${{ number_format($package->price, 2) }}]
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="xai-config-label">BASE PRICE</label>
                            <div class="xai-input-vault">
                                <input type="text" id="base_price" class="xai-config-input" readonly value="0.00">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="xai-config-label">ADJUSTMENT ($)</label>
                            <div class="xai-input-vault">
                                <input type="number" name="adjustment_amount" id="adjustment_amount" class="xai-config-input" step="0.01" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="xai-config-hint">Positive values increase price, negative values apply discount.</div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Status Matrix -->
                <div class="xai-card-dark p-5 mb-4">
                    <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 24px;">ORDER METRICS</div>
                    
                    <div class="mb-4">
                        <label class="xai-config-label" style="color: var(--xai-text-muted);">ORDER STATUS</label>
                        <div class="xai-input-vault" style="border-color: var(--xai-border);">
                            <select name="order_status" class="xai-config-input" style="color: var(--xai-text-secondary);">
                                <option value="pending">PENDING</option>
                                <option value="processing">PROCESSING</option>
                                <option value="completed">COMPLETED</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="xai-config-label" style="color: var(--xai-text-muted);">PAYMENT STATUS</label>
                        <div class="xai-input-vault" style="border-color: var(--xai-border);">
                            <select name="payment_status" class="xai-config-input" style="color: var(--xai-text-secondary);">
                                <option value="pending">PENDING</option>
                                <option value="completed">COMPLETED</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="xai-config-label" style="color: var(--xai-text-muted);">NOTES</label>
                        <div class="xai-input-vault" style="border-color: var(--xai-border);">
                            <textarea name="notes" class="xai-config-input" rows="3" placeholder="INTERNAL LOGS..." style="color: var(--xai-text-secondary);"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Total & Submit -->
                <div class="xai-card-light p-5">
                    <div class="mb-4 border-bottom pb-4" style="border-color: var(--xai-border) !important;">
                        <div style="font-family: var(--font-display); font-size: 10px; color: var(--xai-text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">FINAL TOTAL</div>
                        <div style="font-family: var(--font-display); font-size: 32px; font-weight: 400; color: var(--xai-text-primary);" id="total_price_display">$0.00</div>
                    </div>

                    <button type="submit" class="btn-xai-dark w-100 py-3 mb-3">
                        COMMIT ORDER
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="btn-xai-light w-100 py-3 text-center" style="text-decoration: none;">
                        ABORT
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
<style>
    .xai-config-label {
        font-family: var(--font-display);
        font-size: 10px;
        color: var(--xai-text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
        display: block;
    }
    .xai-input-vault {
        background: transparent;
        border: 1px solid var(--xai-border-strong);
        border-radius: 0px;
        transition: all 0.2s;
    }
    .xai-config-input {
        background: transparent;
        border: none;
        width: 100%;
        padding: 12px 16px;
        color: var(--xai-text-primary);
        font-size: 14px;
        font-family: var(--font-display);
    }
    .xai-config-input:focus { outline: none; }
    .xai-input-vault:focus-within {
        border-color: var(--xai-text-primary);
    }
    .xai-config-hint {
        font-size: 11px;
        color: var(--xai-text-muted);
        margin-top: 8px;
    }
    #user_id option {
        padding: 10px;
        background: var(--xai-bg);
        color: var(--xai-text-primary);
    }
    #user_id option:checked {
        background: var(--xai-text-primary);
        color: var(--xai-bg);
    }
</style>
@endpush

@push('scripts')
<script>
    const userSearchInput = document.getElementById('user_search');
    const searchBtn = document.getElementById('search_btn');
    const userSelect = document.getElementById('user_id');
    const userResultsContainer = document.getElementById('user_results_container');
    const packageSelect = document.getElementById('package_id');
    const basePriceInput = document.getElementById('base_price');
    const adjustmentInput = document.getElementById('adjustment_amount');
    const totalPriceDisplay = document.getElementById('total_price_display');

    // User Search Logic
    searchBtn.addEventListener('click', function() {
        const query = userSearchInput.value;
        if(query.length < 2) return;

        searchBtn.innerHTML = 'WAIT';

        fetch('{{ route("admin.orders.search-user") }}?q=' + query)
            .then(res => res.json())
            .then(data => {
                userSelect.innerHTML = '';
                userResultsContainer.style.display = 'block';
                if(data.length === 0) {
                    const opt = document.createElement('option');
                    opt.text = 'NO MATCHING USERS';
                    opt.disabled = true;
                    userSelect.add(opt);
                } else {
                    data.forEach(user => {
                        const opt = document.createElement('option');
                        opt.value = user.id;
                        opt.text = `${user.name.toUpperCase()} <${user.email.toUpperCase()}>`;
                        userSelect.add(opt);
                    });
                    userSelect.selectedIndex = 0;
                }
                searchBtn.innerHTML = 'FIND';
            });
    });

    // Price Calculation
    function updateTotal() {
        const price = parseFloat(packageSelect.selectedOptions[0]?.dataset.price || 0);
        const adj = parseFloat(adjustmentInput.value || 0);
        
        basePriceInput.value = price.toFixed(2);
        const total = price + adj;
        totalPriceDisplay.textContent = '$' + total.toFixed(2);
    }

    packageSelect.addEventListener('change', updateTotal);
    adjustmentInput.addEventListener('input', updateTotal);
</script>
@endpush


