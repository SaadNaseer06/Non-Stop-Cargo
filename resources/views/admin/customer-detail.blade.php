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
                                    <h4>Truck Requets: {{ count($customer->truckRequests) }}</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="datatable table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Transporter</th>
                                                        <th>Truck Type</th>
                                                        <th>Weight</th>
                                                        {{-- <th>Quantity</th> --}}
                                                        <th>Origin</th>
                                                        <th>Destination</th>
                                                        <th>Schedule Date</th>
                                                        <th>Allocated Bid</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customer->truckRequests as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td class="d-flex align-items-center gap-2">
                                                                @if ($item->winingbid && $item->winingbid->transporter)
                                                                    <div>
                                                                        {{-- <img class="rounded-circle"
                                                                            src="{{ asset('Transporter/profile/image/' . $item->winingbid->transporter->image) }}"
                                                                            width="40" height="40"
                                                                            alt="Transporter Image"> --}}
                                                                        <img class="rounded-circle"
                                                                            src="{{ $item->winingbid->transporter->image
                                                                                ? asset('Transporter/profile/image/' . $item->winingbid->transporter->image)
                                                                                : asset('assets/img/no-img.jpeg') }}"
                                                                            width="40" height="40"
                                                                            alt="Transporter Image">

                                                                    </div>
                                                                    <div>
                                                                        {{ $item->winingbid->transporter->name ?? 'N/A' }}
                                                                        <br>
                                                                        {{ $item->winingbid->transporter->phone ?? 'N/A' }}
                                                                    </div>
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>
                                                            <td>{{ ucfirst($item->type) ?? '' }}</td>
                                                            <td>{{ $item->weight ?? '' }}</td>
                                                            {{-- <td>{{ $item->quantity ?? '' }}</td> --}}
                                                            <td>{{ $item->origin ?? '' }}</td>
                                                            <td>{{ $item->destination ?? '' }}</td>
                                                            <td>
                                                                @if ($item->schedule_date)
                                                                    {{ \Carbon\Carbon::parse($item->schedule_date)->format('d M Y') }}
                                                                @else
                                                                    <span class="badge badge-primary">Check Info</span>
                                                                @endif
                                                            </td>
                                                            <td>
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
                                                            </td>
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
                                                                                {{ ucfirst($item->origin) ?? 'N/A' }}</p>
                                                                            <p><strong>Destination:</strong>
                                                                                {{ ucfirst($item->destination) ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong>Distance:</strong>
                                                                                {{ $item->distance ?? 'N/A' }}</p>
                                                                            <p><strong>Time:</strong>
                                                                                {{ $item->time ?? 'N/A' }}</p>
                                                                            <p><strong>Material:</strong>
                                                                                {{ $item->material ?? 'N/A' }}</p>
                                                                            <p><strong>Weight:</strong>
                                                                                {{ $item->weight ?? 'N/A' }}</p>
                                                                            <p><strong> Truck Type:</strong>
                                                                                {{ $item->type ?? 'N/A' }}</p>
                                                                            <p><strong> No. of Trucks:</strong>
                                                                                {{ $item->quantity ?? 'N/A' }}</p>
                                                                            <p><strong> Schedule Date:</strong>
                                                                                {{ \Carbon\Carbon::parse($item->schedule_date)->format('d M Y') ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Source Pin Code:</strong>
                                                                                {{ $item->source_pin ?? 'N/A' }}</p>
                                                                            <p><strong> Destination Pin Code:</strong>
                                                                                {{ $item->destination_pin ?? 'N/A' }}</p>
                                                                            <p><strong> Pickup Type:</strong>
                                                                                {{ $item->pickup_type ?? 'N/A' }}</p>
                                                                            <p><strong> Pickup Date:</strong>
                                                                                {{ \Carbon\Carbon::parse($item->pickup_date)->format('d M Y') ?? 'N/A' }}
                                                                            </p>
                                                                            <p><strong> Request Date:</strong>
                                                                                {{ $item->created_at->format('d M Y') ?? 'N/A' }}
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
