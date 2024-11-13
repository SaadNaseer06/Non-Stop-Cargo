{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporter - {{ $title ?? '' }}</title>

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
                            <h1>Pan Verification</h1>

                            <!-- Alerts -->
                            <div id="alert-container">
                                <!-- Success Alert -->
                                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                                    <strong>Success!</strong> <span id="success-message"></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- Error Alert -->
                                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                    <strong>Error!</strong> <span id="error-message"></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Form -->
                            <form id="pan-form" action="{{ route('transporter.verify.pan') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="pan_number" class="form-label">Enter Pan Number</label>
                                    <input type="text" max="12" name="pan_number"
                                        class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Verify</button>
                            </form>
                            <!-- /Form -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper --> --}}

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transporter - {{ $title ?? '' }}</title>

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
            top: 0;
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
        <a href="{{route('transporter.aadhaar.verify.page')}}" >
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
                            <h1 class="mb-4">Pan Verification</h1>

                            <!-- Alerts -->
                            <div id="alert-container">
                                <!-- Success Alert -->
                                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                                    <strong>Success!</strong> <span id="success-message"></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- Error Alert -->
                                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                    <strong>Error!</strong> <span id="error-message"></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Form -->
                            <form id="pan-form" action="{{ route('transporter.verify.pan') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="pan_number" id="pan_number" class="form-control" placeholder=" " required>
                                    <label for="pan_number">Enter Pan Number</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Verify</button>
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

    <script>
        $(document).ready(function() {
            $('.numericInput').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Restrict input to numeric values
            $('.numericInput').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Handle form submission via AJAX
            $('#pan-form').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                // Clear previous alerts
                $('#success-alert').hide();
                $('#error-alert').hide();

                // Get the form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    url: "{{ route('transporter.verify.pan') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#success-message').text(response.message);
                            $('#success-alert').show();
                            setTimeout(function(){
                                window.location.href = '{{ route('transporter.bank.verify.page') }}';
                            }, 2000);
                        } else {
                            $('#error-message').text(response.message);
                            $('#error-alert').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        $('#error-message').text('Error - ' + errorMessage);
                        $('#error-alert').show();
                    }
                });
            });
        });
    </script>



</body>

</html>

@include('transporter.layouts.toastr')
