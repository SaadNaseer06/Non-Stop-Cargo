<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <title>Home</title>
</head>

<style>
    .form_div input {
        border: none;
        border-bottom: 1px solid black;
        border-radius: 0;
        box-shadow: none;
    }

    .form_div input:focus-visible {
        outline: none;
    }

    .cus_li button {
        border-top-left-radius: 50px !important;
        border-bottom-left-radius: 50px;
        width: 100%;
    }

    .cus_li_2 button {
        border-top-right-radius: 50px !important;
        border-bottom-right-radius: 50px !important;
        width: 100% !important;
    }

    .custom_li .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: #45C300;
        border-color: var(--bs-nav-tabs-link-active-border-color);
        color: white;
        width: 100%;
    }

    .custom_li .nav-tabs .nav-link {
        color: black;
    }

    .dis {
        background-color: #E7CDE8;
        padding: 12px;
        border-radius: 10px;
    }

    .form_border {
        border: 1px solid #E7CDE8;
        border-radius: 12px;
        padding: 30px 40px;
        background: white;
    }

    .sec_login {
        background-image: url(./bg-cus.PNG);
        background-position: center;
        background-size: cover;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

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

    .form-floating .form-control {
        border: none;
        border-bottom: 1px solid #E7CDE8;
        border-radius: 0;
        box-shadow: none;
    }

    .form-floating .form-control:focus {
        border-bottom: 2px solid #7D009A;
        box-shadow: none;
    }

    .form-floating .form-control:focus+label,
    .form-floating .form-control:not(:placeholder-shown)+label {
        top: 0px;
        left: 0;
        font-size: 16px;
        color: #7D009A;
    }

    .form-floating .form-control::placeholder {
        color: transparent;
    }
</style>

<body>

    <section class="sec_login position-relative">

        <div class="container-fluid pt-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Login
            </button>
        </div>

        <div class="container pt-5 pb-5">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
                    <div class="">
                        <img src="{{ asset('assets/img/globe.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form_border">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/img/non.png') }}" alt="">
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-5 mt-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="inlineRadio2"
                                    value="Full" checked>
                                <label class="form-check-label" for="inlineRadio2">Full Load</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="inlineRadio1"
                                    value="Part">
                                <label class="form-check-label" for="inlineRadio1">Part Load</label>
                            </div>
                        </div>

                        {{-- full load --}}
                        <div class="mt-4 full_load">
                            <div class="">
                                <h4>Truck Request Details</h4>
                            </div>

                            <form action="{{ route('request.submit') }}" method="POST" class="mt-3" id="searchForm">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="origin" class="form-control floating-input"
                                                id="origin" placeholder="Enter Origin" required>
                                            <label for="origin">Origin</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="destination" class="form-control floating-input"
                                                id="destination" placeholder="Enter Destination" required>
                                            <label for="destination">Destination</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="">
                                            <label for="get_distance">Distance(Readonly)</label>
                                            <input type="text" name="distance" class="form-control" id="get_distance"
                                                placeholder="Distance" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="">
                                            <label for="get_time">Time(Readonly)</label>
                                            <input type="text" name="time" class="form-control" id="get_time"
                                                placeholder="Time" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group text-end">
                                        <button type="button" class="btn btn-danger distance ">Get
                                            Distance</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="form-floating">
                                            <select name="material" class="form-control floating-input" id="material"
                                                required>
                                                <option value="" disabled selected>Select Material</option>
                                                <option value="Auto Parts">Auto Parts</option>
                                                <option value="Bardana jute or plastic">Bardana jute or plastic
                                                </option>
                                                <option value="Building Materials">Building Materials</option>
                                                <option value="Cement">Cement</option>
                                                <option value="Chemicals">Chemicals</option>
                                                <option value="Coal And Ash">Coal And Ash</option>
                                                <option value="Container">Container</option>
                                                <option value="Cotton seed">Cotton seed</option>
                                                <option value="Electronics Consumer Durables">Electronics Consumer
                                                    Durables</option>
                                                <option value="Fertilizers">Fertilizers</option>
                                                <option value="Fruits And Vegetables">Fruits And Vegetables</option>
                                                <option value="Furniture And Wood Products">Furniture And Wood Products
                                                </option>
                                                <option value="House Hold Goods">House Hold Goods</option>
                                                <option value="Industrial Equipments">Industrial Equipments</option>
                                                <option value="Iron sheets or bars or scraps">Iron sheets or bars or
                                                    scraps</option>
                                                <option value="Liquids in drums">Liquids in drums</option>
                                                <option value="Liquids/Oil">Liquids/Oil</option>
                                                <option value="Machinery new or old">Machinery new or old</option>
                                                <option value="Medicals">Medicals</option>
                                                <option value="Metals">Metals</option>
                                                <option value="Mill Jute Oil">Mill Jute Oil</option>
                                                <option value="Others">Others</option>
                                                <option value="Packed Food">Packed Food</option>
                                                <option value="Plastic Pipes or other products">Plastic Pipes or other
                                                    products</option>
                                                <option value="powder bags">powder bags</option>
                                                <option value="Printed books or Paper rolls">Printed books or Paper
                                                    rolls</option>
                                                <option value="Refrigerated Goods">Refrigerated Goods</option>
                                                <option value="Rice or wheat or Agriculture Products">Rice or wheat or
                                                    Agriculture Products</option>
                                                <option value="Scrap">Scrap</option>
                                                <option value="Spices">Spices</option>
                                                <option value="Textiles">Textiles</option>
                                                <option value="Tyres And Rubber Products">Tyres And Rubber Products
                                                </option>
                                                <option value="Vehicles or car">Vehicles or car</option>
                                            </select>
                                            <label for="material">Material</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating">
                                            <select name="weight" class="form-control floating-input" id="weight"
                                                required>
                                                <option value="" disabled selected>Select Weight</option>
                                                <option value="Above 30 MT">Above 30 MT</option>
                                                <option value="Do Not Know">Do Not Know</option>
                                                <option value="Upto 12 MT">Upto 12 MT</option>
                                                <option value="Upto 15 MT">Upto 15 MT</option>
                                                <option value="Upto 20 MT">Upto 20 MT</option>
                                                <option value="Upto 25 MT">Upto 25 MT</option>
                                                <option value="Upto 28 MT">Upto 28 MT</option>
                                                <option value="Upto 5 MT">Upto 5 MT</option>
                                                <option value="Upto 7 MT">Upto 7 MT</option>
                                                <option value="Upto 9 MT">Upto 9 MT</option>
                                            </select>
                                            <label for="weight">Weight</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <select name="type" class="form-control floating-input" id="type"
                                                required>
                                                <option value="" disabled selected>Select Type</option>
                                                <option value="Multi Axle Trailer">Multi Axle Trailer</option>
                                                <option value="Trailer 4923">Trailer 4923</option>
                                                <option value="Truck 25MT / 14 wheel">Truck 25MT / 14 wheel</option>
                                                <option value="Truck 20MT / 12 wheel">Truck 20MT / 12 wheel</option>
                                                <option value="Truck 21MT / 12 wheel">Truck 21MT / 12 wheel</option>
                                            </select>
                                            <label for="type">Truck Type</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <select name="quantity" class="form-control floating-input"
                                                id="quantity" required>
                                                <option value="" disabled selected>Select</option>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <label for="quantity">No. of Trucks</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="schedule_date"
                                                class="form-control floating-input" id="schedule_date" required>
                                            <label for="schedule_date">Schedule Date</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Request</button>
                            </form>

                        </div>

                        {{-- Part Load --}}
                        <div class="mt-4 part_load">
                            <div class="">
                                <h4>Truck Request Details</h4>
                            </div>

                            <form action="{{ route('request.submit.part') }}" method="POST" class="mt-3"
                                id="searchForm">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3 ">
                                            <input type="text" name="origin" class="form-control floating-input"
                                                id="origin" placeholder="Enter Origin" required>
                                            <label for="origin">Origin</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="destination"
                                                class="form-control floating-input" id="destination"
                                                placeholder="Enter Destination" required>
                                            <label for="destination">Destination</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="">
                                            <label for="get_distance">Distance(Readonly)</label>
                                            <input type="text" name="distance" class="form-control "
                                                id="get_distance" placeholder="Distance" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="">
                                            <label for="get_time">Time(Readonly)</label>
                                            <input type="text" name="time" class="form-control "
                                                id="get_time" placeholder="Time" readonly>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group text-end">

                                    </div> --}}
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="source_pin"
                                                class="form-control floating-input" id="source_pin"
                                                placeholder="Soucre Pin Code" required>
                                            <label for="source_pin">Soucre Pin Code</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="destination_pin"
                                                class="form-control floating-input" placeholder="Destination Pin Code"
                                                id="destination_pin" required>
                                            <label for="destination_pin">Destination Pin Code</label>
                                        </div>
                                    </div>
                                    <div class="form-group text-end">
                                        {{-- <button type="button" class="btn btn-primary verify-pincode">Check
                                            Pincode</button> --}}
                                        <button type="button" class="btn btn-danger distance ">Get
                                            Distance</button>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <select name="pickup_type" class="form-control floating-input"
                                                id="pickup_type">
                                                <option selected>Select Type</option>
                                                <option value="Door to Door Delivery">Door to Door Delivery</option>
                                                <option value="Bike Delivery">Bike Delivery</option>
                                                <option value="Hostel/PG/Campus To Home">Hostel/PG/Campus To Home
                                                </option>
                                                <option value="Easy To Move">Easy To Move</option>
                                                <option value="Soldier Material Transportation">Soldier Material
                                                    Transportation</option>
                                                <option value="General">General</option>
                                            </select>
                                            <label for="pickup_type">Pickup Type</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating">
                                            <select name="material" class="form-control floating-input"
                                                id="material" required>
                                                <option value="" disabled selected>Select Material</option>
                                                <option value="Auto Parts">Auto Parts</option>
                                                <option value="Bardana jute or plastic">Bardana jute or plastic
                                                </option>
                                                <option value="Building Materials">Building Materials</option>
                                                <option value="Cement">Cement</option>
                                                <option value="Chemicals">Chemicals</option>
                                                <option value="Coal And Ash">Coal And Ash</option>
                                                <option value="Container">Container</option>
                                                <option value="Cotton seed">Cotton seed</option>
                                                <option value="Electronics Consumer Durables">Electronics Consumer
                                                    Durables</option>
                                                <option value="Fertilizers">Fertilizers</option>
                                                <option value="Fruits And Vegetables">Fruits And Vegetables</option>
                                                <option value="Furniture And Wood Products">Furniture And Wood Products
                                                </option>
                                                <option value="House Hold Goods">House Hold Goods</option>
                                                <option value="Industrial Equipments">Industrial Equipments</option>
                                                <option value="Iron sheets or bars or scraps">Iron sheets or bars or
                                                    scraps</option>
                                                <option value="Liquids in drums">Liquids in drums</option>
                                                <option value="Liquids/Oil">Liquids/Oil</option>
                                                <option value="Machinery new or old">Machinery new or old</option>
                                                <option value="Medicals">Medicals</option>
                                                <option value="Metals">Metals</option>
                                                <option value="Mill Jute Oil">Mill Jute Oil</option>
                                                <option value="Others">Others</option>
                                                <option value="Packed Food">Packed Food</option>
                                                <option value="Plastic Pipes or other products">Plastic Pipes or other
                                                    products</option>
                                                <option value="powder bags">powder bags</option>
                                                <option value="Printed books or Paper rolls">Printed books or Paper
                                                    rolls</option>
                                                <option value="Refrigerated Goods">Refrigerated Goods</option>
                                                <option value="Rice or wheat or Agriculture Products">Rice or wheat or
                                                    Agriculture Products</option>
                                                <option value="Scrap">Scrap</option>
                                                <option value="Spices">Spices</option>
                                                <option value="Textiles">Textiles</option>
                                                <option value="Tyres And Rubber Products">Tyres And Rubber Products
                                                </option>
                                                <option value="Vehicles or car">Vehicles or car</option>
                                            </select>
                                            <label for="material">Material</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col-6">
                                        <div class="form-floating ">
                                            <select name="weight" class="form-control floating-input" id="weight"
                                                required>
                                                <option value="" disabled selected>Select Weight</option>
                                                <option value="Above 30 MT">Above 30 MT</option>
                                                <option value="Do Not Know">Do Not Know</option>
                                                <option value="Upto 12 MT">Upto 12 MT</option>
                                                <option value="Upto 15 MT">Upto 15 MT</option>
                                                <option value="Upto 20 MT">Upto 20 MT</option>
                                                <option value="Upto 25 MT">Upto 25 MT</option>
                                                <option value="Upto 28 MT">Upto 28 MT</option>
                                                <option value="Upto 5 MT">Upto 5 MT</option>
                                                <option value="Upto 7 MT">Upto 7 MT</option>
                                                <option value="Upto 9 MT">Upto 9 MT</option>
                                            </select>
                                            <label for="weight">Weight</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="pickup_date"
                                                class="form-control floating-input" id="pickup_date" required>
                                            <label for="pickup_date">Pickup Date</label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Request</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login as</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Select your login type:</p>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="{{ route('customer.login') }}" class="btn btn-primary">Customer</a>
                        <a href="{{ route('transporter.login') }}" class="btn btn-primary">Transporter</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Optional: You can add additional footer buttons if needed -->
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $(".part_load").hide();
            $(".full_load").hide();

            var type = $(".form-check-input:checked").val();

            if (type == "Part") {
                $(".part_load").show();
                $(".full_load").hide();
            }
            if (type == "Full") {
                $(".full_load").show();
                $(".part_load").hide();
            }

        })
        $(document).ready(function() {
            $(".form-check-input").change(function() {

                var type = $(this).val();

                if (type == "Part") {
                    $(".part_load").show();
                    $(".full_load").hide();
                }
                if (type == "Full") {
                    $(".full_load").show();
                    $(".part_load").hide();
                }

            })
        })
    </script>

    <script>
        document.querySelectorAll('.distance').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const pickup = form.querySelector('[name="origin"]').value;
                const drop = form.querySelector('[name="destination"]').value;
                const distanceInput = form.querySelector('[name="distance"]');
                const timeInput = form.querySelector('[name="time"]');

                if (pickup && drop) {
                    fetch(
                            `{{ route('get.distance') }}?pickup=${encodeURIComponent(pickup)}&drop=${encodeURIComponent(drop)}`
                        )
                        .then(response => response.json())
                        .then(data => {
                            if (data.distance && data.duration) {
                                // Update the value of the input fields
                                distanceInput.value = data.distance;
                                timeInput.value = data.duration;
                            } else {
                                alert(data.msg || 'Failed to get distance information.');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching distance:', error);
                            alert('An error occurred while fetching distance information.');
                        });
                } else {
                    alert('Please enter both pickup and drop locations.');
                }
            });
        });
    </script>

    {{-- this script is working any valid pincode --}}
    {{-- <script>
        document.querySelectorAll('.verify-pincode').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const sourcePin = form.querySelector('[name="source_pin"]').value;
                const destinationPin = form.querySelector('[name="destination_pin"]').value;

                if (sourcePin && destinationPin) {
                    fetch(`{{ route('verify.pincode.city') }}?pincode=${encodeURIComponent(sourcePin)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                alert(data.msg);
                                // Handle the success case, e.g., fill a hidden input or display a message
                            } else {
                                alert(data.msg || 'Pincode verification failed.');
                            }
                        })
                        .catch(error => {
                            console.error('Error verifying pincode:', error);
                            alert('An error occurred while verifying pincode.');
                        });
                } else {
                    alert('Please enter both source and destination pincodes.');
                }
            });
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const verifyPincodeButton = document.querySelector('.verify-pincode');

                if (verifyPincodeButton) {
                    verifyPincodeButton.addEventListener('click', function() {
                        const form = document.getElementById('searchForm');

                        // Check if form exists
                        if (!form) {
                            console.error('Form not found');
                            alert('Form not found');
                            return;
                        }

                        // Fetch input fields by ID
                        const sourcePinInput = document.getElementById('source_pin');
                        const destinationPinInput = document.getElementById('destination_pin');
                        const originInput = document.getElementById('origin');
                        const destinationInput = document.getElementById('destination');

                        // Log values for debugging
                        console.log('Source Pin:', sourcePinInput.value);
                        console.log('Destination Pin:', destinationPinInput.value);
                        console.log('Origin:', originInput.value);
                        console.log('Destination:', destinationInput.value);

                        // Check if all inputs exist
                        const sourcePin = sourcePinInput.value;
                        const destinationPin = destinationPinInput.value;
                        const origin = originInput.value;
                        const destination = destinationInput.value;

                        // Check if any input is empty
                        if (!sourcePin || !destinationPin || !origin || !destination) {
                            alert(
                                'Please enter both source and destination pincodes along with origin and destination cities.');
                            return;
                        }

                        // Check Source Pincode
                        fetch(
                                `{{ route('verify.pincode.city') }}?pincode=${encodeURIComponent(sourcePin)}&city=${encodeURIComponent(origin)}`)
                            .then(response => response.json())
                            .then(data => {
                                if (!data.status) {
                                    alert(data.msg || 'Source pincode verification failed.');
                                } else {
                                    // Check Destination Pincode
                                    fetch(
                                            `{{ route('verify.pincode.city') }}?pincode=${encodeURIComponent(destinationPin)}&city=${encodeURIComponent(destination)}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if (!data.status) {
                                                alert(data.msg ||
                                                    'Destination pincode verification failed.'
                                                    );
                                            } else {
                                                alert(
                                                    'Both pincodes verified successfully.');
                                            }
                                        })
                                        .catch(error => {
                                            console.error(
                                                'Error verifying destination pincode:',
                                                error);
                                            alert(
                                                'An error occurred while verifying the destination pincode.');
                                        });
                                }
                            })
                            .catch(error => {
                                console.error('Error verifying source pincode:', error);
                                alert('An error occurred while verifying the source pincode.');
                            });
                    });
                }
            }, 500); // Delay for 500ms to allow the DOM to fully load
        });
    </script> --}}



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0q+a31S9+jgVTLNmo/1LmCGKtEjJvGd1Wtx2V9aV+4HGjqzNR4vWVw16fo6ffJnc" crossorigin="anonymous">
    </script>

</body>

</html>
