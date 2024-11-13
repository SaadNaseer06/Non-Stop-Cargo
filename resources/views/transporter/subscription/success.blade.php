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
                                    <h4 class="mb-0">Subscription Successful</h4>
                                </div>
                                <div class="card-body">
                                    <p>Your subscription has been activated successfully.</p>
                                    <p><strong>Plan:</strong> {{ $plan->name }}</p>
                                    <p><strong>Subscription ID:</strong> {{ $subscriptionId }}</p>
                                    <p>Thank you for subscribing!</p>
                                    <a href="{{ route('subscriptions') }}" class="btn btn-primary">
                                        Back to Subscriptions
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
