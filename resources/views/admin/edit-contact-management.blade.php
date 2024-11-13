@extends('admin.layouts.main')

@section('section')
<section class="content">
<div class="page-wrapper">
    <div class="content container-fluid">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                    <form method="POST" action="{{ route('update-contact',$contact->id) }}">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $contact->name }}">
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group col-6">
            <label for="title">Subject</label>
            <input type="text" name="subject" class="form-control" id="subject" placeholder="Enter subject" value="{{ $contact->subject }}">
            @if ($errors->has('subject'))
                <span class="text-danger">{{ $errors->first('subject') }}</span>
            @endif
        </div>
    </div>

    <div class="row">
        

        <div class="form-group col-6">
            <label for="price">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $contact->email}}">
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    

    <div class="form-group col-6">
        <label for="description">Message</label>
        <textarea class="form-control" name="message" id="message" placeholder="Enter message">{{ $contact->message }}</textarea>
        @if ($errors->has('message'))
            <span class="text-danger">{{ $errors->first('message') }}</span>
        @endif
    </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
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
</div>
@endsection