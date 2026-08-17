@extends('layouts.app')

@section('title', 'Payment Canceled')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center">
                <div class="card bg-dark text-white p-5">
                    <div class="mb-4">
                        <i class="ph ph-x-circle" style="font-size: 5rem; color: #ef4444;"></i>
                    </div>
                    
                    <h1 class="h2 mb-3">Payment Canceled</h1>
                    
                    <p class="text-muted mb-4">
                        Your payment was canceled. No charges were made to your account.
                    </p>
                    
                    @if($order->package)
                    <div class="bg-secondary rounded p-3 mb-4">
                        <p class="mb-1"><strong>Plan:</strong> {{ $order->package->name }}</p>
                        <p class="mb-0"><strong>Total:</strong> ${{ number_format($order->amount, 2) }}</p>
                    </div>
                    @endif
                    
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('checkout.show', $order->package->slug ?? '') }}" class="btn btn-primary">
                            <i class="ph ph-arrow-counter-clockwise me-2"></i>Restart Payment
                        </a>
                        <button onclick="if(window.$crisp)$crisp.push(['do', 'chat:open'])" class="btn btn-outline-light">
                            <i class="ph-fill ph-chat-circle-text me-2"></i>Chat Support
                        </button>
                        <a href="{{ route('packages.index') }}" class="btn btn-outline-light">
                            See Other Plans
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
