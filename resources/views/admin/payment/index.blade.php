@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Recette'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6">
        <div class="row mb-5">
            <div class="col">
                <div class="card pb-4">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">Tableau des recettes</span>
                        <div class="">
                            <button type="button" class="btn btn-primary addbtn float-right p-2" data-toggle="modal"
                                data-target="#eyemodal" data-original-title="{{ __('Cancel Payment') }}">
                                <i class="fas fa-eye"></i> {{ __('All cancel payemnts') }}
                            </button>
                        </div>
                    </div>



                    <div class="card shadow">

                        <form action="{{ url('/admin/payment') }}" method="get">
                            @csrf
                            <div class="row rtl-date-filter-row d-flex align-items-center ml-4">

                                <div class="form-group col-3">
                                    <input type="text" id="filter_date" name="filter_date" class="form-control bg-white"
                                        placeholder="{{ __('-- Select Date --') }}"
                                        value="{{ request()->get('filter_date') }}" autocomplete="off">
                                    @error('filter_date')
                                        <h4 class="text-center text-red mt-2">{{ $message }}</h4>
                                    @enderror
                                </div>



                                <div class="form-group col-3">
                                    <button type="submit" class="btn btn-primary rtl-date-filter-btn">
                                        <i class="fas fa-filter"></i>
                                        {{ __('Filter') }}
                                    </button>
                                    <a href="{{ url('/') }}/admin/payment" class="btn btn-primary rtl-date-filter-btn">
                                        <i class="fas fa-filter-slash"></i>
                                        {{ __('Clear Filter') }}
                                    </a>
                                </div>

                            </div>
                        </form>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="booking_dt" class="display">
                                    <thead class="thead-light">
                                        <tr>
                                            {{-- <th scope="col" class="sort">{{__('#')}}</th> --}}
                                            <th scope="col" class="sort">RÉSERVATION
                                            </th>
                                            <th scope="col" class="sort">{{ __('User Name') }}</th>
                                            <th scope="col" class="sort">{{ __('Date') }}</th>

                                            <th scope="col" class="sort">Montant</th>
                                            <th scope="col" class="sort">{{ __('Payed amount') }}</th>
                                            <th scope="col" class="sort">{{ __('payment remaining') }}</th>
                                            <th scope="col" class="sort">{{ __('Statut de paiement') }}</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->booking_id }}</td>
                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->date }}</td>


                                                <td>{{ $booking->payment }}{{ $symbol }}</td>

                                                <td>
                                                    @php
                                                        $sumForStatusZero = 0;
                                                        foreach ($booking->payments as $payment) {
                                                            if ($payment->status == 0) {
                                                                $sumForStatusZero += $payment->amount;
                                                            }
                                                        }
                                                        echo $sumForStatusZero . $symbol;
                                                    @endphp
                                                </td>


                                                <td>
                                                    @php
                                                        $sumForStatusZero = 0;
                                                        foreach ($booking->payments as $payment) {
                                                            if ($payment->status == 0) {
                                                                $sumForStatusZero += $payment->amount;
                                                            }
                                                        }
                                                        echo $booking->payment - $sumForStatusZero . $symbol;
                                                    @endphp
                                                </td>




                                                <td class="">

                                                    @if ($booking->payment_status == 1)
                                                        <span
                                                            class="badge badge-pill badge-success">{{ __('Paid') }}</span>
                                                    @elseif($booking->payment_status == 0)
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ __('Unpaid') }}</span>
                                                    @elseif($booking->payment_status == 2)
                                                        <span
                                                            class="badge badge-pill badge-info">{{ __('Partially') }}</span>
                                                    @endif
                                                </td>
                                                <td class="table-action">



                                                    <a href="{{ url('/admin/payment/create/' . $booking->id) }}"
                                                        class="btn-white btn shadow-none p-0 m-0 table-action text-purple bg-white my_payment_btn"
                                                        data-toggle="tooltip" data-original-title="{{ __('Payment') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <button type="button"
                                                        class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $booking->id }}" id="cancel_payment_btn"
                                                        onclick="cancelBookingPayment({{ $booking->id }})"
                                                        data-original-title="{{ __('Cancle Payment') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>


                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="float-right mr-4 mt-3">
                                    {{ $bookings->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="p-2">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm cancellation') }}</h5>

                </div>
                <form id="my_modal_cancel_form" action="{{ route('admin.payment.cancelPayment') }}" method="post">
                    @csrf
                    <div class="px-2 mt-3">
                        <input type="hidden" id="booking_iddd" name="booking_iddd">
                        <label for="">{{ __('Reason to cancel') }}</label>
                        <textarea name="whycancel" id="whycancel" class="form-control"></textarea>
                    </div>
                    <div class="px-2 mt-4">
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <div class="modal fade" id="eyemodal" tabindex="-1" role="dialog" aria-labelledby="eyemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog " style="min-width: 900px" role="document">
            <div class="modal-content">
                <div class="p-2">
                    <h5 class="modal-title" id="eyemodalLabel">{{ __('Show Details') }}</h5>

                </div>
                <input type="hidden" class="my_key">

                <div class="p-2">
                    <table class="table table-responsive">
                        <thead class="thead-light">
                            <tr>
                                {{-- <th scope="col" class="sort">{{__('#')}}</th> --}}
                                <th scope="col" class="sort">{{ __('Booking id') }}</th>
                                <th scope="col" class="sort">{{ __('User Name') }}</th>
                                <th scope="col" class="sort">{{ __('Date') }}</th>
                                <th scope="col" class="sort">Montant</th>
                                <th scope="col" class="sort">{{ __('Who cancel') }}</th>
                                <th scope="col" class="sort">{{ __('Why cancel') }}</th>
                                <th scope="col" class="sort">{{ __('Date cancel') }}</th>



                            </tr>
                        </thead>

                        @foreach ($cancelPayments as $cancelPayment)
                            <tr>
                                <td>{{ $cancelPayment->booking->id }}</td>
                                <td>{{ $cancelPayment->booking->user->name }}</td>
                                <td>{{ $cancelPayment->payment_date }}</td>
                                <td>{{ $cancelPayment->amount }}</td>
                                <td>{{ $cancelPayment->who_cancel }}</td>
                                <td>{{ $cancelPayment->whycancel }}</td>
                                <td>{{ date('Y-m-d', strtotime($cancelPayment->cancel_date)) }}</td>



                            </tr>
                        @endforeach

                        <!-- ... Add other table rows ... -->
                    </table>


                </div>

            </div>



        </div>
    </div>
@endsection
