@extends('customer.layouts.main')

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
                                    <a href="{{ route('customer.index') }}">
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
                                    <div class="card-header">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('customer.add.truck.request') }}" class="btn btn-primary">
                                                <i class="fa-solid fa-circle-plus"></i>
                                                Add Truck Request
                                            </a>
                                        </div>

                                        {{-- <div>
                                            <div class="d-flex justify-content-center align-items-center gap-5 mt-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="inlineRadio2" value="Full" checked>
                                                    <label class="form-check-label" for="inlineRadio2">Full Load</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="inlineRadio1" value="Part">
                                                    <label class="form-check-label" for="inlineRadio1">Part Load</label>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="card-body">
                                        <form action="" class="full_load" method="post">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="datatable table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Origin</th>
                                                            <th>Destination</th>
                                                            {{-- <th>Material</th> --}}
                                                            <th>Weight</th>
                                                            <th>Truck Type</th>
                                                            {{-- <th>No. of Trucks</th> --}}
                                                            <th>Schedule Date</th>
                                                            {{-- <th>Distance</th>
                                                            <th>Time</th> --}}
                                                            {{-- <th>Source Pin Code</th> --}}
                                                            {{-- <th>Destination Pin Code</th> --}}
                                                            {{-- <th>Pickup Type</th> --}}
                                                            {{-- <th>Pickup Date</th> --}}
                                                            <th>Request Ends At</th>
                                                            <th>Status</th>
                                                            <th>Request Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($truck as $key => $item)
                                                            {{-- @if (\Carbon\Carbon::parse($item->bidding_ends_at) <= now()) --}}
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ ucfirst($item->origin) ?? '-' }}</td>
                                                                <td>{{ ucfirst($item->destination) ?? '-' }}</td>
                                                                {{-- <td>{{ $item->material ?? '-' }}</td> --}}
                                                                <td>{{ $item->weight ?? '-' }}</td>
                                                                <td>
                                                                    @if ($item->type)
                                                                        {{ $item->type }}
                                                                    @else
                                                                        <span class="badge badge-primary">Check Info</span>
                                                                    @endif
                                                                </td>
                                                                {{-- <td>{{ $item->quantity ?? '-' }}</td> --}}
                                                                <td>
                                                                    @if ($item->schedule_date)
                                                                    {{ \Carbon\Carbon::parse($item->schedule_date)->format('d M Y') }}
                                                                    @else
                                                                    <span class="badge badge-primary">Check Info</span>
                                                                    @endif
                                                                </td>
                                                                {{-- <td>{{$item->distance ?? '-'}}</td>
                                                                <td>{{$item->time ?? '-'}}</td> --}}
                                                                {{-- <td>{{ $item->source_pin ?? '-' }}</td> --}}
                                                                {{-- <td>{{ $item->destination_pin ?? '-' }}</td> --}}
                                                                {{-- <td>{{ $item->pickup_type ?? '-' }}</td> --}}
                                                                {{-- <td>{{ \Carbon\Carbon::parse($item->pickup_date)->format('d M Y') ?? '-' }}
                                                                </td> --}}
                                                                <td>
                                                                    @if (\Carbon\Carbon::parse($item->bidding_ends_at) <= now())
                                                                        <span class="badge badge-info">Ended</span>
                                                                    @else
                                                                        {{ $item->bidding_ends_at ? \Carbon\Carbon::parse($item->bidding_ends_at)->format('d M Y: h:i') : '-' }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge {{ $item->status == 0 ? 'badge-warning' : 'badge-success' }} ">
                                                                        {{ $item->status == 0 ? 'Pending' : 'Accepted' }}
                                                                    </span>

                                                                </td>
                                                                <td>{{ $item->created_at->format('d M Y') ?? '-' }}</td>
                                                                <td>
                                                                    @if (\Carbon\Carbon::parse($item->bidding_ends_at) <= now())
                                                                    @else
                                                                        {{-- <a href="{{ route('customer.update.request', ['id' => $item->id]) }}"
                                                                            class="btn btn-info text-white btn-sm">
                                                                            <i class="fa-solid fa-edit"></i>
                                                                            Update
                                                                        </a> --}}
                                                                    @endif
                                                                    @if ($item->status == 1)
                                                                        <a href="{{ route('customer.request.detail', ['id' => $item->id]) }}"
                                                                            class="btn btn-dark text-white btn-sm">
                                                                            <i class="fa-solid fa-eye"></i>
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
                                                            {{-- @endif --}}

                                                            {{-- delete modal --}}
                                                            <div class="modal fade" id="delete{{ $loop->iteration }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary">
                                                                            <h1 class="modal-title fs-5 text-white"
                                                                                id="exampleModalLabel">
                                                                                Delete Request
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
                                                                                    lead?
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <a href="{{ route('customer.delete.request', ['id' => $item->id]) }}"
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
                                                                                <p><strong>Origin:</strong> {{ ucfirst($item->origin) ?? 'N/A' }}</p>
                                                                                <p><strong>Destination:</strong> {{ ucfirst($item->destination) ?? 'N/A' }}</p>
                                                                                <p><strong> Distance:</strong> {{$item->distance ?? 'N/A'}} </p>
                                                                                <p><strong> Time:</strong> {{$item->time ?? 'N/A'}}</p>
                                                                                <p><strong>Material:</strong> {{ $item->material ?? 'N/A' }}</p>
                                                                                <p><strong>Weight:</strong> {{ $item->weight ?? 'N/A' }}</p>
                                                                                <p><strong> Truck Type:</strong> {{ $item->type ?? 'N/A' }}</p>
                                                                                <p><strong> No. of Trucks:</strong> {{ $item->quantity ?? 'N/A' }}</p>
                                                                                <p><strong> Schedule Date:</strong> {{ \Carbon\Carbon::parse($item->schedule_date)->format('d M Y') ?? 'N/A' }}</p>
                                                                                <p><strong> Source Pin Code:</strong> {{ $item->source_pin ?? 'N/A' }}</p>
                                                                                <p><strong> Destination Pin Code:</strong> {{ $item->destination_pin ?? 'N/A' }}</p>
                                                                                <p><strong> Pickup Type:</strong> {{ $item->pickup_type ?? 'N/A' }}</p>
                                                                                <p><strong> Pickup Date:</strong> {{ \Carbon\Carbon::parse($item->pickup_date)->format('d M Y') ?? 'N/A' }}</p>
                                                                                <p><strong> Request Date:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') ?? 'N/A' }}</p>
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

    {{-- <script>
        $(document).ready(function() {

            $(".part_load").hide();
            $(".full_load").hide();

            var type = $(".form-check-input:checked").val();

            if (type == "Part") {
                $(".part_load").show();
                $(".full_load").hide();
            }
            if (type == "Full") {
                $(".full_load").show();
                $(".part_load").hide();
            }

        })
        $(document).ready(function() {
            $(".form-check-input").change(function() {

                var type = $(this).val();

                if (type == "Part") {
                    $(".part_load").show();
                    $(".full_load").hide();
                }
                if (type == "Full") {
                    $(".full_load").show();
                    $(".part_load").hide();
                }

            })
        })
    </script> --}}
@endsection
