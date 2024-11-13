@extends('customer.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Invoice</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('customer.index') }}">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Invoice</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" id="invoice-content">
                        <!-- Logo section visible only in print -->
                        <div class="logo-container">
                            <img src="{{ url('assets/img/logo.png') }}" alt="Company Logo" class="logo">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bolder">Invoice Details</h4>
                            <button onclick="printInvoice()" class="btn btn-primary no-print">
                                <i class="fa fa-print"></i> Print Invoice
                            </button>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <h5 class="mb-3 text-primary">Customer Details:</h5>
                                <p><strong>Name:</strong> {{ $payment->customer->name }}</p>
                                <p><strong>Email:</strong> {{ $payment->customer->email }}</p>
                                <p><strong>Phone:</strong> {{ $payment->customer->phone }}</p>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-3 text-primary">Transporter Details:</h5>
                                <p><strong>Name:</strong> {{ $payment->transporter->name }}</p>
                                <p><strong>Email:</strong> {{ $payment->transporter->email }}</p>
                                <p><strong>Phone:</strong> {{ $payment->transporter->phone }}</p>
                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Order ID</th>
                                <td>#{{ $payment->id }}</td>
                            </tr>
                            <tr>
                                <th>Payment Amount</th>
                                <td>₹{{ number_format($payment->amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Payment Date</th>
                                <td>{{ $payment->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Payment Status</th>
                                <td>{{ ucfirst($payment->payment_status) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Print-specific styling */
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice-content, #invoice-content * {
                visibility: visible;
            }

            #invoice-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none;
            }

            .card {
                border: none;
                box-shadow: none;
            }

            .logo-container {
                text-align: center;
                margin-bottom: 20px;
                visibility: visible;
            }

            .logo {
                width: 150px;
                display: inline-block;
            }
        }

        /* Screen styling */
        .logo-container {
            text-align: center;
            margin-bottom: 20px;/* Hide the logo container on screen */
        }
    </style>

    <script>
        function printInvoice() {
            window.print();
        }
    </script>
@endsection
