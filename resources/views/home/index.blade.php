<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Non Stop Courier</title>

</head>

<style>
    .plus_txt {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .counter {
        font-size: 3rem;
        font-weight: bold;
        color: #4caf50;
        animation: countUp 2s ease-in-out;
    }

    .counter-label {
        font-size: 1.5rem;
        color: #555;
    }

    @keyframes countUp {
        from {
            transform: scale(0);
        }

        to {
            transform: scale(1);
        }
    }

    .rev_box {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .part_i {
        font-size: 30px;
        color: #890191;
        display: flex;
        justify-content: center;
    }

    .rev_box h4 {
        font-size: 1.2rem;
        margin-top: 20px;
    }

    .rev_box h6 {
        font-size: 1rem;
        font-weight: bold;
        margin-top: 15px;
    }

    .rev_box p {
        font-size: 0.9rem;
        color: #555;
    }

    /* Add margin between the slides */
    .slick-slide {
        margin-right: 20px;
        /* Adjust this value for the spacing you want */
    }

    .slick-prev,
    .slick-next {
        background-color: #890191;
        border-radius: 50%;
        color: white;
    }

    .slick-prev:hover,
    .slick-next:hover {
        background-color: #6f0d7f;
    }

    /* Optional: Styling for the slick dots */
    .slick-dots li button:before {
        color: #890191;
    }

    /* Basic Styles */
    .cus_c .col-lg-3 {
        transition: all 0.3s ease;
        /* Smooth transition for hover effect */
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        /* Optional: rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Optional: shadow for depth */
    }

    .part_i {
        font-size: 36px;
        color: #890191;
    }

    .cus_c h6 {
        font-size: 1.2rem;
        font-weight: bold;
        margin-top: 15px;
        color: #333;
    }

    .cus_c p {
        font-size: 1rem;
        color: #666;
        margin-top: 10px;
    }

    /* Hover effect with transparent background */
    .cus_c .col-lg-3:hover {
        background-color: rgba(0, 0, 0, 0.05);
        /* Transparent background */
        transform: translateY(-5px);
        /* Slight movement effect */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        /* Increase shadow on hover */
    }

    .cus_c .col-lg-3:hover .part_i {
        color: #890191;
        /* Optional: Change icon color on hover */
    }

    /* Styling for the location images */
    .loc_img {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Shadow effect */
        transition: all 0.3s ease;
    }

    .loc_img img {
        width: 100%;
        height: auto;
        display: block;
        transition: all 0.3s ease;
    }

    /* Adding hover effect on images */
    .loc_img:hover {
        transform: translateY(-5px);
        /* Slightly move up the image */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        /* Stronger shadow on hover */
    }

    /* Section's Row Animation */
    .loc_img {
        opacity: 0;
        transform: translateY(50px);
    }

    .loc_img.visible {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    /* Optional: Spacing between images */
    .gap-5 {
        gap: 2rem;
        /* Adjust spacing between items */
    }
</style>

<body>
    <!-- header start -->
    <section>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 gap-4 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Login
                            </button>
                        </li>
                    </ul>
                    <form class="d-flex gap-3" role="search">
                        <button class="btn_1" type="submit">Contact Us</button>
                        <button class="btn_2" type="submit">Download App</butto>
                    </form>
                </div>
            </div>
        </nav>
    </section>
    <!-- header end -->


    <!-- hero sec start -->
    <section class="hero_bg ">
        <div class="container pt-5">
            <!-- navs start -->
            <div class="d-flex justify-content-center pt-5">
                <ul class="nav nav-tabs cus_tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">Full Load</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                            aria-controls="profile-tab-pane" aria-selected="false">Part Load</button>
                    </li>
                </ul>
            </div>
            <!-- navs end -->

            <!-- tabs start -->
            <div class="tab-content pb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">

                    {{-- full load --}}
                    <div class="mt-4 full_load">
                        <div class="load_1">
                            <h4>Full Load Truck Request Details</h4>
                        </div>

                        <form action="{{ route('request.submit') }}" method="POST" class="mt-3" id="searchForm">
                            @csrf
                            <div class="row mt-4">
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="origin">Origin</label>
                                        <input type="text" name="origin" class="form-control mt-lg-4 mt-3"
                                            id="origin" placeholder="Enter Origin" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="destination">Destination</label>
                                        <input type="text" name="destination" class="form-control mt-lg-4 mt-3"
                                            id="destination" placeholder="Enter Destination" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <div class="">
                                        <label for="get_distance">Distance(Readonly)</label>
                                        <input type="text" name="distance" class="form-control mt-lg-4 mt-3"
                                            id="get_distance" placeholder="Distance" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="mb-3">
                                        <label for="get_time">Time(Readonly)</label>
                                        <input type="text" name="time" class="form-control mt-lg-4 mt-3"
                                            id="get_time" placeholder="Time" readonly>
                                    </div>
                                </div>
                                <div class="form-group text-center mb-4 mt-3">
                                    <button type="button" class="btn btn-danger distance btn_5">Get
                                        Distance</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <div class="">
                                        <label for="material">Material</label>
                                        <select name="material" class="form-control  mt-lg-4 mt-3" id="material"
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

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="">
                                        <label for="weight">Weight</label>
                                        <select name="weight" class="form-control  mt-lg-4 mt-3" id="weight"
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

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="type">Truck Type</label>
                                        <select name="type" class="form-control  mt-lg-4 mt-3" id="type"
                                            required>
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="Multi Axle Trailer">Multi Axle Trailer</option>
                                            <option value="Trailer 4923">Trailer 4923</option>
                                            <option value="Truck 25MT / 14 wheel">Truck 25MT / 14 wheel</option>
                                            <option value="Truck 20MT / 12 wheel">Truck 20MT / 12 wheel</option>
                                            <option value="Truck 21MT / 12 wheel">Truck 21MT / 12 wheel</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="quantity">No. of Trucks</label>
                                        <select name="quantity" class="form-control  mt-lg-4 mt-3" id="quantity"
                                            required>
                                            <option value="" disabled selected>Select</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="schedule_date">Schedule Date</label>
                                        <input type="date" name="schedule_date" class="form-control  mt-lg-4 mt-3"
                                            id="schedule_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary btn_5">Request</button>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="tab-pane fade text-center" id="profile-tab-pane" role="tabpanel"
                    aria-labelledby="profile-tab" tabindex="0">

                    {{-- Part Load --}}
                    <div class="mt-4 part_load">
                        <div class="text-start part_head">
                            <h4>Part Load Truck Request Details</h4>
                        </div>

                        <form action="{{ route('request.submit.part') }}" method="POST" class="mt-3"
                            id="searchForm">
                            @csrf
                            <div class="row text-start mt-4">
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3 ">
                                        <label for="origin">Origin</label>
                                        <input type="text" name="origin" class="form-control mt-lg-4 mt-3"
                                            id="origin" placeholder="Enter Origin" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="destination">Destination</label>
                                        <input type="text" name="destination" class="form-control mt-lg-4 mt-3"
                                            id="destination" placeholder="Enter Destination" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row text-start">
                                <div class="form-group col-lg-6">
                                    <div class="mb-3">
                                        <label for="get_distance">Distance(Readonly)</label>
                                        <input type="text" name="distance" class="form-control  mt-lg-4 mt-3"
                                            id="get_distance" placeholder="Distance" readonly>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="mb-3">
                                        <label for="get_time">Time(Readonly)</label>
                                        <input type="text" name="time" class="form-control  mt-lg-4 mt-3"
                                            id="get_time" placeholder="Time" readonly>
                                    </div>
                                </div>
                                {{-- <div class="form-group text-end">

                                </div> --}}
                            </div>

                            <div class="row text-start">
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="source_pin">Soucre Pin Code</label>
                                        <input type="text" name="source_pin" class="form-control  mt-lg-4 mt-3"
                                            id="source_pin" placeholder="Soucre Pin Code" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="destination_pin">Destination Pin Code</label>
                                        <input type="text" name="destination_pin"
                                            class="form-control  mt-lg-4 mt-3" placeholder="Destination Pin Code"
                                            id="destination_pin" required>
                                    </div>
                                </div>
                                <div class="form-group text-center mb-4 mt-3">
                                    {{-- <button type="button" class="btn btn-primary verify-pincode">Check
                                        Pincode</button> --}}
                                    <button type="button" class="btn btn-danger distance btn_5">Get
                                        Distance</button>
                                </div>
                            </div>

                            <div class="row text-start">
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="pickup_type">Pickup Type</label>
                                        <select name="pickup_type" class="form-control  mt-lg-4 mt-3"
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

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="">
                                        <label for="material">Material</label>
                                        <select name="material" class="form-control  mt-lg-4 mt-3" id="material"
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

                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3 text-start">
                                <div class="form-group col-lg-6">
                                    <div class=" ">
                                        <label for="weight">Weight</label>
                                        <select name="weight" class="form-control  mt-lg-4 mt-3" id="weight"
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

                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class=" mb-3">
                                        <label for="pickup_date">Pickup Date</label>
                                        <input type="date" name="pickup_date" class="form-control  mt-lg-4 mt-3"
                                            id="pickup_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn_5">Request</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
            <!-- tabs end -->
        </div>
    </section>
    <!-- hero sec end -->



    <!-- location sec start -->
    <section class="mt-5">
        <div class="container">
            <div class="text-center loc_txt">
                <h4>With 6 locations in India, we’re always set to host you.</h4>
            </div>
            <div class="row justify-content-center gap-5 mt-5">
                <div class="col-lg-3 loc_img">
                    <div class="loc_img">
                        <img src="{{ asset('assets/img/img-1.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 loc_img">
                    <div class="loc_img">
                        <img src="{{ asset('assets/img/img-2.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 loc_img">
                    <div class="loc_img">
                        <img src="{{ asset('assets/img/img-3.webp') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gap-5 mt-5">
                <div class="col-lg-3 loc_img">
                    <div class="loc_img">
                        <img src="{{ asset('assets/img/img-4.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 loc_img">
                    <div class="loc_img">
                        <img src="{{ asset('assets/img/img-5.webp') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 loc_img">
                    <div class="loc_img">
                        <img src="{{ asset('assets/img/img-6.webp') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // On scroll, add 'visible' class to images when they come into view
            function checkVisibility() {
                $('.loc_img').each(function() {
                    var imageTop = $(this).offset().top;
                    var windowBottom = $(window).scrollTop() + $(window).height();

                    if (windowBottom > imageTop) {
                        $(this).addClass('visible');
                    }
                });
            }

            // Trigger visibility check on scroll and initial page load
            $(window).on('scroll', function() {
                checkVisibility();
            });

            // Check visibility when the page loads
            checkVisibility();
        });
    </script>
    <!-- location sec end -->

    <!-- pick sec start -->
    <section class="mt-5 pt-lg-5">
        <div class="container">
            <div class="per_txt text-center loc_txt">
                <h4>Your Perfect Coliving Partner</h4>
            </div>
            <div class="row mt-5 justify-content-center cus_c">
                <div class="col-lg-3">
                    <div class="part_i">
                        <i class="fa-solid fa-cash-register"></i>
                    </div>
                    <div class="mt-3">
                        <h6>No Booking Fees</h6>
                    </div>
                    <div>
                        <p>At Non-Stop, enjoy a fee-free, transparent, and affordable experience</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="part_i">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <div class="mt-3">
                        <h6>No Booking Fees</h6>
                    </div>
                    <div>
                        <p>At Non-Stop, enjoy a fee-free, transparent, and affordable experience</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="part_i">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="mt-3">
                        <h6>No Booking Fees</h6>
                    </div>
                    <div>
                        <p>At Non-Stop, enjoy a fee-free, transparent, and affordable experience</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="part_i">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <div class="mt-3">
                        <h6>No Booking Fees</h6>
                    </div>
                    <div>
                        <p>At Non-Stop, enjoy a fee-free, transparent, and affordable experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pick sec end -->

    <!-- testimonial sec start -->
    <section class="mt-5 pt-lg-5">
        <div class="container">
            <div class="text-center loc_txt">
                <h4><span class="voice_txt">Voices of Non-Stop:</span> What Our Clients Say</h4>
            </div>
            <div class="text-center">
                <p class="love_txt">Love where you live. 14,000+ reviews to help you select the best coliving.</p>
            </div>
            <div class="review-slider">
                <div class="row mt-5">
                    <div class="col-lg-4 mt-lg-0 mt-4">
                        <div class="rev_box">
                            <div class="part_i">
                                <i class="fa-solid fa-terminal"></i>
                            </div>
                            <div class="mt-5">
                                <h4>The team was always available to answer and resolve any questions I had. I highly
                                    recommend you turn to them for all housing needs.</h4>
                            </div>
                            <div class="mt-5 pt-5">
                                <h6>Pradhip Biswas</h6>
                                <p>Stayed at Truliv Artemis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-lg-0 mt-4">
                        <div class="rev_box">
                            <div class="part_i">
                                <i class="fa-solid fa-terminal"></i>
                            </div>
                            <div class="mt-5">
                                <h4>The team was always available to answer and resolve any questions I had. I highly
                                    recommend you turn to them for all housing needs.</h4>
                            </div>
                            <div class="mt-5 pt-5">
                                <h6>Pradhip Biswas</h6>
                                <p>Stayed at Truliv Artemis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-lg-0 mt-4">
                        <div class="rev_box">
                            <div class="part_i">
                                <i class="fa-solid fa-terminal"></i>
                            </div>
                            <div class="mt-5">
                                <h4>The team was always available to answer and resolve any questions I had. I highly
                                    recommend you turn to them for all housing needs.</h4>
                            </div>
                            <div class="mt-5 pt-5">
                                <h6>Pradhip Biswas</h6>
                                <p>Stayed at Truliv Artemis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slick Slider JS -->
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

            <script>
                $(document).ready(function() {
                    // Initialize the slick slider
                    $('.review-slider .row').slick({
                        slidesToShow: 1, // Show 1 slide at a time
                        slidesToScroll: 1, // Scroll 1 slide at a time
                        autoplay: true, // Enable autoplay
                        autoplaySpeed: 2000, // Set the speed of autoplay (in ms)
                        dots: true, // Enable dots navigation
                        arrows: true, // Enable arrows for manual navigation
                        centerMode: true, // Optionally, enable center mode for focus
                        infinite: true, // Loop the slides infinitely
                        responsive: [{
                            breakpoint: 768, // For smaller screens (mobile devices)
                            settings: {
                                slidesToShow: 1,
                                dots: true,
                            }
                        }]
                    });
                });
            </script>
        </div>
    </section>
    <!-- testimonial sec end -->


    <!-- map sec start -->
    <section class="mt-5 pt-lg-5">
        <div class="container">
            <div class="map_box">
                <div class="row align-items-center">
                    <!-- Map Image -->
                    <div class="col-lg-6">
                        <div>
                            <img src="{{ asset('assets/img/map.webp') }}" class="img-fluid" alt="Map Image">
                        </div>
                    </div>

                    <!-- Counter Section -->
                    <div class="col-lg-6 custom-border">
                        <div class="text-center">
                            <h6 class="text-uppercase text-primary">Empowering Lives,</h6>
                        </div>
                        <div class="text-center">
                            <h1 class="ins_txt text-dark">Inspiring Connections.</h1>
                        </div>
                        <!-- Counter Values -->
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="text-center plus_txt">
                                    <h3 id="counter-beds">0</h3>
                                    <p>Beds</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center plus_txt">
                                    <h3 id="counter-happy-customers">0</h3>
                                    <p>Happy Customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="text-center plus_txt">
                                    <h3 id="counter-ticket-time">0</h3>
                                    <p>Ticket Resolution Time</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center plus_txt">
                                    <h3 id="counter-properties">0</h3>
                                    <p>Number of Properties</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- map sec end -->


    <!-- contact sec start -->
    <section class="mt-5 pt-lg-5 pb-5">
        <div class="container text-center">
            <div class="con_bg">
                <div class="find_txt pt-5 mt-lg-5">
                    <h1>Find your perfect home with Non-Stop</h1>
                </div>
                <div class="mt-5 pb-5">
                    <button class="btn_3">Contact Us</button>
                </div>
            </div>
        </div>
    </section>
    <!-- contact sec end -->

    <!-- footer start -->
    <div class="footer-section">
        <section class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div>
                            <img src="{{ asset('assets/img/logo.jpg') }}" alt="">
                        </div>
                        <div class="mt-5">
                            Corporate Company:
                            3rd Floor New Nos 109, 111 & 113, Avvai Shanmugam Salai, Jagadambal Colony, Teachers Colony,
                            Royapettah, Chennai, Tamil Nadu 600014.
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="fot_head mt-4">
                            <h4>Take a Tour</h4>
                        </div>
                        <div class="foot_p">
                            <p class="mb-0">Porur</p>
                            <p class="mb-0">OMR</p>
                            <p class="mb-0">Shenoy Nagar</p>
                            <p class="mb-0">Nungambakkam</p>
                            <p class="mb-0">Anna Nagar</p>
                            <p class="mb-0">Adyar</p>
                            <p class="mb-0">T. Nagar</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="fot_head mt-4">
                            <h4>Our Company</h4>
                        </div>
                        <div class="foot_p">
                            <p class="mb-0">About Us</p>
                            <p class="mb-0">Blog</p>
                            <p class="mb-0">Contact Us</p>
                            <p class="mb-0">House Rules & Policies</p>
                            <p class="mb-0">Terms & Conditions</p>
                            <p class="mb-0">Privacy Policy</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="fot_head mt-4">
                            <h4>Follow Us on</h4>
                        </div>
                        <div class="d-flex gap-4 mt-5 foot_i">
                            <i class="fa-brands fa-facebook"></i>
                            <i class="fa-brands fa-youtube"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-linkedin"></i>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
    <!-- footer end -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="justify-content: flex-end;">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
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
        // Function to animate each counter
        function startCounter() {
            // Define the counters and their target values
            const counters = [{
                    id: "counter-beds",
                    targetValue: 2500,
                    suffix: "+"
                },
                {
                    id: "counter-happy-customers",
                    targetValue: 90,
                    suffix: "%"
                },
                {
                    id: "counter-ticket-time",
                    targetValue: 48,
                    suffix: " Hrs"
                },
                {
                    id: "counter-properties",
                    targetValue: 21,
                    suffix: ""
                }
            ];

            // Loop over each counter and animate it
            counters.forEach(function(counter) {
                const counterElement = document.getElementById(counter.id);
                let currentValue = 0;
                const increment = Math.ceil(counter.targetValue /
                    100); // Increment by a small value for smooth animation
                const intervalTime = 30; // Speed of the animation in ms

                // Update the counter value at regular intervals
                const interval = setInterval(function() {
                    currentValue += increment;
                    if (currentValue >= counter.targetValue) {
                        currentValue = counter.targetValue;
                        clearInterval(interval); // Stop the interval once the target is reached
                    }
                    counterElement.innerText = currentValue + counter.suffix; // Update the text on the page
                }, intervalTime);
            });
        }

        // Create an intersection observer to trigger animation when the section becomes visible
        const observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounter(); // Start the counter animation when the section is in view
                    observer.unobserve(entry.target); // Stop observing after the animation starts
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of the section is in the viewport
        });

        // Start observing the section that contains the counters
        const section = document.querySelector('.map_box'); // The section where counters are located
        observer.observe(section);
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

</body>

</html>
