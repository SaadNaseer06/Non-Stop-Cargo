@extends('admin.layouts.main')

@section('section')
    <!-- Page Wrapper -->

    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                             <div></div>
                            <div class="row">
                                <div class="">
                                    <form action="{{ route('update.profile') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Name</label>
                                                <input type="text" name="name" value="{{ $admin->name ?? '' }}" class="form-control">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Email</label>
                                                <input type="email" name="email" value="{{ $admin->email ?? '' }}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">New Password</label>
                                                <input type="password" name="password" autocomplete="off" class="form-control">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Confirm Password</label>
                                                <input type="password" name="confirmpassword" autocomplete="off" class="form-control">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- /Page Wrapper -->
    @endsection
