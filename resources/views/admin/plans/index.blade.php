{{--


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
                                <a href="{{ route('index') }}">
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
                                        <a href="{{route('plans.create')}}" class="btn btn-primary">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            Create Plan
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            @if ($plans->count() > 0)
                                                <table class="datatable table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Leads Limit</th>
                                                            <th>Creation Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($plans as $plan)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ ucfirst($plan->name) ?? '' }}</td>
                                                                <td>₹{{ number_format($plan->price ?? '', 2) }}</td>
                                                                <td>{{ $plan->leads_limit }}</td>

                                                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete{{ $loop->iteration }}">
                                                                        <i class="fa-regular fa-trash-can"></i>
                                                                        Delete
                                                                    </button>
                                                                    <a href="" class="btn btn-primary btn-sm"
                                                                        type="button">
                                                                        <i class="fa-regular fa-edit"></i>
                                                                        Update
                                                                    </a>
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
                                                                                Delete Lead
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
                                                                            <a href="{{ route('delete.faq', ['id' => $item->id]) }}"
                                                                                class="btn btn-danger">Yes,
                                                                                Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
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
    @endsection --}}


    @extends('admin.layouts.main')

    @section('section')

    <div class="page-wrapper">
        <div class="content container-fluid">
             <!-- Page Header -->
             <div class="page-header">
                <div class="d-flex align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $title ?? '' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{route('plans.create')}}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i>
                            Create Plan
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            <section class="content text-center mt-5">
                <div class="row  my-4">
                    @if ($plans->count() > 0)
                        @foreach ($plans as $plan)
                            <div class="col-md-4">
                                <div class="card plan-card mb-4 shadow-sm">
                                    <div class="card-header text-center py-3">
                                        <h4 class="plan-title mb-0">{{ $plan->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <h2 class="plan-price mb-3">{{ '₹' . $plan->price }}</h2>
                                        <p>Leads Limit: {{ $plan->leads_limit }}</p>
                                        <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-primary mt-3">Edit Plan</a>
                                        {{-- <form action="{{ route('plans.deactivate', $plan->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mt-3">Deactivate Plan</button>
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No plans available.</p>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <style>
        .plan-card {
            border-radius: 10px;
            border: 2px solid #E0E0E0;
            background-color: #F7F7F7;
        }

        .plan-title {
            font-size: 24px;
            color: #fff;
            background-color: #7D009A;
            border-radius: 10px 10px 0 0;
            padding: 10px 0;
        }

        .plan-price {
            font-size: 36px;
            color: #333;
            font-weight: bold;
        }

        .plan-features {
            font-size: 16px;
            color: #666;
        }

        /* .btn-primary {
            background-color: #6C63FF;
            border-color: #6C63FF;
            border-radius: 50px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #5249e5;
            border-color: #5249e5;
        } */

        h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }
    </style>

    @endsection
