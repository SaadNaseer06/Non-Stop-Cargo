@extends('admin.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">{{ $title ?? "" }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ $title ?? "" }}</li>
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
                                    {{--  <div class="card-header">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="" class="btn btn-primary">
                                                <i class="fa-solid fa-circle-plus"></i>
                                                Add Contact
                                            </a>
                                        </div>
                                    </div>  --}}
                                    <div class="card-body">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="datatable table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Subject</th>
                                                            <th>Message</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($contact as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ ucfirst($item->name ?? '') }}</td>
                                                            <td>{{ $item->email ?? '' }}</td>
                                                            <td>{{ Str::limit($item->subject ?? '', 30) }}</td>
                                                            <td>{{ Str::limit($item->message ?? '', 30) }}</td>

                                                            <td>{{ $item->created_at->format('d M Y') ?? '' }}</td>
                                                            <td>
                                                                <button class="btn btn-dark text-white btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#info{{ $loop->iteration }}">
                                                                    <i class="fa-solid fa-circle-info"></i>
                                                                    Detail
                                                                </button>
                                                                <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $loop->iteration }}">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="info{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                                                                            Contact Details
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <ul class="list-unstyled">
                                                                            <li>
                                                                                Name:
                                                                                <b>
                                                                                    {{ ucfirst($item->name ?? '') }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Email:
                                                                                <b>
                                                                                    {{ ucfirst($item->email ?? '') }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Subject:
                                                                                <b>
                                                                                    {{ ucfirst($item->subject ?? '') }}
                                                                                </b>
                                                                            </li>
                                                                            <li>
                                                                                Message:
                                                                                <b>
                                                                                    {{ ucfirst($item->message ?? '') }}
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

                                                        <div class="modal fade" id="delete{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-primary">
                                                                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                                                                            Delete Contact
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="text-center">
                                                                            <p class="">
                                                                                <i class="fa-solid fa-triangle-exclamation" style="font-size: 25px;"></i>
                                                                                <br>
                                                                                Are you sure you want to delete this lead?
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <a href="{{ route('delete-contact', ["id" => $item->id]) }}" class="btn btn-danger">Yes, Delete</a>
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

                {{--  <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" action="{{ route('store-cm') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter name" value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="title">Subject</label>
                                                <input type="text" name="subject" class="form-control" id="subject"
                                                    placeholder="Enter subject" value="{{ old('subject') }}">
                                                @if ($errors->has('subject'))
                                                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">


                                            <div class="form-group col-6">
                                                <label for="price">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter email" value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="description">Message</label>
                                                <textarea class="form-control" name="message" id="message" placeholder="Enter message">{{ old('message') }}</textarea>
                                                @if ($errors->has('message'))
                                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>  --}}
                <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
