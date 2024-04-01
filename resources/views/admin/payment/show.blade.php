@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Show'),
        'headerData' => 'Paiements',
        'url' => 'admin/payment',
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 text-center">
                        <span class="h3">{{ __('Show payment') }} {{ __('For') }} <span
                                class="text-purple">{{ $user->name }}</span></span>
                    </div>
                </div>

                <div class="card shadow">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" class="display">
                                <thead class="thead-light ">
                                    <tr>
                                        <th scope="col" class="sort">{{ __('#') }}</th>

                                        <th scope="col" class="sort">{{ __('Amount') }}</th>
                                        <th scope="col" class="sort">{{ __('Payment Method') }}</th>
                                        <th scope="col" class="sort">{{ __('Status') }}</th>
                                        <th scope="col" class="sort">{{ __('Created_at') }}</th>
                                        <th scope="col" class="sort">{{ __('Updated_at') }}</th>
                                        <th></th>
                                    </tr>

                                </thead>
                                <tbody class="list">
                                    @foreach ($allPayments as $payment)
                                        <tr>
                                            <th>{{ $payment->booking_id }}</th>

                                            <td>{{ $payment->amount }}</td>
                                            <td>{{ __($payment->payment_type) }}</td>
                                            <td>

                                                @if ($payment->payment_done)
                                                    <span class="badge badge-info">{{ __('Done') }}</span>
                                                @elseif ($payment->status == 0)
                                                    <span class="badge badge-primary">{{ __('OK') }}</span>
                                                @elseif($payment->status == 1)
                                                    <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $payment->created_at }}</td>
                                            <td>{{ $payment->updated_at }}</td>
                                            <td>
                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    href="{{ url('admin/payment/create/' . $payment->booking->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
