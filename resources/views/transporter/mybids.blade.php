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
                                                            {{-- <th>Requester</th> --}}
                                                            <th>Truck Type</th>
                                                            <th>Weight</th>
                                                            {{-- <th>Qauntity</th> --}}
                                                            <th>Origin</th>
                                                            <th>Destination</th>
                                                            <th>Schedule Date</th>
                                                            <th>My Bid</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mybids as $key => $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ ucfirst($item->requestTruck->type ?? '') }}</td>
                                                                <td>{{ $item->requestTruck->weight ?? '' }}</td>
                                                                {{-- <td>{{ $item->requestTruck->quantity ?? '' }}</td> --}}
                                                                <td>{{ $item->requestTruck->origin ?? '' }}</td>
                                                                <td>{{ $item->requestTruck->destination ?? '' }}</td>
                                                                {{-- <td>{{ $item->requestTruck->distance ?? '-' }}</td>
                                                                <td>{{ $item->requestTruck->time ?? '-' }}</td> --}}
                                                                <td>
                                                                    @if ($item->schedule_date)
                                                                        {{ \Carbon\Carbon::parse($item->schedule_date)->format('d M Y') }}
                                                                    @else
                                                                        <span class="badge badge-primary">Check Info</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    ₹{{ number_format($item->bid, 2) ?? '' }}
                                                                </td>
                                                                <td>{{ $item->created_at->format('d M Y') ?? '' }}</td>
                                                                <td>
                                                                    @if ($item->id == $item->requestTruck->winning_bid_id)
                                                                        <a href="{{ route('transporter.mybid.detail', ['id' => $item->id]) }}"
                                                                            class="btn btn-dark btn-sm">
                                                                            <i class="fa-regular fa-eye"></i>
                                                                            Detail
                                                                        </a>
                                                                    @endif
                                                                    <button class="btn btn-primary btn-sm" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#info{{ $loop->iteration }}">
                                                                        <i class="fa-regular fa-eye"></i>
                                                                        Info
                                                                    </button>
                                                                    <button class="btn btn-danger btn-sm" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete{{ $loop->iteration }}">
                                                                        <i class="fa-regular fa-trash-can"></i>
                                                                        Delete
                                                                    </button>
                                                                </td>
                                                            </tr>



                                                            <div class="modal fade" id="delete{{ $loop->iteration }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary">
                                                                            <h1 class="modal-title fs-5 text-white"
                                                                                id="exampleModalLabel">
                                                                                Delete Bid
                                                                            </h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="text-center">
                                                                                <p class="">
                                                                                    <i class="fa-solid fa-triangle-exclamation"
                                                                                        style="font-size: 25px;"></i>
                                                                                    <br>
                                                                                    Are you sure you want to delete this
                                                                                    Bid?
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <a href="{{ route('transporter.delete.mybids', ['id' => $item->id]) }}"
                                                                                class="btn btn-danger">Yes, Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


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
                                                                                    {{ $item->requestTruck->source_pin ?? 'N/A' }}
                                                                                </p>
                                                                                <p><strong> Destination Pin Code:</strong>
                                                                                    {{ $item->requestTruck->destination_pin ?? 'N/A' }}
                                                                                </p>
                                                                                <p><strong> Pickup Type:</strong>
                                                                                    {{ $item->requestTruck->pickup_type ?? 'N/A' }}
                                                                                </p>
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
        </div>
    </section>
@endsection
