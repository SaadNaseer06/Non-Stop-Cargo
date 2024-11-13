@extends('customer.layouts.main')

@section('section')
    <section class="content">
        <div class="page-wrapper">
            <div class="content container-fluid">

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

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="post">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="datatable table table-hover table-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Transporter</th>
                                                            <th>Transporter Phone</th>
                                                            <th>Bid</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($truck as $key => $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td class="d-flex align-items-center gap-2">
                                                                    {{-- <img class="rounded-circle"
                                                                        src="{{ asset('Transporter/profile/image/' . $item->winingbid->transporter->image) }}"
                                                                        width="40" height="40"
                                                                        alt="Transporter Image"> --}}
                                                                    <img class="rounded-circle"
                                                                        src="{{ $item->winingbid->transporter->image
                                                                            ? asset('Transporter/profile/image/' . $item->winingbid->transporter->image)
                                                                            : asset('assets/img/no-img.jpeg') }}"
                                                                        width="40" height="40"
                                                                        alt="Transporter Image">

                                                                    <ul class="list-unstyled mt-3">
                                                                        <li>{{ ucfirst($item->winingbid->transporter->name ?? '') }}
                                                                        </li>
                                                                        <li>{{ $item->winingbid->transporter->email ?? '' }}
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                                <td>{{ $item->winingbid->transporter->phone ?? '' }}</td>
                                                                <td>₹{{ number_format($item->winingbid->bid, 2) ?? '' }}
                                                                </td>
                                                                <td>
                                                                    @if ($payment)
                                                                        @if ($payment->payment_status)
                                                                            <span
                                                                                class="badge {{ $payment->payment_status == 'successful' ? 'badge-success' : 'badge-danger' }}">
                                                                                {{ $payment->payment_status == 'successful' ? 'Paid' : 'Unpaid' }}
                                                                            </span>
                                                                        @else
                                                                            <span class="badge badge-danger">Unpaid</span>
                                                                        @endif
                                                                    @else
                                                                        <span class="badge badge-danger">Unpaid</span>
                                                                    @endif

                                                                </td>
                                                                <td>{{ $item->winingbid->created_at->format('d M Y') ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{-- <form action="{{ route('payment.initiate') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="request_truck_id" value="{{ $item->id }}">
                                                                        <input type="hidden" name="transporter_id" value="{{ $item->winingbid->transporter->id }}">
                                                                        <input type="hidden" name="amount" value="{{ $item->winingbid->bid }}">
                                                                        <button class="btn btn-success btn-sm">
                                                                            <i class="fa-regular fa-money-bill-1"></i>
                                                                            Pay
                                                                        </button>
                                                                    </form> --}}
                                                                    @if ($customer->verified != false)
                                                                        @if ($payment && $payment->payment_status == 'successful')
                                                                            <a href="{{ route('customer.invoice', $payment->id) }}"
                                                                                class="btn btn-primary btn-sm">
                                                                                <i
                                                                                    class="fa-solid fa-file-invoice-dollar"></i>
                                                                                Invoice
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route('payment.initiate', [
                                                                                'request_truck_id' => $item->id,
                                                                                'transporter_id' => $item->winingbid->transporter->id,
                                                                                'amount' => $item->winingbid->bid,
                                                                            ]) }}"
                                                                                class="btn btn-success btn-sm">
                                                                                <i class="fa-regular fa-money-bill-1"></i>
                                                                                Pay
                                                                            </a>
                                                                        @endif
                                                                    @else
                                                                        {{-- @if ($customer->pan_verified == true)
                                                                        <a href="{{ route('customer.pan.verify.page', ['id' => $customer->id]) }}"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fa-regular fa-circle-check"></i>                                                                          Verify
                                                                        </a>
                                                                        @endif --}}
                                                                        <a href="{{ route('customer.pan.verify.page', ['id' => $customer->id]) }}"
                                                                            class="btn btn-primary btn-sm">
                                                                            <i class="fa-regular fa-circle-check"></i>
                                                                            Verify
                                                                        </a>
                                                                    @endif
                                                                    <a href="{{ route('customer.chat', ['id' => $item->id]) }}"
                                                                        class="btn btn-warning btn-sm">
                                                                        <i class="fa-solid fa-comment"></i>
                                                                        Chat
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
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
    </section>
@endsection
