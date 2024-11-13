@extends('transporter.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">

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

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="" class="btn btn-primary">
                                                <i class="fa-solid fa-circle-plus"></i>
                                                Add Truck Request
                                            </a>
                                        </div>
                                    </div> --}}
                                    <div class="card-body">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="datatable table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Customer</th>
                                                            <th>Customer Phone</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allocatedBid as $key => $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td class="d-flex align-items-center gap-2">
                                                                    {{-- <img class="rounded-circle"
                                                                    src="{{ asset('Customer/profile/image/' . $item->requestTruck->customer->image) }}" width="40" height="40"
                                                                    alt="Customer Image"> --}}
                                                                    <img class="rounded-circle"
                                                                        src="{{ optional($item->requestTruck->customer)->image ? asset('Customer/profile/image/' . $item->requestTruck->customer->image) : asset('assets/img/no-img.jpeg') }}"
                                                                        width="40" height="40" alt="Customer Image">

                                                                    <ul class="list-unstyled mt-3">
                                                                        <li>{{ ucfirst($item->requestTruck->customer->name ?? '') }}
                                                                        </li>
                                                                        <li>{{ $item->requestTruck->customer->email ?? '' }}
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                                <td>{{ $item->requestTruck->customer->phone ?? '' }}</td>
                                                                <td>
                                                                    <span
                                                                        class="badge {{ $payment && $payment->payment_status == 'successful' ? 'badge-success' : 'badge-danger' }}">
                                                                        {{ $payment && $payment->payment_status == 'successful' ? 'Paid' : 'Unpaid' }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ $item->created_at->format('d M Y') ?? '' }}</td>
                                                                <td>
                                                                    @if ($payment && $payment->payment_status == 'successful')
                                                                        <a href="{{ route('transporter.invoice', ['id' => $payment->id]) }}"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                                                            Invoice
                                                                        </a>
                                                                    @endif
                                                                    <a href="{{ route('transporter.chat', ['id' => $item->requestTruck->id]) }}"
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fa-solid fa-comment"></i>
                                                                        Chat
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->

            </div>
        </div>
    </section>
@endsection
