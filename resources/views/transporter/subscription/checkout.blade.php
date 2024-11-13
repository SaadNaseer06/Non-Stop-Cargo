@extends('transporter.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="mb-0">Complete Payment for {{ $plan->name }} Plan</h4>
                                </div>
                                <div class="card-body">

                                    @php
                                        $userInfo = session('transporter_id')
                                            ? \App\Models\Transporters::find(session('transporter_id'))
                                            : null;
                                    @endphp

                                    @if ($userInfo)
                                        <form action="{{ route('subscription.callback') }}" method="POST">
                                            @csrf
                                            <p class="mb-3">Click the button below to complete your payment securely:</p>
                                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_VgsfHLzyQVgNL1"
                                                data-amount="{{ $order['amount'] }}" data-currency="INR" data-order_id="{{ $order['id'] }}"
                                                data-buttontext="Pay ₹{{ $plan->price }}" data-name="LoadKaro" data-description="Subscription Payment"
                                                data-image="https://your-logo-url.com/logo.png" data-prefill.name="{{ $userInfo->name }}"
                                                data-prefill.email="{{ $userInfo->email }}" data-theme.color="#F37254"></script>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    @else
                                        <div class="alert alert-warning text-center">
                                            Transporter information not found. Please try again.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
