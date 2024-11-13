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
                                    <h4 class="mb-0">Payment Successfull</h4>
                                </div>
                                <div class="card-body">
                                    <p>Your payment has been completed successfully.</p>
                                    <p><strong>Order ID:</strong> #{{ session('payment_id') }}</p>
                                    <p>Thank you for your purchase!</p>
                                    <a href="{{ route('customer.request.detail', ['id' => session('request_truck_id')]) }}"
                                        class="btn btn-primary">
                                        back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
