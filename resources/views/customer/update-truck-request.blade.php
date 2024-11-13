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
                            <form method="POST" action="{{route('customer.update.truck', ["id" => $truck->id])}}">
                                @csrf
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name">Truck Type</label>
                                                <input type="text" name="type" class="form-control" id=""
                                                    placeholder="Enter Type" value="{{$truck->type ?? ''}}" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="title">Weight</label>
                                                <input type="text" name="weight" class="form-control"
                                                    placeholder="Enter Weight" value="{{$truck->weight ?? ''}}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Qauntity</label>
                                                <input type="text" name="quantity" class="form-control"
                                                    placeholder="Enter Qauntity" value="{{$truck->quantity ?? ''}}" required>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="price">Origin</label>
                                                <input type="text" name="origin" class="form-control"
                                                    placeholder="Enter Origin" value="{{$truck->origin ?? ''}}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="price">Destination</label>
                                                <input type="text" name="destination" class="form-control"
                                                    placeholder="Enter Destination" value="{{$truck->destination ?? ''}}" required>
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
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

@endsection
