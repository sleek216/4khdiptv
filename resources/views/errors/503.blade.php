@extends('layouts.app')

@section('title', 'System Support Inquiry - 4KHDIPTV')

@section('content')
<section class="error-page-section">
    <div class="container">
        <div class="error-card" data-aos="fade-up">
            <div class="error-icon">
                <i class="ph-fill ph-warning-circle"></i>
            </div>
            
            <h1 class="error-title">Something Went Wrong</h1>
            <p class="error-subtitle">
                We encountered a temporary technical glitch. Don't worry! Our support team is available 24/7 to help you.
                If you were attempting a purchase or have any questions, submit your query below and we will get back to you immediately.
            </p>

            @if(session('success'))
                <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #10b981; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; text-align: left;">
                    <i class="ph-fill ph-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="support-query-form">
                @csrf
                <input type="hidden" name="subject" value="System Error Inquiry / Support Query">

                <div class="form-grid">
                    <div class="form-group mb-3">
                        <label for="query_name">Your Name</label>
                        <input type="text" id="query_name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="query_email">Email Address</label>
                        <input type="email" id="query_email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="Enter your email address" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="query_message">Describe Your Query / Issue</label>
                    <textarea id="query_message" name="message" rows="4" placeholder="Tell us what you were trying to do or what query you have..." required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg submit-query-btn" style="width: 100%;">
                    <i class="ph-fill ph-paper-plane-tilt"></i> Send Query To Support
                </button>
            </form>

            <div class="error-actions mt-4">
                <a href="{{ url('/') }}" class="btn btn-outline">
                    <i class="ph ph-house"></i> Back to Homepage
                </a>
                <a href="mailto:support@4khdiptv.org" class="btn btn-outline">
                    <i class="ph ph-envelope"></i> Email Us Directly
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.error-page-section {
    padding: 150px 0 90px;
    background: radial-gradient(circle at 50% 0%, rgba(124, 58, 237, 0.22), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(219, 39, 119, 0.15), transparent 45%),
                linear-gradient(180deg, #0b1329 0%, #050811 100%) !important;
    min-height: 100vh;
    color: #ffffff;
}

.error-card {
    max-width: 680px;
    margin: 0 auto;
    background: rgba(15, 23, 42, 0.85) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-radius: 24px !important;
    padding: 3rem 2.5rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
    text-align: center;
    backdrop-filter: blur(16px);
}

.error-icon {
    font-size: 3.5rem;
    color: #ef4444;
    margin-bottom: 1rem;
    animation: pulseGlow 2s infinite ease-in-out;
}

@keyframes pulseGlow {
    0%, 100% { transform: scale(1); opacity: 0.9; }
    50% { transform: scale(1.08); opacity: 1; filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.6)); }
}

.error-title {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 2.2rem;
    font-weight: 800;
    color: #ffffff !important;
    margin-bottom: 0.75rem;
}

.error-subtitle {
    color: #94a3b8 !important;
    font-size: 1.05rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.support-query-form {
    text-align: left;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 1.75rem;
    margin-bottom: 1.5rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

@media (max-width: 640px) {
    .form-grid { grid-template-columns: 1fr; }
}

.support-query-form label {
    display: block;
    font-weight: 600;
    color: #cbd5e1;
    font-size: 0.9rem;
    margin-bottom: 0.4rem;
}

.support-query-form input,
.support-query-form textarea {
    width: 100%;
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-radius: 12px !important;
    padding: 0.75rem 1rem;
    color: #ffffff !important;
    font-size: 0.95rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.support-query-form input:focus,
.support-query-form textarea:focus {
    border-color: #7c3aed !important;
    box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25) !important;
    outline: none;
}

.submit-query-btn {
    background: linear-gradient(135deg, #7c3aed 0%, #db2777 100%) !important;
    border: none;
    color: #ffffff;
    font-weight: 700;
    padding: 0.9rem 1.5rem;
    border-radius: 12px;
    cursor: pointer;
    font-size: 1rem;
    margin-top: 0.5rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.submit-query-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4);
}

.error-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}
</style>
@endsection