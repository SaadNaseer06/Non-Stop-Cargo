{{-- @extends('transporter.layouts.main')

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
                                    <a href="{{ route('transporter.index') }}">
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
                            <form method="POST" action="{{route('transporter.add.bid', ["id" => $id])}}">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" id="addChapterName" type="button">
                                                <i class="fa-solid fa-plus"></i>
                                                Add More Bids
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="bid">Bid</label>
                                                <input type="text" name="bid[]" class="form-control"
                                                    placeholder="Enter Your Bid" required>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6" id="appendRow">

                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Bid</button>
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

    <script>
        $(document).ready(function() {
            $("#addChapterName").click(function() {
                var div = `
                <div class="form-group d-flex gap-3 align-items-center" style="gap: 10px;">
                    <input type="text" name="bid[]" class="form-control" placeholder="Enter Your Bid" required>
                    <button class="btn btn-danger btn-sm" type="button" onclick="this.parentElement.remove(this)">
                        <i class="fa-solid fa-xmark" ></i>
                    </button>
                </div>
                `;

                $("#appendRow").append(div)
            })
        })

    </script>

@endsection --}}


@extends('transporter.layouts.main')

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
                                    <a href="{{ route('transporter.index') }}">
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
                            <form method="POST" action="{{ route('transporter.add.bid', ['id' => $id]) }}">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" id="addChapterName" type="button">
                                                <i class="fa-solid fa-plus"></i>
                                                Add More Bids
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="bid[]" id="bid" class="form-control" placeholder=" " required>
                                                    <label for="bid">Enter Your Bid</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6" id="appendRow">
                                                    <!-- Additional rows will be appended here -->
                                                </div>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-primary">Bid</button>
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

    <script>
        $(document).ready(function() {
            $("#addChapterName").click(function() {
                var div = `
                <div class="form-group d-flex gap-3 align-items-center mb-3">
                    <div class="form-floating">
                        <input type="text" name="bid[]" class="form-control" placeholder=" " required>
                        <label>Enter Your Bid</label>
                    </div>
                    <button class="btn btn-danger btn-sm" type="button" onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                `;

                $("#appendRow").append(div);
            });
        });
    </script>

@endsection
