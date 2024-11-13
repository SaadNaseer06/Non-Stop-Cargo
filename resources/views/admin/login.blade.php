{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ $title ?? "" }}</title>

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
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Form -->
                            <form action="{{route('admin.login.check')}}" method="post">
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

@include('admin.layouts.toastr') --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ $title ?? "" }}</title>

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

        .form-floating-label {
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.2s ease-out;
            color: #6c757d;
            pointer-events: none;
            font-size: 16px; /* Adjusted for px */
            padding: 8px 0; /* Adjusted for px */
            border-bottom: 1px solid #ced4da;
        }

        .form-floating-input {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #ced4da;
            padding: 0px 5; /* Adjusted for px */
            width: 100%;
            font-size: 16px; /* Adjusted for px */
        }

        .form-floating-input:focus {
            outline: none;
            border-bottom: 1px solid #7D009A;
        }

        .form-floating-input:focus ~ .form-floating-label,
        .form-floating-input:not(:placeholder-shown) ~ .form-floating-label {
            top: -10px; /* Adjusted for px */
            left: 0;
            font-size: 16px; /* Adjusted for px */
            color: #7D009A;
        }
    </style>

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
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Form -->
                            <form action="{{ route('admin.login.check') }}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control form-floating-input" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
                                    <label class="form-floating-label">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control form-floating-input" type="password" name="password" id="password" placeholder="Password" required>
                                    <label class="form-floating-label">Password</label>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>
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
