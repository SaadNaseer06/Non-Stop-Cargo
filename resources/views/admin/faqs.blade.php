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
                                        <a href="{{ route('add.faq') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            Add FAQ
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="datatable table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($faqs as $key => $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ Str::limit(ucfirst($item->title) ?? '', 30) }}</td>
                                                            <td>{{ Str::limit($item->description ?? '', 40) }}</td>

                                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                <button class="btn btn-dark text-white btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#info{{ $loop->iteration }}">
                                                                    <i class="fa-solid fa-circle-info"></i>
                                                                    Detail
                                                                </button>
                                                                <button class="btn btn-danger btn-sm" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{ $loop->iteration }}">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                    Delete
                                                                </button>
                                                                <a href="{{ route('check.faq', ["id" =>$item->id]) }}" class="btn btn-primary btn-sm" type="button">
                                                                    <i class="fa-regular fa-edit"></i>
                                                                    Update
                                                                </a>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="info{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                                                                            FAQ Details
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <ul class="list-unstyled">
                                                                            <li>
                                                                                Name:
                                                                                <b>
                                                                                    {{ ucfirst($item->title ?? '') }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Email:
                                                                                <b>
                                                                                    {{ ucfirst($item->description ?? '') }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Date:
                                                                                <b>
                                                                                    {{ $item->created_at->format('d M Y') ?? '' }}
                                                                                </b>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

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
                                                                                Are you sure you want to delete this lead?
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <a href="{{ route('delete.faq', ["id" => $item->id]) }}" class="btn btn-danger">Yes,
                                                                            Delete</a>
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
    @endsection
