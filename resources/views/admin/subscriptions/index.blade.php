@extends('admin.layouts.main')

@section('section')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">{{ $title ?? '' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h4>Active Subscription:
                                        {{ $subscriptions->where('status', 'active')->count() }}
                                    </h4>
                                    <h4>Cancelled Subscription:
                                        {{ $subscriptions->where('status', 'cancelled')->count() }}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="datatable table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Transporter</th>
                                                    <th>Email</th>
                                                    <th>Plan</th>
                                                    <th>Status</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subscriptions as $subscription)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="d-flex align-items-center gap-2">
                                                            <img class="rounded-circle"
                                                                    src="{{ asset('Transporter/profile/image/' . $subscription->transporter->image) }}"
                                                                    width="40" height="40" alt="Transporter Image">
                                                            {{ ucfirst($subscription->transporter->name) ?? '' }}
                                                        </td>
                                                        <td>{{ $subscription->transporter->email ?? '' }}</td>
                                                        <td>{{ $subscription->plan->name ?? '' }}</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $subscription->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                                                {{ ucfirst($subscription->status === 'active' ? 'Active' : 'Cancelled') }}
                                                            </span>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') ?? '' }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') ?? ''}}
                                                        </td>

                                                        <td>
                                                            @if ($subscription->status === 'active')
                                                                <form
                                                                    action="{{ route('admin.cancel.subscription', $subscription->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Cancel</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
