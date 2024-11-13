<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporter - Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">

    <!-- Datatables JS -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>



</head>

<body>


    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <!-- /Logo -->

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>

            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->

            <!-- Header Right Menu -->
            <ul class="nav user-menu">

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    @if (session('transporter_id'))
                        @php
                            $userInfo = \App\Models\Transporters::find(session('transporter_id'));
                        @endphp
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                {{-- <img class="rounded-circle"
                                    src="{{ asset('Transporter/profile/image/' . $userInfo->image) }}" width="35" height="35"
                                    alt="Transporter Image"> --}}
                                <img class="rounded-circle"
                                    src="{{ optional($userInfo)->image ? asset('Transporter/profile/image/' . $userInfo->image) : asset('assets/img/no-img.jpeg') }}"
                                    width="35" height="35" alt="Transporter Image">

                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                <div class="avatar avatar-sm">

                                    {{-- <img src="{{ asset('Transporter/profile/image/' . $userInfo->image) }}"
                                        alt="Transporter Image" class="avatar-img rounded-circle"> --}}
                                    <img src="{{ optional($userInfo)->image ? asset('Transporter/profile/image/' . $userInfo->image) : asset('assets/img/no-img.jpeg') }}"
                                        alt="Transporter Image" class="avatar-img rounded-circle">

                                </div>

                                <div class="user-text">
                                    <h6>{{ ucfirst($userInfo->name) ?? '' }}</h6>
                                    <p class="text-muted mb-0">Transporter</p>
                                </div>
                    @endif
        </div>
        <a class="dropdown-item" href="{{ route('transporter.profile') }}">My Profile</a>
        <a class="dropdown-item" href="{{ route('transporter.logout') }}">Logout</a>
    </div>
    </li>
    <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

    </div>
    <!-- /Header -->
