@extends('transporter.layouts.main')

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
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
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
                                    <form action="{{ route('transporter.updateprofile') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Name</label>
                                                <input type="text" name="name" value="{{ $transporter->name ?? 'N/A' }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Email</label>
                                                <input type="email" name="email" value="{{ $transporter->email ?? 'N/A' }}"
                                                    class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Phone Number</label>
                                                <input type="text" name="phone" value="{{ $transporter->phone ?? 'N/A' }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Image</label>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Verified Aadhaar Number</label>
                                                <input type="text" name="verified_aadhaar" value="{{ $transporter->aadhaar_number ?? 'N/A' }}"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Verified Pan Number</label>
                                                <input type="text" name="verified_pan" class="form-control" value="{{ $transporter->pan_number ?? 'N/A' }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Verified RC Number</label>
                                                <input type="text" name="verified_rc" value="{{ $transporter->rc_number ?? 'N/A' }}"
                                                    class="form-control" disabled>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Verified Bank</label>
                                                <input type="text" name="bank" class="form-control" value="{{ $transporter->bank_number ?? 'N/A' }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">New Password (Optional)</label>
                                                <input type="password" name="password" autocomplete="off"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="mb-2">Confirm Password</label>
                                                <input type="password" name="password_confirmation" autocomplete="off"
                                                    class="form-control">
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
