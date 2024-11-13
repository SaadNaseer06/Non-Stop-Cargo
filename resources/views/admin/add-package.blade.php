@extends('admin.layouts.main')

@section('section')
    {{--  <section class="content">  --}}
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">{{ $title ?? '' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">
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
    
                        <div class="card">
                            <div class="card-body">
    
                                <form method="POST" enctype="multipart/form-data" action="{{ route('create-packages') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Enter name" value="{{ old('name') }}">
                                        </div>
    
                                        <div class="form-group col-6">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Enter title" value="{{ old('title') }}">
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                        </div>
    
                                        <div class="form-group col-6">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" class="form-control" id="price"
                                                placeholder="Enter price" value="{{ old('price') }}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{ old('description') }}</textarea>
                                    </div>
    
                                    <button type="submit" class="btn btn-primary">Add Package</button>
                                </form>
    
    
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>


    </div>
@endsection
