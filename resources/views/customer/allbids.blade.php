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
                                                            <th>Transporter</th>
                                                            {{-- <th></th> --}}
                                                            <th>Transporter Phone</th>
                                                            <th>Bid</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allbids as $key => $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td class="d-flex align-items-center gap-2">
                                                                    {{-- <img class="rounded-circle"
                                                                        src="{{ asset('Transporter/profile/image/' . $item->transporter->image) }}" width="40" height="40"
                                                                        alt="Transporter Image"> --}}
                                                                    <img class="rounded-circle"
                                                                        src="{{ $item->transporter->image ? asset('Transporter/profile/image/' . $item->transporter->image) : asset('assets/img/no-img.jpeg') }}"
                                                                        width="40" height="40"
                                                                        alt="Transporter Image">

                                                                    <ul class="list-unstyled mt-3">
                                                                        <li>{{ ucfirst($item->transporter->name ?? '') }}
                                                                        </li>
                                                                        <li>{{ $item->transporter->email ?? '' }}</li>
                                                                    </ul>
                                                                </td>
                                                                {{-- <td></td> --}}
                                                                <td>{{ $item->transporter->phone ?? '' }}</td>
                                                                <td>₹{{ number_format($item->bid, 2) ?? '' }}</td>
                                                                <td>{{ $item->created_at->format('d M Y') ?? '' }}</td>
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
