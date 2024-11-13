@extends('admin.layouts.main')

@section('section')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="d-flex align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Plan</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('index') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Plan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('plans.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Plan Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price (INR)</label>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $plan->price) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="leads_limit">Leads Limit</label>
                        <input type="number" name="leads_limit" id="leads_limit" class="form-control" value="{{ old('leads_limit', $plan->leads_limit) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="features">Features (Comma Separated)</label>
                        <textarea name="features" id="features" class="form-control" rows="3" style="height: 100px;" required>{{ old('features', $plan->features) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Plan</button>
                    <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
