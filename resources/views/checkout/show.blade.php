@extends('layouts.app')

@section('title', 'Secure Checkout - ' . $package->name . ' - 4khdiptv')

@section('content')
<!-- Checkout Section -->
<section class="checkout-section">
    <div class="container">
        <div class="checkout-grid">
            <!-- Order Form -->
            <div class="checkout-form-wrapper" data-aos="fade-right">
                <div class="checkout-header">
                    <a href="{{ route('packages.index') }}" class="back-link">
                        <i class="ph ph-arrow-left"></i>
                        Return to Plans
                    </a>
                    <h1 class="checkout-title">Secure Checkout</h1>
                    <p class="checkout-subtitle">Enter your details to submit your order</p>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif
                
                @if(session('error'))
                <div class="alert alert-error">
                    <i class="ph-fill ph-x-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
                @endif
                
                @if($errors->any())
                <div class="alert alert-error">
                    <i class="ph-fill ph-x-circle"></i>
                    <div>
                        <div style="font-weight: 600; margin-bottom: 0.25rem;">Please review the errors below and try again.</div>
                        <ul style="margin: 0; padding-left: 1.25rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                
                <form action="{{ route('checkout.process', $package->slug) }}" method="POST" class="checkout-form">
                    @csrf
                    
                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="ph-fill ph-user"></i>
                            Customer Details
                        </h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="customer_name">Full Name <span class="required">*</span></label>
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required placeholder="Your full name">
                                @error('customer_name')
                                <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="customer_email">Email Address <span class="required">*</span></label>
                                <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required placeholder="your@email.com">
                                <span class="field-hint">We'll send your subscription details here</span>
                                @error('customer_email')
                                <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="customer_phone">Phone Number (Optional)</label>
                                <input type="tel" id="customer_phone" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" placeholder="+1 (555) 123-4567">
                            </div>
                        </div>
                    </div>
                    
                    @if($countries && $countries->count() > 0)
                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="ph-fill ph-globe"></i>
                            Channel Regions
                        </h3>
                        <p class="section-hint">Select the countries you want channels from (choose at least one)</p>
                        
                        <div class="countries-grid">
                            @foreach($countries as $country)
                            <label class="country-option">
                                <input type="checkbox" name="selected_countries[]" value="{{ $country->id }}" {{ in_array($country->id, old('selected_countries', [])) ? 'checked' : '' }}>
                                <div class="country-card">
                                    @php
                                        $cCode = strtolower(trim($country->code ?? ""));
                                        if ($cCode === "uk") { $cCode = "gb"; }
                                        elseif ($cCode === "usa") { $cCode = "us"; }
                                        elseif ($cCode === "ger") { $cCode = "de"; }
                                        elseif ($cCode === "fra") { $cCode = "fr"; }
                                        elseif ($cCode === "esp") { $cCode = "es"; }
                                        elseif ($cCode === "ita") { $cCode = "it"; }
                                    @endphp
                                    @if(!empty($cCode))
                                        <img src="https://flagcdn.com/w40/{{ $cCode }}.png" alt="{{ $country->name }}" class="country-flag-img" width="32" height="24" style="object-fit: cover; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.3); margin-bottom: 6px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                                        <span class="country-flag" style="display:none;">{{ $country->flag }}</span>
                                    @else
                                        <span class="country-flag">{{ $country->flag }}</span>
                                    @endif
                                    <span class="country-name">{{ $country->name }}</span>
                                    <div class="country-check">
                                        <i class="ph-fill ph-check"></i>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('selected_countries')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif
                    
                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="ph-fill ph-note-pencil"></i>
                            Extra Notes
                        </h3>
                        
                        <div class="form-group">
                            <label for="notes">Special Notes (Optional)</label>
                            <textarea id="notes" name="notes" rows="3" placeholder="Any special requirements or device info...">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="ph-fill ph-credit-card"></i>
                            Payment Method
                        </h3>
                        
                        @php
                            $cryptoEnabled = \App\Models\Setting::get('nowpayments_enabled', '0') === '1';
                            // Always offer Card + Crypto on checkout UI.
                            // Card submissions are handled via contact popup (not live Stripe charge).
                            $preferred = old('payment_method', request('pay') === 'crypto' ? 'crypto' : (request('pay') === 'card' ? 'stripe' : 'stripe'));
                            if (!in_array($preferred, ['stripe', 'crypto'], true)) {
                                $preferred = 'stripe';
                            }
                        @endphp

                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="stripe" required {{ $preferred == 'stripe' ? 'checked' : '' }}>
                                <div class="payment-card">
                                    <div class="payment-icon">
                                        <i class="ph-fill ph-credit-card"></i>
                                    </div>
                                    <div class="payment-info">
                                        <span class="payment-name">Card</span>
                                        <span class="payment-desc">Visa, Mastercard, Amex</span>
                                    </div>
                                    <div class="payment-check">
                                        <i class="ph-fill ph-check-circle"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="crypto" required {{ $preferred == 'crypto' ? 'checked' : '' }}>
                                <div class="payment-card">
                                    <div class="payment-icon">
                                        <i class="ph-fill ph-currency-btc"></i>
                                    </div>
                                    <div class="payment-info">
                                        <span class="payment-name">Crypto</span>
                                        <span class="payment-desc">Bitcoin, Ethereum, USDT</span>
                                    </div>
                                    <div class="payment-check">
                                        <i class="ph-fill ph-check-circle"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Crypto Currency Selection (shown only when crypto is selected) -->
                    <div class="form-section" id="crypto-currency-section" style="display: none;">
                        <h3 class="section-label">
                            <i class="ph-fill ph-currency-circle-dollar"></i>
                            Choose Crypto
                        </h3>
                        <p class="section-hint">Select the cryptocurrency you want to pay with</p>
                        
                        <div class="form-group">
                            <label for="crypto_currency">Cryptocurrency</label>
                            <select id="crypto_currency" name="crypto_currency" class="form-select">
                                <option value="">Choose Currency</option>
                                <option value="btc" {{ old('crypto_currency') == 'btc' ? 'selected' : '' }}>Bitcoin (BTC)</option>
                                <option value="eth" {{ old('crypto_currency') == 'eth' ? 'selected' : '' }}>Ethereum (ETH)</option>
                                <option value="usdt" {{ old('crypto_currency') == 'usdt' ? 'selected' : '' }}>Tether (USDT)</option>
                                <option value="ltc" {{ old('crypto_currency') == 'ltc' ? 'selected' : '' }}>Litecoin (LTC)</option>
                                <option value="bnb" {{ old('crypto_currency') == 'bnb' ? 'selected' : '' }}>Binance Coin (BNB)</option>
                                <option value="trx" {{ old('crypto_currency') == 'trx' ? 'selected' : '' }}>TRON (TRX)</option>
                                <option value="xrp" {{ old('crypto_currency') == 'xrp' ? 'selected' : '' }}>Ripple (XRP)</option>
                            </select>
                            @error('crypto_currency')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Referral Code Section -->
                    <div class="form-section">
                        <h3 class="section-label">
                            <i class="ph-fill ph-gift"></i>
                            Referral Code (Optional)
                        </h3>
                        <p class="section-hint">Have a friend's referral code? Enter it here to support them.</p>
                        
                        <div class="form-group">
                            <label for="referral_code">Referral Code</label>
                            <input 
                                type="text" 
                                id="referral_code" 
                                name="referral_code" 
                                value="{{ old('referral_code') }}" 
                                placeholder="Referral code (e.g., ABC12345)"
                                maxlength="20"
                                style="text-transform: uppercase;"
                            >
                            <span class="field-hint">
                                <i class="ph ph-info"></i>
                                Optional: enter a friend's referral code to help them earn commission
                            </span>
                            @error('referral_code')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="checkout-terms">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" required>
                            <span class="checkmark"></span>
                            <span>I agree to the <a href="{{ route('terms') }}">Terms of Service</a> and the <a href="{{ route('privacy') }}">Privacy Policy</a></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block checkout-btn">
                        <i class="ph ph-lock"></i>
                        Submit Order - ${{ number_format($finalPrice ?? $package->price, 2) }}
                    </button>
                    
                    <div class="secure-badge">
                        <i class="ph-fill ph-shield-check"></i>
                        <span>Your payment is protected with 256-bit SSL encryption</span>
                    </div>
                </form>

                {{-- Card payment help modal --}}
                @php
                    $crispWebsiteId = \App\Models\Setting::get('crisp_website_id');
                    $cardHelpEmail = \App\Models\Setting::get('support_email', 'support@4khdiptv.org');
                    $foreignMail = ['bestlive', 'liveiptv', 'khdiptv.com'];
                    foreach ($foreignMail as $needle) {
                        if (stripos((string) $cardHelpEmail, $needle) !== false) {
                            $cardHelpEmail = 'support@4khdiptv.org';
                            break;
                        }
                    }
                    if (!filter_var($cardHelpEmail, FILTER_VALIDATE_EMAIL)) {
                        $cardHelpEmail = 'support@4khdiptv.org';
                    }
                @endphp
                <div id="cardPayModal" class="card-pay-modal" hidden>
                    <div class="card-pay-modal-backdrop" data-close-card-modal></div>
                    <div class="card-pay-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="cardPayTitle">
                        <button type="button" class="card-pay-modal-close" data-close-card-modal aria-label="Close">&times;</button>
                        <div class="card-pay-modal-icon"><i class="ph-fill ph-warning-circle"></i></div>
                        <h3 id="cardPayTitle">Having trouble with card payment?</h3>
                        <p>For payment via card, contact <a href="mailto:{{ $cardHelpEmail }}">{{ $cardHelpEmail }}</a></p>
                        <p>Or chat with a live support agent:</p>
                        <div class="card-pay-modal-actions">
                            <a href="mailto:{{ $cardHelpEmail }}" class="card-pay-btn card-pay-btn-secondary">
                                <i class="ph ph-envelope"></i> Email Support
                            </a>
                            @if($crispWebsiteId)
                                <button type="button" class="card-pay-btn card-pay-btn-primary" id="openCrispFromCheckout">
                                    <i class="ph ph-chat-circle-dots"></i> Live Chat Agent
                                </button>
                            @else
                                <a href="{{ route('contact') }}" class="card-pay-btn card-pay-btn-primary">
                                    <i class="ph ph-chat-circle-dots"></i> Contact Support
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="order-summary-wrapper" data-aos="fade-left">
                <div class="order-summary">
                    <h2 class="summary-title">Summary</h2>
                    
                    <div class="package-card">
                        @if($package->is_popular)
                        <span class="popular-tag"><i class="ph-fill ph-crown"></i> Top Choice</span>
                        @endif
                        
                        <h3 class="package-name">{{ $package->name }}</h3>
                        <p class="package-duration">{{ $package->duration_label }} • {{ $package->devices }} {{ $package->devices > 1 ? 'Devices' : 'Device' }}</p>
                        
                        <ul class="package-features">
                            <li><i class="ph-fill ph-check"></i> 20,000+ channels & VOD</li>
                            <li><i class="ph-fill ph-check"></i> HD & 4K quality</li>
                            <li><i class="ph-fill ph-check"></i> TV guide (EPG)</li>
                            <li><i class="ph-fill ph-check"></i> Anti-freeze tech</li>
                            <li><i class="ph-fill ph-check"></i> Instant delivery</li>
                            <li><i class="ph-fill ph-check"></i> 24/7 customer support</li>
                        </ul>
                    </div>
                    
                    <div class="coupon-section mb-4">
                        <div class="coupon-input-group">
                            <input type="text" id="coupon_code" class="form-control" placeholder="Discount Code" value="{{ $coupon->code ?? '' }}">
                            <button type="button" class="btn btn-outline" onclick="applyCoupon()">Use Code</button>
                        </div>
                        <div id="coupon-message" class="coupon-message mt-2" style="font-size: 0.875rem;"></div>
                    </div>

                    <div class="price-breakdown">
                        <div class="price-row">
                            <span>Plan Price</span>
                            @if($package->original_price)
                            <span class="original">${{ number_format($package->original_price, 2) }}</span>
                            @else
                            <span>${{ number_format($package->price, 2) }}</span>
                            @endif
                        </div>
                        
                        @if($package->discount_percentage)
                        <div class="price-row discount">
                            <span>Discount ({{ $package->discount_percentage }}% off)</span>
                            <span>-${{ number_format($package->original_price - $package->price, 2) }}</span>
                        </div>
                        @endif

                        <div class="price-row discount" id="coupon-row" style="{{ isset($coupon) ? '' : 'display: none;' }}">
                            <span>Coupon Savings <span id="coupon-name">({{ $coupon->code ?? '' }})</span></span>
                            <span class="text-success" id="coupon-amount">-${{ isset($discountAmount) ? number_format($discountAmount, 2) : '0.00' }}</span>
                        </div>
                        
                        <div class="price-row total">
                            <span>Total</span>
                            <span class="total-amount" id="total-amount">${{ isset($finalPrice) ? number_format($finalPrice, 2) : number_format($package->price, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="guarantee-box">
                        <i class="ph-fill ph-arrow-counter-clockwise"></i>
                        <div class="guarantee-content">
                            <strong>Refund Window</strong>
                            <span>Not satisfied? Get a full refund within 24 hours.</span>
                        </div>
                    </div>
                </div>
                
                <div class="support-box">
                    <i class="ph-fill ph-headset"></i>
                    <div>
                        <strong>Need Help?</strong>
                        <span>Reach our support team anytime</span>
                    </div>
                    <a href="{{ route('contact') }}" class="btn btn-outline btn-sm">Get Support</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment Help Modal -->
    <div id="paymentHelpModal" class="payment-modal">
        <div class="payment-modal-content">
            <button class="payment-modal-close" onclick="closePaymentModal()">
                <i class="ph ph-x"></i>
            </button>
            <div class="payment-modal-icon">
                <i class="ph-fill ph-headset"></i>
            </div>
            <h3>Payment Issues?</h3>
            <p>It looks like you might be running into trouble. Our support team is online and ready to help right away.</p>
            <div class="payment-modal-actions">
                <button onclick="openLiveChat()" class="btn btn-primary btn-block">
                    <i class="ph-fill ph-chat-circle-text"></i> Chat with Support
                </button>
                <button onclick="closePaymentModal()" class="btn btn-outline btn-block">
                    No thanks, I'll try again
                </button>
            </div>
        </div>
    </div>

    <!-- Script to handle modal -->
    <script>
        function openLiveChat() {
            if (window.$crisp) {
                $crisp.push(['do', 'chat:open']);
            }
            closePaymentModal();
        }

        function closePaymentModal() {
            document.getElementById('paymentHelpModal').classList.remove('is-active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Check if there is an error alert on the page
            const errorAlert = document.querySelector('.alert-error');
            if (errorAlert) {
                setTimeout(function() {
                    document.getElementById('paymentHelpModal').classList.add('is-active');
                }, 1000); // Show after 1 second
            }
        });
    </script>

    <style>
        .payment-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .payment-modal.is-active {
            opacity: 1;
            visibility: visible;
        }

        .payment-modal-content {
            background: var(--white);
            padding: 2.5rem;
            border-radius: var(--radius-xl);
            width: 90%;
            max-width: 450px;
            text-align: center;
            position: relative;
            transform: translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .payment-modal.is-active .payment-modal-content {
            transform: translateY(0);
        }

        .payment-modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--gray-400);
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.2s;
        }

        .payment-modal-close:hover {
            color: var(--gray-600);
        }

        .payment-modal-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-50);
            color: var(--primary-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
        }

        .payment-modal-content h3 {
            font-family: var(--font-display);
            font-size: 1.5rem;
            color: var(--gray-900);
            margin-bottom: 0.75rem;
        }

        .payment-modal-content p {
            color: var(--gray-600);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .payment-modal-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
    </style>
</section>

@push('styles')
<style>
    /* Dark cinematic checkout — matches site theme */
    .checkout-section {
        --white: rgba(18, 16, 32, 0.72);
        --gray-50: transparent;
        --gray-100: rgba(255, 255, 255, 0.08);
        --gray-200: rgba(255, 255, 255, 0.12);
        --gray-400: #94a3b8;
        --gray-500: #94a3b8;
        --gray-600: #94a3b8;
        --gray-700: #cbd5e1;
        --gray-800: #e2e8f0;
        --gray-900: #ffffff;
        --primary-50: rgba(124, 58, 237, 0.12);
        --primary-500: #7c3aed;
        --primary-600: #6d28d9;
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.35);
        padding: 140px 0 80px;
        background:
            radial-gradient(ellipse at top, rgba(124, 58, 237, 0.18), transparent 55%),
            linear-gradient(180deg, #020408 0%, #0b0618 45%, #020408 100%);
        min-height: 100vh;
        color: #e2e8f0;
    }

    .checkout-section input,
    .checkout-section select,
    .checkout-section textarea {
        background: rgba(255, 255, 255, 0.04) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #fff !important;
        border-radius: 12px !important;
    }

    .checkout-section select option {
        background-color: #0b0618 !important;
        color: #fff !important;
    }

    .checkout-section input:focus,
    .checkout-section select:focus,
    .checkout-section textarea:focus {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2) !important;
        outline: none !important;
    }

    .checkout-section label {
        color: #cbd5e1;
    }

    .checkout-section .checkout-btn,
    .checkout-section .btn-primary {
        background: linear-gradient(135deg, #7c3aed, #db2777) !important;
        border: none !important;
        color: #fff !important;
        border-radius: 999px !important;
        font-weight: 800;
    }

    .checkout-section .payment-card,
    .checkout-section .country-card,
    .checkout-section .package-card,
    .checkout-section .order-summary,
    .checkout-section .form-section {
        background: rgba(255, 255, 255, 0.03);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .checkout-section .payment-option input:checked + .payment-card {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 1px rgba(124, 58, 237, 0.45);
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 3rem;
        align-items: start;
    }
    
    .checkout-header {
        margin-bottom: 2rem;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--gray-600);
        font-size: 0.9375rem;
        margin-bottom: 1rem;
        transition: var(--transition-base);
    }
    
    .back-link:hover {
        color: var(--primary-500);
    }
    
    .checkout-title {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .checkout-subtitle {
        color: var(--gray-600);
    }
    
    .checkout-form {
        background: var(--white);
        border-radius: 24px;
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-100);
        backdrop-filter: blur(12px);
    }
    
    .form-section {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .form-section:last-of-type {
        border-bottom: none;
        margin-bottom: 1.5rem;
        padding-bottom: 0;
    }
    
    .section-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
    }
    
    .section-label i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-100);
        color: var(--primary-600);
        border-radius: var(--radius-lg);
        font-size: 1.125rem;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        font-size: 0.9375rem;
    }
    
    .required {
        color: var(--error);
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.875rem 1rem;
        font-size: 0.9375rem;
        color: var(--gray-800);
        background: var(--gray-50);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        transition: var(--transition-base);
        font-family: inherit;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-500);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
    }
    
    .field-hint {
        display: block;
        margin-top: 0.375rem;
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    .field-error {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.8125rem;
        color: var(--error);
    }
    
    /* Payment Methods */
    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    /* Countries Grid */
    .section-hint {
        color: var(--gray-500);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }
    
    .countries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 0.75rem;
    }
    
    .country-option {
        cursor: pointer;
    }
    
    .country-option input {
        display: none;
    }
    
    .country-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 0.75rem;
        background: var(--gray-50);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        transition: var(--transition-base);
        position: relative;
        text-align: center;
    }
    
    .country-option:hover .country-card {
        border-color: var(--gray-300);
        background: var(--white);
    }
    
    .country-option input:checked + .country-card {
        background: var(--primary-50);
        border-color: var(--primary-500);
    }
    
    .country-flag {
        font-size: 2rem;
        line-height: 1;
    }
    
    .country-name {
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--gray-700);
        line-height: 1.2;
    }
    
    .country-check {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        background: var(--gray-200);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        color: var(--white);
        transition: var(--transition-base);
    }
    
    .country-option input:checked + .country-card .country-check {
        background: var(--primary-500);
    }
    
    .payment-option {
        cursor: pointer;
    }
    
    .payment-option input {
        display: none;
    }
    
    .payment-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: var(--gray-50);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        transition: var(--transition-base);
    }
    
    .payment-option input:checked + .payment-card {
        background: var(--primary-50);
        border-color: var(--primary-500);
    }
    
    .payment-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--white);
        border-radius: var(--radius-md);
        font-size: 1.5rem;
        color: var(--primary-500);
    }
    
    .payment-info {
        flex: 1;
    }
    
    .payment-name {
        display: block;
        font-weight: 600;
        color: var(--gray-900);
    }
    
    .payment-desc {
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    .payment-check {
        font-size: 1.5rem;
        color: var(--gray-300);
        transition: var(--transition-base);
    }
    
    .payment-option input:checked + .payment-card .payment-check {
        color: var(--primary-500);
    }
    
    /* Checkbox */
    .checkout-terms {
        margin-bottom: 1.5rem;
    }
    
    .checkbox-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        cursor: pointer;
        font-size: 0.875rem;
        color: var(--gray-600);
    }
    
    .checkbox-wrapper input {
        display: none;
    }
    
    .checkmark {
        width: 20px;
        height: 20px;
        border: 2px solid var(--gray-300);
        border-radius: var(--radius-sm);
        flex-shrink: 0;
        position: relative;
        transition: var(--transition-base);
    }
    
    .checkbox-wrapper input:checked + .checkmark {
        background: var(--primary-500);
        border-color: var(--primary-500);
    }
    
    .checkbox-wrapper input:checked + .checkmark::after {
        content: '';
        position: absolute;
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    
    .checkbox-wrapper a {
        color: var(--primary-500);
        text-decoration: underline;
    }
    
    .checkout-btn {
        margin-bottom: 1rem;
    }
    
    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    .secure-badge i {
        color: var(--success);
    }
    
    /* Order Summary */
    .order-summary-wrapper {
        position: sticky;
        top: 150px;
    }
    
    .order-summary {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-100);
        margin-bottom: 1rem;
    }
    
    .summary-title {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .package-card {
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .popular-tag {
        position: absolute;
        top: 1rem;
        right: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.75rem;
        background: var(--gradient-primary);
        color: var(--white);
        font-size: 0.6875rem;
        font-weight: 700;
        border-radius: var(--radius-full);
    }
    
    .package-name {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .package-duration {
        font-size: 0.875rem;
        color: var(--gray-500);
        margin-bottom: 1rem;
    }
    
    .package-features {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .package-features li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--gray-700);
    }
    
    .package-features li i {
        color: var(--success);
    }
    
    .price-breakdown {
        border-top: 1px solid var(--gray-100);
        padding-top: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        font-size: 0.9375rem;
        color: var(--gray-700);
    }
    
    .price-row .original {
        text-decoration: line-through;
        color: var(--gray-400);
    }
    
    .price-row.discount {
        color: var(--success);
    }
    
    .price-row.total {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--gray-900);
        border-top: 1px solid var(--gray-100);
        margin-top: 0.5rem;
        padding-top: 1rem;
    }
    
    .total-amount {
        font-size: 1.5rem;
        color: var(--primary-600);
    }
    
    .guarantee-box {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: var(--success);
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        border-radius: var(--radius-lg);
        border: 1px solid #A7F3D0;
    }
    
    .guarantee-box i {
        font-size: 1.5rem;
        color: #047857;
    }
    
    .guarantee-content {
        display: flex;
        flex-direction: column;
    }
    
    .guarantee-content strong {
        color: #047857;
        font-size: 0.9375rem;
    }
    
    .guarantee-content span {
        font-size: 0.8125rem;
        color: #059669;
    }
    
    .support-box {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
    }
    
    .support-box i {
        font-size: 2rem;
        color: var(--primary-500);
    }
    
    .support-box div {
        flex: 1;
    }
    
    .support-box strong {
        display: block;
        color: var(--gray-900);
        font-size: 0.9375rem;
    }
    
    .support-box span {
        font-size: 0.8125rem;
        color: var(--gray-500);
    }
    
    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
    }
    
    .alert-error {
        background: #FEF2F2;
        color: #B91C1C;
        border: 1px solid #FECACA;
    }
    
    @media (max-width: 1024px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
        
        .order-summary-wrapper {
            position: static;
            order: -1;
        }
    }
    
    @media (max-width: 768px) {
        .checkout-section {
            padding: 130px 0 60px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .checkout-form {
            padding: 1.5rem;
        }
    }

    /* Card payment help modal */
    .card-pay-modal[hidden] { display: none !important; }
    .card-pay-modal {
        position: fixed;
        inset: 0;
        z-index: 10050;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .card-pay-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(8, 12, 20, 0.65);
        backdrop-filter: blur(4px);
    }
    .card-pay-modal-dialog {
        position: relative;
        width: min(440px, 100%);
        background: linear-gradient(165deg, #16122a 0%, #0c0a14 100%);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 18px;
        padding: 28px 24px 22px;
        box-shadow: 0 24px 60px rgba(0,0,0,0.55);
        text-align: center;
        color: #f1f5f9;
    }
    .card-pay-modal-close {
        position: absolute;
        top: 10px;
        right: 12px;
        border: none;
        background: transparent;
        font-size: 28px;
        line-height: 1;
        color: #94a3b8;
        cursor: pointer;
    }
    .card-pay-modal-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 12px;
        border-radius: 16px;
        background: rgba(124, 58, 237, 0.2);
        color: #c4b5fd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }
    .card-pay-modal-dialog h3 {
        font-size: 20px;
        font-weight: 800;
        margin: 0 0 10px;
        color: #fff;
    }
    .card-pay-modal-dialog p {
        margin: 0 0 10px;
        color: #94a3b8;
        font-size: 14px;
        line-height: 1.5;
    }
    .card-pay-modal-dialog a { color: #c4b5fd; font-weight: 700; }
    .card-pay-modal-actions {
        display: grid;
        gap: 10px;
        margin-top: 18px;
    }
    .card-pay-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 999px;
        padding: 12px 16px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .card-pay-btn-primary {
        background: linear-gradient(135deg, #7c3aed, #db2777);
        color: #fff;
    }
    .card-pay-btn-secondary {
        background: rgba(255,255,255,0.08);
        color: #e2e8f0;
        border: 1px solid rgba(255,255,255,0.12);
    }

    .checkout-section .alert-error {
        background: rgba(185, 28, 28, 0.15);
        color: #fecaca;
        border: 1px solid rgba(248, 113, 113, 0.35);
    }
    .checkout-section .alert-success {
        background: rgba(22, 163, 74, 0.15);
        color: #bbf7d0;
        border: 1px solid rgba(74, 222, 128, 0.35);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const cryptoSection = document.getElementById('crypto-currency-section');
    const cryptoSelect = document.getElementById('crypto_currency');
    
    // Function to toggle crypto section
    function toggleCryptoSection() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
        
        if (selectedMethod && selectedMethod.value === 'crypto') {
            cryptoSection.style.display = 'block';
            cryptoSelect.required = true;
        } else {
            cryptoSection.style.display = 'none';
            cryptoSelect.required = false;
        }
    }
    
    // Add event listeners to all payment method radio buttons
    paymentMethods.forEach(function(radio) {
        radio.addEventListener('change', toggleCryptoSection);
    });
    
    // Check on page load (for old input or errors)
    toggleCryptoSection();

    // Prefer pay=card|crypto from URL
    const urlPay = new URLSearchParams(window.location.search).get('pay');
    if (urlPay === 'crypto') {
        const cryptoRadio = document.querySelector('input[name="payment_method"][value="crypto"]');
        if (cryptoRadio) { cryptoRadio.checked = true; toggleCryptoSection(); }
    } else if (urlPay === 'card') {
        const cardRadio = document.querySelector('input[name="payment_method"][value="stripe"]');
        if (cardRadio) { cardRadio.checked = true; toggleCryptoSection(); }
    }

    // Card submit -> show help popup instead of charging card
    const checkoutForm = document.querySelector('.checkout-form');
    const cardModal = document.getElementById('cardPayModal');
    function openCardModal() {
        if (!cardModal) return;
        cardModal.hidden = false;
        document.body.style.overflow = 'hidden';
    }
    function closeCardModal() {
        if (!cardModal) return;
        cardModal.hidden = true;
        document.body.style.overflow = '';
    }
    cardModal?.querySelectorAll('[data-close-card-modal]').forEach(el => {
        el.addEventListener('click', closeCardModal);
    });
    document.getElementById('openCrispFromCheckout')?.addEventListener('click', function () {
        try {
            if (window.$crisp) {
                window.$crisp.push(['do', 'chat:open']);
            }
        } catch (e) {}
        closeCardModal();
    });
    }

    // Auto-uppercase referral code
    const referralCodeInput = document.getElementById('referral_code');
    if (referralCodeInput) {
        referralCodeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }
});

// Coupon Functionality
function applyCoupon() {
    const couponCode = document.getElementById('coupon_code').value;
    const messageDiv = document.getElementById('coupon-message');
    const packageId = {{ $package->id }}; // Pass package ID from Blade
    
    if (!couponCode) {
        messageDiv.innerHTML = '<span class="text-danger">Please enter a coupon code.</span>';
        return;
    }
    
    // Disable button state if needed
    
    fetch('{{ route("checkout.apply-coupon") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            coupon_code: couponCode,
            package_id: packageId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.valid) {
            // Success
            messageDiv.innerHTML = `<span class="text-success">${data.message}</span>`;
            
            // Update UI
            document.getElementById('coupon-row').style.display = 'flex';
            document.getElementById('coupon-name').innerText = `(${couponCode})`;
            document.getElementById('coupon-amount').innerText = `-$${data.discount_amount}`;
            document.getElementById('total-amount').innerText = `$${data.final_price}`;
            
            // Update button text in the main form if it shows price
            const submitBtn = document.querySelector('.checkout-btn');
            if (submitBtn) {
                // Keep the icon and update text
                submitBtn.innerHTML = `<i class="ph ph-lock"></i> Complete Purchase - $${data.final_price}`;
            }
        } else {
            // Error
            messageDiv.innerHTML = `<span class="text-danger">${data.message}</span>`;
            
            // Reset UI if invalid
            document.getElementById('coupon-row').style.display = 'none';
            // Optionally reset total to original price if we want strict behavior, 
            // but controller logic handles the final charge based on session.
        }
    })
    .catch(error => {
        console.error('Error:', error);
        messageDiv.innerHTML = '<span class="text-danger">Something went wrong. Please try again.</span>';
    });
}
</script>

<style>
    .coupon-input-group {
        display: flex;
        gap: 0.5rem;
    }
    .coupon-input-group .form-control {
        flex: 1;
        padding: 0.6rem 1rem;
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
    }
    .coupon-input-group .btn {
        padding: 0.6rem 1rem;
        border-radius: var(--radius-lg);
        background: var(--gray-100);
        color: var(--gray-700);
        border: 2px solid var(--gray-200);
        cursor: pointer;
        transition: all 0.2s;
    }
    .coupon-input-group .btn:hover {
        background: var(--gray-200);
        border-color: var(--gray-300);
    }
    .text-success { color: var(--success); }
    .text-danger { color: var(--error); }
</style>
    

</script>
@endpush
@endsection
