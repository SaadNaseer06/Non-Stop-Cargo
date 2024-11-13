{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - {{ $title ?? '' }}</title>

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
                            <h1>Aadhaar Verification</h1>

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
                            <form id="aadhaar-form" action="{{ route('customer.send.otp', ["id" => $customer->id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="aadhaar_number" class="form-label">Enter Aadhaar Number</label>
                                    <input type="text" max="12" name="aadhaar_number" class="form-control numericInput" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Send OTP</button>
                            </form>
                            <!-- /Form -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->


    <!-- OTP Verification Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Verify OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="otp-form" action="{{ route('customer.verify.otp', ["id" => $customer->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="aadhaar_token" id="aadhaar-token">
                        <div class="mb-3">
                            <input class="form-control" name="otp" type="text" placeholder="Enter OTP" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100" type="submit">Verify OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /OTP Verification Modal --> --}}

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - {{ $title ?? '' }}</title>

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
                            <h1 class="mb-4">Aadhaar Verification</h1>

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
                            <form id="aadhaar-form" action="{{ route('customer.send.otp', ["id" => $customer->id]) }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="aadhaar_number" id="aadhaar_number" class="form-control numericInput" placeholder=" " required>
                                    <label for="aadhaar_number">Enter Aadhaar Number</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Send OTP</button>
                            </form>
                            <!-- /Form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- OTP Verification Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Verify OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="otp-form" action="{{ route('customer.verify.otp', ["id" => $customer->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="aadhaar_token" id="aadhaar-token">
                        <div class="form-floating mb-3">
                            <input class="form-control" name="otp" type="text" id="otp" placeholder=" " required>
                            <label for="otp">Enter OTP</label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100" type="submit">Verify OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /OTP Verification Modal -->


    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#aadhaar-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('customer.send.otp', ["id" => $customer->id]) }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#aadhaar-token').val(response.token);
                            $('#otpModal').modal('show');

                            // Show success alert
                            $('#success-message').text(response.message);
                            $('#success-alert').show();
                            $('#error-alert').hide();
                        } else {
                            // Show error alert
                            $('#error-message').text(response.message);
                            $('#error-alert').show();
                            $('#success-alert').hide();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Show error alert
                        $('#error-message').text('Failed to send OTP. Please try again.');
                        $('#error-alert').show();
                        $('#success-alert').hide();
                    }
                });
            });

            $('#otp-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '{{ route('customer.truck.request') }}';
                        } else {
                            // Show error alert
                            $('#error-message').text(response.message);
                            $('#error-alert').show();
                            $('#success-alert').hide();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Show error alert
                        $('#error-message').text('Verification failed. Please try again.');
                        $('#error-alert').show();
                        $('#success-alert').hide();
                    }
                });
            });

        });
    </script>

    <script>
    $(document).ready(function() {
        $('.numericInput').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>



</body>

</html>

@include('customer.layouts.toastr')
