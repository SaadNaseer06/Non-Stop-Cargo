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

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total Bids: {{ $bids->count() }}</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="datatable table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer</th>
                                                        <th>Truck Type</th>
                                                        <th>Weight</th>
                                                        {{-- <th>Quantity</th> --}}
                                                        <th>Origin</th>
                                                        <th>Destination</th>
                                                        <th>Schedule Date</th>
                                                        <th>Bid</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bids as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td class="d-flex align-items-center gap-2">
                                                                @if ($item->requestTruck && $item->requestTruck->customer)
                                                                    <div>
                                                                        {{-- <img class="rounded-circle"
                                                                            src="{{ asset('Customer/profile/image/' . $item->requestTruck->customer->image) }}"
                                                                            width="40" height="40"
                                                                            alt="Transporter Image"> --}}
                                                                        <img class="rounded-circle"
                                                                            src="{{ $item->requestTruck->customer->image
                                                                                ? asset('Customer/profile/image/' . $item->requestTruck->customer->image)
                                                                                : asset('assets/img/no-img.jpeg') }}"
                                                                            width="40" height="40"
                                                                            alt="Customer Image">

                                                                    </div>
                                                                    <div>
                                                                        {{ $item->requestTruck->customer->name ?? 'N/A' }}
                                                                        <br>
                                                                        {{ $item->requestTruck->customer->phone ?? 'N/A' }}
                                                                    </div>
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
                                                            <td>{{ ucfirst($item->requestTruck->type) ?? '' }}</td>
                                                            <td>{{ $item->requestTruck->weight ?? '' }}</td>
                                                            {{-- <td>{{ $item->requestTruck->quantity ?? '' }}</td> --}}
                                                            <td>{{ $item->requestTruck->origin ?? '' }}</td>
                                                            <td>{{ $item->requestTruck->destination ?? '' }}</td>
                                                            <td>
                                                                @if ($item->requestTruck->schedule_date)
                                                                    {{ \Carbon\Carbon::parse($item->requestTruck->schedule_date)->format('d M Y') }}
                                                                @else
                                                                    <span class="badge badge-primary">Check Info</span>
                                                                @endif
                                                            </td>

                                                            {{-- <td>
                                                                @if ($item->winingbid)
                                                                    ₹{{ number_format($item->winingbid->bid, 2) }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->latestPayment)
                                                                    <span
                                                                        class="badge {{ $item->latestPayment->payment_status == 'successful' ? 'badge-success' : 'badge-danger' }}">
                                                                        {{ $item->latestPayment->payment_status == 'successful' ? 'Paid' : 'Unpaid' }}
                                                                    </span>
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td> --}}
                                                            <td>₹{{ number_format($item->bid, 2) ?? '' }}</td>
                                                            <td>
                                                                @if ($item->created_at)
                                                                    {{ $item->created_at->format('d M Y') }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#info{{ $loop->iteration }}">
                                                                    <i class="fa-regular fa-eye"></i>
                                                                    Info
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        {{-- info modal  --}}
                                                        <div class="modal fade" id="info{{ $loop->iteration }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-white"
                                                                            id="exampleModalLabel">
                                                                            Request Details
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div>
                                                                            <p><strong>Origin:</strong>
                                                                                {{ ucfirst($item->requestTruck->origin) ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong>Destination:</strong>
                                                                                {{ ucfirst($item->requestTruck->destination) ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong>Distance:</strong>
                                                                                {{ $item->requestTruck->distance ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong>Time:</strong>
                                                                                {{ $item->requestTruck->time ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong>Material:</strong>
                                                                                {{ $item->requestTruck->material ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong>Weight:</strong>
                                                                                {{ $item->requestTruck->weight ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Truck Type:</strong>
                                                                                {{ $item->requestTruck->type ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> No. of Trucks:</strong>
                                                                                {{ $item->requestTruck->quantity ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Schedule Date:</strong>
                                                                                {{ \Carbon\Carbon::parse($item->requestTruck->schedule_date)->format('d M Y') ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Source Pin Code:</strong>
                                                                                {{ $item->source_pin ?? 'N/A' }}</p>
                                                                            <p><strong> Destination Pin Code:</strong>
                                                                                {{ $item->requestTruck->destination_pin ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Pickup Type:</strong>
                                                                                {{ $item->pickup_type ?? 'N/A' }}</p>
                                                                            <p><strong> Pickup Date:</strong>
                                                                                {{ \Carbon\Carbon::parse($item->requestTruck->pickup_date)->format('d M Y') ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Request Date:</strong>
                                                                                {{ $item->requestTruck->created_at->format('d M Y') ?? 'N/A' }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
        <!-- /.content -->
    </div>
@endsection
