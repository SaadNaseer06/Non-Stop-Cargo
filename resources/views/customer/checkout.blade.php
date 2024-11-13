@extends('customer.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="mb-0">Complete Payment</h4>
                                </div>
                                <div class="card-body">
                                    @if (session('customer_id'))
                                        @php
                                            $userInfo = \App\Models\Customers::find(session('customer_id'));
                                        @endphp
                                        <form action="{{ route('payment.callback') }}" method="POST">
                                            @csrf
                                            <p class="mb-3">Click the button below to complete your payment securely:</p>
                                            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_test_VgsfHLzyQVgNL1"
                                                data-amount="{{ $order['amount'] }}" data-currency="INR" data-order_id="{{ $order['id'] }}"
                                                data-buttontext="Pay with Razorpay" data-name="LoadKaro"
                                                data-description="Payment for order #{{ $order['receipt'] }}" data-image="{{ asset('assets/img/logo.png') }}"
                                                data-prefill.name="{{ $userInfo->name }}" data-prefill.email="{{ $userInfo->email }}" data-theme.color="#F37254">
                                            </script>
                                            <input type="hidden" custom="Hidden Element" name="hidden">
                                        </form>
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



{{-- @extends('customer.layouts.main')

@section('section')
<section class="content">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Complete Payment</h4>
                            </div>
                            <div class="card-body">
                                @if (session('customer_id'))
                                    @php
                                        $userInfo = \App\Models\Customers::find(session('customer_id'));
                                    @endphp
                                    <form action="{{ route('payment.callback') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <p class="mb-3">Click the button below to complete your payment securely:</p>
                                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                data-key="{{ env('RAZORPAY_KEY_ID') }}"
                                                data-amount="{{ $order['amount'] }}"
                                                data-currency="INR"
                                                data-order_id="{{ $order['id'] }}"
                                                data-buttontext="Pay with Razorpay"
                                                data-name="LoadKaro"
                                                data-description="Payment for order #{{ $order['receipt'] }}"
                                                data-image="{{ asset('assets/img/logo.png') }}"
                                                data-prefill.name="{{ $userInfo->name }}"
                                                data-prefill.email="{{ $userInfo->email }}"
                                                data-theme.color="#F37254">
                                            </script>
                                            <input type="hidden" custom="Hidden Element" name="hidden">
                                        </div>
                                    </form>
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        You are not logged in. Please log in to proceed with the payment.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
 --}}
