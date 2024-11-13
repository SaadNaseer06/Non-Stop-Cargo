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
    
                                <form method="POST" action="{{ route('update.faq', ["id" => $faq->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Enter title" value="{{ $faq->title }}" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description" required placeholder="Enter description">{{ $faq->description }}</textarea>
                                        </div>
                                    </div>
    
    
                                    <button type="submit" class="btn btn-primary">Update</button>
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
