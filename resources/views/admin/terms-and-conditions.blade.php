@extends('admin.layouts.main')

@section('section')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">{{ $title ?? "" }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $title ?? "" }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('update.terms.conditions') }}" method="post">
                                    @csrf
                                    <textarea id="summernote" name="editordata" required>{{ $terms->text }}</textarea>
                                    <button class="btn btn-primary mt-2">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Update
                                    </button>
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
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
