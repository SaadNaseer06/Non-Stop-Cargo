@extends('transporter.layouts.main')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

@section('section')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Transporter!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-primary border-primary">
                                    <i class="fe fe-users"></i>
                                </span>
                                <div class="dash-count">
                                    <h3>{{$acceptedBidsCount}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Accepted Bids</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon text-success">
                                    <i class="fe fe-credit-card"></i>
                                </span>
                                <div class="dash-count">
                                    <h3>{{$totalbids->count()}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">

                                <h6 class="text-muted">Total Bids</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($transporter->verified == false)
            <div class="bg-danger text-white p-3">
                {{-- <ul>
                    @if ($transporter->aadhaar_verified == false)
                    <li>
                        <p>Please <a href="{{route('transporter.aadhaar.verify.page')}}" class="text-decoration-underline">Verify</a> Aadhaar Number.</p>
                    </li>
                    @endif
                    @if ($transporter->pan_verified == false)
                    <li>
                        <p>Please <a href="{{route('transporter.pan.verify.page')}}" class="text-decoration-underline">Verify</a> Pan Number.</p>
                    </li>
                    @endif
                    @if ($transporter->bank_verified == false)
                    <li>
                        <p>Please <a href="{{route('transporter.bank.verify.page')}}" class="text-decoration-underline">Verify</a> Bank.</p>
                    </li>
                    @endif
                    @if ($transporter->rc_verified == false)
                    <li>
                        <p>Please <a href="{{route('transporter.rc.verify.page')}}" class="text-decoration-underline">Verify</a> Vehicle RC Number.</p>
                    </li>
                    @endif
                </ul> --}}
                <p class="mb-0">Please Complete the verification of <strong>Aadhaar No.</strong> , <strong>Pan No.</strong> , <strong>Bank Account</strong>, and <strong>Vehicle RC No.</strong> to make bids. <a href="{{route('transporter.aadhaar.verify.page')}}" class="text-decoration-underline">Verify</a></p>
            </div>
            @else
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thanks!</strong> For Completing your verification process.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

        </div>
    </div>
    <!-- /Page Wrapper -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection
