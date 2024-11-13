@extends('admin.layouts.main')

@section('section')
    {{--  <section class="content">  --}}
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
                                        <a href="{{ route('add-packages') }}" class="btn btn-primary">
                                            <i class="fa-solid fa-circle-plus"></i>
                                            Add Package
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
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($packages as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td> <img src="{{ asset('images/' . $item->image) }}"
                                                                    style="height: 40px; width:40px; border-radius:50%;"
                                                                    alt=""></td>
                                                            <td>{{ ucfirst($item->name) }}</td>
                                                            <td>{{ Str::limit($item->title,30) }}</td>
                                                            <td>{{ Str::limit($item->description,40) }}</td>
                                                            <td>{{ $item->price }}</td>
                                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                                            <td>
                                                                <button class="btn btn-info text-white btn-sm"
                                                                    type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#info{{ $loop->iteration }}">
                                                                    <i class="fa-solid fa-circle-info"></i>
                                                                    View
                                                                </button>
                                                                <button class="btn btn-danger btn-sm" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{ $loop->iteration }}">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                    Delete
                                                                </button>
                                                                <a href="{{ route('edit-packages', ['id' => $item->id]) }}"
                                                                    class="btn btn-primary btn-sm">
                                                                    <i class="fa-regular fa-edit"></i>
                                                                    Update
                                                                    </button>
                                                            </td>
                                                        </tr>

                                                        {{--  this modal use for view details  --}}
                                                        <div class="modal fade" id="info{{ $loop->iteration }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-white"
                                                                            id="exampleModalLabel">
                                                                            Package Details
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <ul class="list-unstyled">
                                                                            <li>
                                                                                Name:
                                                                                <b>
                                                                                    {{ ucfirst($item->name) }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Title:
                                                                                <b>
                                                                                    {{ ucfirst($item->title) }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Description:
                                                                                <b>
                                                                                    {{ ucfirst($item->description) }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Price:
                                                                                <b>
                                                                                    {{ ucfirst($item->price) }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Date:
                                                                                <b>
                                                                                    {{ $item->created_at->format('d M Y') }}
                                                                                </b>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{--  this modal is use for delete packages  --}}
                                                        <div class="modal fade" id="delete{{ $loop->iteration }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-white"
                                                                            id="exampleModalLabel">
                                                                            Delete Package
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
                                                                        <a href="{{ route('delete-packages', ['id' => $item->id]) }}"
                                                                            class="btn btn-danger">Yes, Delete</a>
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
