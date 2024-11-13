@extends('transporter.layouts.main')

@section('section')
<section class="content">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">{{ $title ?? '' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('transporter.index') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="container-fluid">
                <h2 class="text-center mb-4">Choose Your Best Plan</h2>
                <div class="row mt-5">
                    @foreach ($plans as $plan)
                        @php
                            // Determine if the current plan is subscribed and its status
                            $subscription = $subscriptions->firstWhere('plan_id', $plan->id);
                            $isActive = $subscription && $subscription->status === 'active';
                        @endphp
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header text-center bg-primary text-white">
                                    <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="card-title pricing-card-title">₹{{ $plan->price }} <small class="text-muted">/ month</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4 text-left">
                                        <li>{{ $plan->leads_limit }} leads per month</li>

                                        @if($plan->name == 'Expert')
                                            <li>Unlimited Leads</li>
                                            <li>All over India Leads</li>
                                            <li>Monthly Contracts</li>
                                            <li>Instant Leads</li>
                                        @endif
                                        @if($plan->name == 'Standard ')
                                            <li>Maximum No of Leads</li>
                                            <li>Up to 5 Routes Leads</li>
                                        @endif
                                        @if ($plan->name == 'Basic')
                                            <li>Specific Cities Only</li>
                                            <li>Limited Number of Leads</li>
                                        @endif
                                    </ul>

                                    @if ($isActive)
                                        <!-- If already subscribed and subscription is active -->
                                        <button type="button" class="btn btn-lg btn-block btn-success text-white">
                                            Subscribed
                                        </button>
                                    @else
                                        <!-- If not subscribed -->
                                        <form action="{{ route('subscription.create') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <button type="submit" class="btn btn-lg btn-block btn-primary text-white">
                                                Try for 30 days
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
