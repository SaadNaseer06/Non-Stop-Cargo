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
                            <h1>Phone  Verification</h1>

                            <!-- Form -->
                            <form action="{{ route('transporter.phone.verify') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="otp" class="form-label">Enter OTP</label>
                                    <input type="text" name="otp" class="form-control" required>
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

</body>

</html>

@include('transporter.layouts.toastr')
 --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .form-floating .form-control:focus+label,
        .form-floating .form-control:not(:placeholder-shown)+label {
            top: 0;
            left: 0;
            font-size: 16px;
            color: #7D009A;
        }

        .back-div {
            position: absolute;
            top: 2%;
            left: 20px;
        }
    </style>
</head>

<body>

    <div class="back-div">
        <a href="{{ route('transporter.register') }}">
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
                            <h1 class="mb-4">Phone Verification</h1>
                            {{-- <p class="account-subtitle"></p> --}}

                            <!-- Form -->
                            <form action="{{ route('transporter.phone.verify') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" name="otp" id="otp" class="form-control"
                                        placeholder=" " required>
                                    <label for="otp">Enter OTP</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Verify</button>
                            </form>
                            <!-- /Form -->

                            <div class="mt-2">
                                <small>OTP will expire in 5 minutes.</small>
                            </div>

                            <div id="timer">
                               Resend OTP in <span id="countdown"></span> seconds
                            </div>
                            <button class="btn btn-primary" id="resend-otp" style="display: none;">Resend OTP</button>
                            <input type="hidden" id="phone-number" value="{{ $phone }}">

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
        let countdown = 60;
        const resendBtn = document.getElementById('resend-otp');
        const countdownSpan = document.getElementById('countdown');
        const timerDiv = document.getElementById('timer');

        function updateTimer() {
            if (countdown <= 0) {
                resendBtn.style.display = 'block'; // Show resend button
                timerDiv.style.display = 'none'; // Hide timer display
            } else {
                countdownSpan.textContent = countdown; // Update countdown display
                countdown--;
                setTimeout(updateTimer, 1000); // Update timer every second
            }
        }

        // Call this function on page load to start the countdown
        updateTimer();

        resendBtn.addEventListener('click', () => {
            const phone = document.getElementById('phone-number').value;

            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

            fetch('{{ route('transporter.phone.resend') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        phone: phone
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        countdown = 60; // Reset countdown
                        updateTimer(); // Restart timer
                        alert(data.success);
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error with the request.');
                });
        });
    </script>



</body>

</html>

@include('transporter.layouts.toastr')
