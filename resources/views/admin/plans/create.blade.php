@extends('admin.layouts.main')

<style>
    .form-floating {
        position: relative;
    }

    .form-floating-label {
        position: absolute;
        top: 0;
        left: 0;
        transition: all 0.2s ease-out;
        color: #6c757d;
        pointer-events: none;
        font-size: 16px;
        padding: 8px 0;
        border-bottom: 1px solid #ced4da;
    }

    .form-floating-input {
        /* background-color: transparent; */
        border: none;
        border-bottom: 1px solid #ced4da;
        padding: 0px 5;
        width: 100%;
        font-size: 16px;
    }

    .form-floating-input:focus {
        outline: none;
        border-bottom: 1px solid #7D009A;
    }

    .form-floating-input:focus~.form-floating-label,
    .form-floating-input:not(:placeholder-shown)~.form-floating-label {
        top: -10px;
        left: 0;
        font-size: 16px;
        color: #7D009A;
    }

    .form-control {
        background-color: transparent !important;
        border-color: #ced4da !important;
    }

    .form-control:focus {
        background-color: transparent !important;
        border-color: #7D009A !important;
    }
</style>


@section('section')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Create New Plan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Create New Plan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('plans.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-floating mb-3 col-6">
                                        <input type="text" name="name" id="name"
                                            class="form-control form-floating-input" placeholder="Plan Name" required>
                                        <label class="form-floating-label" for="name">Plan Name</label>
                                    </div>
                                    <div class="form-floating mb-3 col-6">
                                        <input type="number" name="price" id="price"
                                            class="form-control form-floating-input" placeholder="Plan Price" required>
                                        <label class="form-floating-label" for="price">Plan Price (in ₹)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-floating mb-3 col-6">
                                        <input type="number" name="leads_limit" id="leads_limit"
                                            class="form-control form-floating-input" placeholder="Leads Limit" required>
                                        <label class="form-floating-label" for="leads_limit">Leads Limit</label>
                                    </div>
                                    <div class="form-floating col-6 mb-3">
                                        <textarea name="features" id="features" class="form-control form-floating-input" rows="5"
                                            placeholder="Plan Features" required></textarea>
                                        <label class="form-floating-label" for="features">Plan Features</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Plan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
