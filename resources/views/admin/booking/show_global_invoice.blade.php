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


                            <a class="btn btn-primary addbtn float-right p-2 px-3"
                                href="{{ url('/admin/booking/global_invoice_p/print', $invoice->id) }}">
                                {{ __('Reprint') }}
                            </a>



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

                                <div
                                    class="d-flex 
                            justify-content-between
                            align-items-center
                            w-100
                            ">
                                    <div class="col-5 text-left">

                                        <div class="font-weight-bold">{{ $salon->name }}</div>
                                        <div>{{ $salon->address }},</div>
                                        <div>{{ $salon->city }} - <span></span>{{ $salon->zipcode }},
                                        </div>

                                        <div>{{ $salon->country }}</div>
                                    </div>
                                    <div class=" text-right">
                                        <img src="{{ asset('storage/images/app/' . $salon->logo) }}" id="black_logo_output"
                                            class="mt-2  rtl-float-left" width="200px">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row ">

                                <div class="col-6">
                                    <div class="col-12">
                                        <b>{{ __('Client Name') }} : </b> {{ $invoice->user->name }}
                                    </div>
                                    <div class="col-12">
                                        <b>{{ __('Phone') }} : </b> {{ $invoice->user->phone }}
                                    </div>
                                </div>

                                <div class="col-6 text-right">
                                    <div class="col-12">
                                        <b>{{ __('Invoice No') }} : {{ $invoice->id }} </b>
                                    </div>
                                    <div class="col-12">
                                        <b>{{ __('Date') }} : </b> {{ $invoice->date }}
                                    </div>
                                </div>
                            </div>

                            @php
                                $total = 0;
                            @endphp

                            <hr class="my-4" />
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Service') }}</th>

                                                    <th>{{ __('Prix') }}</th>
                                                    <th>{{ __('Date') }}</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bookings as $key => $booking)
                                                    @foreach ($booking->services as $service)
                                                        <tr>
                                                            <td>{{ $service->service_details_id ? '-' : $key + 1 }}</td>
                                                            <td @if ($service->service_details_id) colspan="3" @endif>
                                                                {{ $service->name }}
                                                            </td>
                                                            @if ($service->service_details_id)
                                                            @else
                                                                <td>{{ $service->service_details_id ? '-' : $booking->payment }}

                                                                </td>
                                                                <td>{{ $booking->date }}</td>
                                                            @endif
                                                        </tr>
                                                        @php
                                                            $total += $service->price;
                                                        @endphp
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-12 text-right mt-3">
                                    <b>{{ __('Total') }} : </b> {{ $total }} DH
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
