{{-- @extends('customer.layouts.main')

@section('section')

    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">{{ $title ?? '' }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('customer.index') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="{{route('customer.add.request')}}">
                                @csrf
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">Type</label>
                                                <input type="text" name="type" class="form-control" id=""
                                                    placeholder="Enter Type" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="title">Weight</label>
                                                <input type="text" name="weight" class="form-control"
                                                    placeholder="Enter Weight" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Qauntity</label>
                                                <input type="text" name="quantity" class="form-control"
                                                    placeholder="Enter Qauntity" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="price">Origin</label>
                                                <input type="text" name="origin" class="form-control"
                                                    placeholder="Enter Origin" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Destination</label>
                                                <input type="text" name="destination" class="form-control"
                                                    placeholder="Enter Destination" required>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="pickup_pincode">Pickup Pincode</label>
                                                <input type="text" name="pickup_pincode" class="form-control"
                                                    placeholder="Enter Pickup Pincode" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="delivery_pincode">Delivery Pincode</label>
                                                <input type="text" name="delivery_pincode" class="form-control"
                                                    placeholder="Enter Delivery Pincode" required>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Request</button>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
    </section>

@endsection --}}


@extends('customer.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">{{ $title ?? '' }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('customer.index') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $title ?? '' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div class="d-flex justify-content-center align-items-center gap-5 mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="inlineRadio2" value="Full" checked>
                                                <label class="form-check-label" for="inlineRadio2">Full Load</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="inlineRadio1" value="Part">
                                                <label class="form-check-label" for="inlineRadio1">Part Load</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- full load  --}}
                                    <div class="full_load mt-4">
                                        <form method="POST" action="{{ route('customer.add.request') }}" id="searchForm">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="origin"
                                                            class="form-control floating-input" id="origin"
                                                            placeholder="Enter Origin" required>
                                                        <label for="origin">Origin</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="destination"
                                                            class="form-control floating-input" id="destination"
                                                            placeholder="Enter Destination" required>
                                                        <label for="destination">Destination</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center ">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="distance"
                                                            class="form-control floating-input" id="get_distance"
                                                            placeholder="Distance" readonly>
                                                        <label for="get_distance">Distance(Readonly)</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="time"
                                                            class="form-control floating-input" id="get_time"
                                                            placeholder="Time" readonly>
                                                        <label for="get_time">Time(Readonly)</label>
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
                                                        <select name="material" class="form-control floating-input"
                                                            id="material" required>
                                                            <option value="" disabled selected>Select Material
                                                            </option>
                                                            <option value="Auto Parts">Auto Parts</option>
                                                            <option value="Bardana jute or plastic">Bardana jute or plastic
                                                            </option>
                                                            <option value="Building Materials">Building Materials</option>
                                                            <option value="Cement">Cement</option>
                                                            <option value="Chemicals">Chemicals</option>
                                                            <option value="Coal And Ash">Coal And Ash</option>
                                                            <option value="Container">Container</option>
                                                            <option value="Cotton seed">Cotton seed</option>
                                                            <option value="Electronics Consumer Durables">Electronics
                                                                Consumer
                                                                Durables</option>
                                                            <option value="Fertilizers">Fertilizers</option>
                                                            <option value="Fruits And Vegetables">Fruits And Vegetables
                                                            </option>
                                                            <option value="Furniture And Wood Products">Furniture And Wood
                                                                Products
                                                            </option>
                                                            <option value="House Hold Goods">House Hold Goods</option>
                                                            <option value="Industrial Equipments">Industrial Equipments
                                                            </option>
                                                            <option value="Iron sheets or bars or scraps">Iron sheets or
                                                                bars or
                                                                scraps</option>
                                                            <option value="Liquids in drums">Liquids in drums</option>
                                                            <option value="Liquids/Oil">Liquids/Oil</option>
                                                            <option value="Machinery new or old">Machinery new or old
                                                            </option>
                                                            <option value="Medicals">Medicals</option>
                                                            <option value="Metals">Metals</option>
                                                            <option value="Mill Jute Oil">Mill Jute Oil</option>
                                                            <option value="Others">Others</option>
                                                            <option value="Packed Food">Packed Food</option>
                                                            <option value="Plastic Pipes or other products">Plastic Pipes
                                                                or
                                                                other
                                                                products</option>
                                                            <option value="powder bags">powder bags</option>
                                                            <option value="Printed books or Paper rolls">Printed books or
                                                                Paper
                                                                rolls</option>
                                                            <option value="Refrigerated Goods">Refrigerated Goods</option>
                                                            <option value="Rice or wheat or Agriculture Products">Rice or
                                                                wheat or
                                                                Agriculture Products</option>
                                                            <option value="Scrap">Scrap</option>
                                                            <option value="Spices">Spices</option>
                                                            <option value="Textiles">Textiles</option>
                                                            <option value="Tyres And Rubber Products">Tyres And Rubber
                                                                Products
                                                            </option>
                                                            <option value="Vehicles or car">Vehicles or car</option>
                                                        </select>
                                                        <label for="material">Material</label>
                                                        {{-- <input type="text" name="material"
                                                            class="form-control floating-input" id="material"
                                                            placeholder="Enter Material" required>
                                                        <label for="material">Material</label> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <select name="weight" class="form-control floating-input"
                                                            id="weight" required>
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
                                                        {{-- <input type="text" name="weight"
                                                            class="form-control floating-input" id="weight"
                                                            placeholder="Enter Weight" required>
                                                        <label for="weight">Weight</label> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <select name="type" class="form-control floating-input"
                                                            id="type">
                                                            {{-- <option selected>Select</option>
                                                            <option value="Open Body">Open Body</option>
                                                            <option value="Closed Body">Closed Body</option>
                                                            <option value="Refregerated">Refregerated</option> --}}
                                                            <option value="" disabled selected>Select Type</option>
                                                            <option value="Multi Axle Trailer">Multi Axle Trailer</option>
                                                            <option value="Trailer 4923">Trailer 4923</option>
                                                            <option value="Truck 25MT / 14 wheel">Truck 25MT / 14 wheel
                                                            </option>
                                                            <option value="Truck 20MT / 12 wheel">Truck 20MT / 12 wheel
                                                            </option>
                                                            <option value="Truck 21MT / 12 wheel">Truck 21MT / 12 wheel
                                                            </option>
                                                        </select>
                                                        <label for="type">Truck Type</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <select name="quantity" class="form-control floating-input"
                                                            id="quantity" required>
                                                            {{-- <option selected>Select</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option> --}}
                                                            <option value="" disabled selected>Select</option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        <label for="quantity">No. of Trucks</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="date" name="schedule_date"
                                                            class="form-control floating-input" id="schedule_date"
                                                            required>
                                                        <label for="schedule_date">Schedule Date</label>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="delivery_pincode"
                                                            class="form-control floating-input" id="delivery_pincode"
                                                            placeholder="Enter Delivery Pincode" required>
                                                        <label for="delivery_pincode">Delivery Pincode</label>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <button type="submit" class="btn btn-primary">Request</button>

                                        </form>
                                    </div>

                                    {{-- part load --}}
                                    <div class="part_load mt-4">
                                        <form method="POST" action="{{ route('customer.add.request.part') }}"
                                            id="searchForm">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="origin"
                                                            class="form-control floating-input" id="origin"
                                                            placeholder="Enter Origin" required>
                                                        <label for="origin">Origin</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="destination"
                                                            class="form-control floating-input" id="destination"
                                                            placeholder="Enter Destination" required>
                                                        <label for="destination">Destination</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row align-items-center ">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="distance"
                                                            class="form-control floating-input" id="get_distance"
                                                            placeholder="Distance" readonly>
                                                        <label for="get_distance">Distance(Readonly)</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="time"
                                                            class="form-control floating-input" id="get_time"
                                                            placeholder="Time" readonly>
                                                        <label for="get_time">Time(Readonly)</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="source_pin"
                                                            class="form-control floating-input" id="source_pin"
                                                            placeholder="Enter Pickup Pincode" required>
                                                        <label for="source_pin">Source Pin code</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <input type="text" name="destination_pin"
                                                            class="form-control floating-input" id="destination_pin"
                                                            placeholder="Enter Delivery Pincode" required>
                                                        <label for="destination_pin">Delivery Pin Code</label>
                                                    </div>
                                                </div>
                                                <div class="form-group text-end">
                                                    {{-- <button type="button" class="btn btn-primary verify-pincode">Check
                                                        Pincode</button> --}}
                                                    <button type="button" class="btn btn-danger distance ">Get
                                                        Distance</button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <select name="pickup_type" class="form-control floating-input"
                                                            id="pickup_type">
                                                            <option selected>Select</option>
                                                            <option value="Door to Door Delivery">Door to Door Delivery
                                                            </option>
                                                            <option value="Bike Delivery">Bike Delivery</option>
                                                            <option value="Hostel/PG/Campus To Home">Hostel/PG/Campus To
                                                                Home</option>
                                                            <option value="Easy To Move">Easy To Move</option>
                                                            <option value="Soldier Material Transportation">Soldier
                                                                Material Transportation</option>
                                                            <option value="General">General</option>
                                                        </select>
                                                        <label for="pickup_type">Pickup Type</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        <select name="material" class="form-control floating-input"
                                                            id="material" required>
                                                            <option value="" disabled selected>Select Material
                                                            </option>
                                                            <option value="Auto Parts">Auto Parts</option>
                                                            <option value="Bardana jute or plastic">Bardana jute or plastic
                                                            </option>
                                                            <option value="Building Materials">Building Materials</option>
                                                            <option value="Cement">Cement</option>
                                                            <option value="Chemicals">Chemicals</option>
                                                            <option value="Coal And Ash">Coal And Ash</option>
                                                            <option value="Container">Container</option>
                                                            <option value="Cotton seed">Cotton seed</option>
                                                            <option value="Electronics Consumer Durables">Electronics
                                                                Consumer
                                                                Durables</option>
                                                            <option value="Fertilizers">Fertilizers</option>
                                                            <option value="Fruits And Vegetables">Fruits And Vegetables
                                                            </option>
                                                            <option value="Furniture And Wood Products">Furniture And Wood
                                                                Products
                                                            </option>
                                                            <option value="House Hold Goods">House Hold Goods</option>
                                                            <option value="Industrial Equipments">Industrial Equipments
                                                            </option>
                                                            <option value="Iron sheets or bars or scraps">Iron sheets or
                                                                bars or
                                                                scraps</option>
                                                            <option value="Liquids in drums">Liquids in drums</option>
                                                            <option value="Liquids/Oil">Liquids/Oil</option>
                                                            <option value="Machinery new or old">Machinery new or old
                                                            </option>
                                                            <option value="Medicals">Medicals</option>
                                                            <option value="Metals">Metals</option>
                                                            <option value="Mill Jute Oil">Mill Jute Oil</option>
                                                            <option value="Others">Others</option>
                                                            <option value="Packed Food">Packed Food</option>
                                                            <option value="Plastic Pipes or other products">Plastic Pipes
                                                                or other
                                                                products</option>
                                                            <option value="powder bags">powder bags</option>
                                                            <option value="Printed books or Paper rolls">Printed books or
                                                                Paper
                                                                rolls</option>
                                                            <option value="Refrigerated Goods">Refrigerated Goods</option>
                                                            <option value="Rice or wheat or Agriculture Products">Rice or
                                                                wheat or
                                                                Agriculture Products</option>
                                                            <option value="Scrap">Scrap</option>
                                                            <option value="Spices">Spices</option>
                                                            <option value="Textiles">Textiles</option>
                                                            <option value="Tyres And Rubber Products">Tyres And Rubber
                                                                Products
                                                            </option>
                                                            <option value="Vehicles or car">Vehicles or car</option>
                                                        </select>
                                                        <label for="material">Material</label>
                                                        {{-- <input type="text" name="material"
                                                            class="form-control floating-input" id="material"
                                                            placeholder="Enter Material" required>
                                                        <label for="material">Material</label> --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <div class="form-floating">
                                                        {{-- <input type="text" name="weight"
                                                            class="form-control floating-input" id="weight"
                                                            placeholder="Enter Weight" required>
                                                        <label for="weight">Weight</label> --}}
                                                        <select name="weight" class="form-control floating-input"
                                                            id="weight" required>
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
                                                    <div class="form-floating">
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
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
    </section>

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

    {{-- <script>
        document.querySelectorAll('.verify-pincode').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const sourcePin = form.querySelector('[name="source_pin"]').value;
                const destinationPin = form.querySelector('[name="destination_pin"]').value;

                if (sourcePin && destinationPin) {
                    fetch(`{{ route('verify.pincode') }}?pincode=${encodeURIComponent(sourcePin)}`)
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
@endsection

@section('styles')
    <style>
        /* Remove all borders except bottom border */
        /* .form-control {
                                                                                border: none !important;
                                                                                border-bottom: 2px solid black;
                                                                                border-radius: 0;
                                                                                box-shadow: none;
                                                                            } */

        /* Ensure focus only affects the bottom border */
        /* .form-control:focus {
                                                                                outline: none !important;
                                                                                border-bottom-color: black;
                                                                                box-shadow: none;
                                                                            } */

        /* Floating label styles */
        .form-floating label {
            position: absolute;
            top: 10px;
            left: 0;
            transition: all 0.2s ease;
            pointer-events: none;
            font-size: 16px;
            color: #999;
        }

        .form-floating .form-control:focus+label,
        .form-floating .form-control:not(:placeholder-shown)+label {
            top: -10px;
            left: 0;
            font-size: 12px;
            color: #7D009A;
        }
    </style>
@endsection
