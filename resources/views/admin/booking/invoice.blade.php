@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Invoice'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6">
        <div class="row mb-5">
            <div class="col">
                <div class="card pb-4">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Invoice') }}</span>
                        <div class="">
                            <a class="btn btn-primary addbtn float-right p-2 px-3" target="_blank"
                                href="{{ url('/admin/booking/invoice/print/' . $booking->id) }}"
                                id="print_invoice">{{ __('Print') }}</a>
                        </div>
                    </div>
                    <div class="card shadow mx-auto w-65">
                        <div class="card-body px-5 py-4">
                            <div class="row mb-5">
                                <div class="col text-center center">
                                    <h1 class="pt-1 font-size-27">{{ __('Invoice') }}</h1>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 text-left">

                                    <div class="font-weight-bold">{{ $booking->salon->name }}</div>
                                    <div>{{ $booking->salon->address }},</div>
                                    <div>{{ $booking->salon->city }} - <span></span>{{ $booking->salon->zipcode }},</div>

                                    <div>{{ $booking->salon->country }}</div>
                                </div>
                                <div class="col-6 text-right">
                                    <img src="{{ asset('storage/images/app/' . $booking->salon->logo) }}"
                                        id="black_logo_output" class="mt-2  rtl-float-left" width="200px">
                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row">
                                <div class="col-6 text-left">
                                    <h3>{{ __('Custumer') }}</h3>
                                    <div class="font-weight-bold">{{ $booking->user->name }}</div>
                                    <div>{{ $booking->user->email }}</div>
                                    <div>{{ $booking->user->code }}{{ $booking->user->phone }} </div>
                                </div>
                                <div class="col-6 text-right rtl-p">
                                    <p class="strong">N° Facture : <span
                                            class="font-weight-normal">{{ $booking->booking_id }}</span> </p>

                                    <p class="strong mt--3">Date facture : <span
                                            class="font-weight-normal">{{ $booking->date }}</span> </p>
                                    <p class="strong">Statut :<span class="font-weight-normal">
                                            @if ($booking->payment_status == 1)
                                                <span class="">{{ __('Paid') }}</span>
                                            @elseif($booking->payment_status == 0)
                                                <span class="">{{ __('Unpaid') }}</span>
                                            @elseif($booking->payment_status == 2)
                                                <span class="">{{ __('Partially') }}</span>
                                            @endif
                                        </span>
                                    </p>

                                </div>
                            </div>

                            <div class="table-responsive my-4">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort">{{ __('#') }}</th>
                                            <th scope="col" class="sort">{{ __('Service Name') }}</th>
                                            <th scope="col" class="sort">{{ __('Price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($booking->services as $service)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->price }}{{ $symbol }}</td>
                                                @php
                                                    $total = $total + $service->price;
                                                @endphp
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @php
                                $discount = $total - $booking->payment;
                                $payment = $total - $discount;
                            @endphp

                            <div class="text-right">
                                <p class="strong">{{ __('Total :') }} <span
                                        class="font-weight-normal">{{ $total }}{{ $symbol }}</span> </p>

                                {{-- <p class="strong mt--3">{{ __('Total Payment :') }} <span
                                        class="font-weight-normal">{{ $payment }}{{ $symbol }}</span> </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
