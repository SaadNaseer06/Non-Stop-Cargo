@extends('admin.layouts.main')

@section('section')
    <section class="content">
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


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{ route('update.setting', ['id' => $info->id]) }}">
                                @csrf
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">Address</label>
                                                <input type="text" name="address" class="form-control" id=""
                                                    placeholder="Enter naddress" value="{{ $info->address ?? '' }}"
                                                    required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="title">Number</label>
                                                <input type="text" name="number" class="form-control" id="address"
                                                    placeholder="Enter subject" value="{{ $info->number ?? '' }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter email" value="{{ $info->email ?? '' }}">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="price">Facebook Link</label>
                                                <input type="text" name="fblink" class="form-control" id="fblink"
                                                    placeholder="Facebook Link" value="{{ $info->facebook ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Instagram Link</label>
                                                <input type="text" name="instalink" class="form-control" id="instalink"
                                                    placeholder="Instagram Link" value="{{ $info->instagram ?? '' }}">
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="price">Twitter Link</label>
                                                <input type="text" name="twitterlink" class="form-control"
                                                    id="twitterlink" placeholder="Twitter Link"
                                                    value="{{ $info->instagram ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Linkedin Link</label>
                                                <input type="text" name="linkedinlink" class="form-control"
                                                    id="linkedinlink" placeholder="Linkedin Link"
                                                    value="{{ $info->linkedin ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </form>
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
@endsection
