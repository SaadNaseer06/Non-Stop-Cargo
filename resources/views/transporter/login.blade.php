{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporter - {{ $title ?? "" }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

</head>
<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our Transporter dashboard</p>

                            <!-- Form -->
                            <form action="{{route('transporter.login.check')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input class="form-control" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>

                                <p class="text-center">I don't have an account !<a href="{{route('transporter.register')}}"> Click here</a></p>
                            </form>
                            <!-- /Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>

@include('transporter.layouts.toastr') --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporter - {{ $title ?? "" }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <style>
        .form-floating {
            position: relative;
        }

        .form-floating label {
            position: absolute;
            top: 15px;
            left: 0;
            font-size: 16px;
            color: #999;
            transition: all 0.2s ease;
            pointer-events: none;
            padding: 0 5px;
        }

        .form-floating .form-control:focus + label,
        .form-floating .form-control:not(:placeholder-shown) + label {
            top: 2px;
            left: 0;
            font-size: 16px;
            color: #7D009A;
        }

        .back-div{
            position: absolute;
            top: 2%;
            left: 20px;
        }
    </style>
</head>

<body>

    <div class="back-div">
        <a href="{{route('home')}}" >
            <i class="fa-solid fa-arrow-left"></i>
            back</a>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our Transporter dashboard</p>

                            <!-- Form -->
                            <form action="{{ route('transporter.login.check') }}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="email" type="email" id="email" placeholder=" " value="{{ old('email') }}" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="password" name="password" id="password" placeholder=" " required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>

                                <p class="text-center">I don't have an account! <a href="{{ route('transporter.register') }}">Click here</a></p>
                            </form>
                            <!-- /Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>

@include('transporter.layouts.toastr')
