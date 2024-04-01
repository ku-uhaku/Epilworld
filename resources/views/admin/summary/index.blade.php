@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Summary'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Summary') }}</span>
                        <a class="btn btn-primary addbtn float-right p-2 ml-2"
                            href="{{ url('/admin/summary/print/') }}?filter_date={{ request('filter_date') }}">
                            <i class="fas fa-plus mr-1"></i>{{ __('Print') }}
                        </a>


                        @php
                            $dates = explode(' to ', request('filter_date'));
                            $startDate = $dates[0];
                            $endDate = count($dates) > 1 ? $dates[1] : null;
                        @endphp



                        @if ($isCaisse)
                            @if (count($caisse) != 0)
                                @if ($caisse[0]->status == '1')
                                    <a class="btn btn-primary addbtn float-right p-2"
                                        href="{{ url('/admin/summary/payment_not_done/') }}?filter_date={{ request('filter_date') }}&caisse={{ $caisse[0]->id }}">
                                        <i class="fas fa-plus mr-1"></i>{{ __('Payment Not Done') }}

                                    </a>
                                    <!-- Fix the typo here -->
                                @else
                                    <a class="btn btn-primary addbtn float-right p-2"
                                        href="{{ url('/admin/summary/payment_done/') }}?filter_date={{ request('filter_date') }}&totalSum={{ $totalSum }}&caisse={{ $caisse[0]->id }}">
                                        <i class="fas fa-plus mr-1"></i>{{ __('Payment Done') }}
                                    </a>
                                @endif
                            @else
                                <a class="btn btn-primary addbtn float-right p-2"
                                    href="{{ url('/admin/summary/payment_done/') }}?filter_date={{ request('filter_date') }}&totalSum={{ $totalSum }}">
                                    <i class="fas fa-plus mr-1"></i>{{ __('Payment Done') }}
                                </a>
                            @endif
                            <!-- If there is a caisse today -->
                        @endif


                    </div>



                    <form action="{{ url('/admin/summary') }}" method="get">
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



                            <div class="form-group col-5">
                                <button type="submit" class="btn btn-primary rtl-date-filter-btn">
                                    <i class="fas fa-filter"></i>
                                    {{ __('Filter') }}
                                </button>
                                <a href="{{ url('/') }}/admin/summary" class="btn btn-primary rtl-date-filter-btn">
                                    <i class="fas fa-filter-slash"></i>
                                    {{ __('Clear Filter') }}
                                </a>

                                <button type="button" class="btn btn-primary rtl-date-filter-btn" data-toggle="modal"
                                    data-target="#exampleModal">
                                    {{ __('All Caisse') }}
                                </button>
                            </div>
                            <div class="col-4 ">
                                <h2 style="font-size: 22px; color:#66e1c8">

                                    @if (!$endDate)
                                        Recette Caisse :

                                        @if (isset($startDate))
                                            {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse(today())->format('d-m-Y') }}
                                        @endif
                                    @else
                                    @endif

                                    @if (count($caisse) == 1 && !$endDate)
                                        -
                                        {{ $caisse[0]->status == 1 ? 'Caisse cloturée' : 'Caisse ouverte' }}
                                    @endif



                                </h2>
                            </div>
                        </div>


                    </form>


                    <div class="row mx-4">
                        <div class="card border col-6 rounded shadow   py-1 mb-3">
                            <div class="card-header bg-secondary">{{ __('Cash movement summary') }}</div>

                            <div class="card_body px-4 ">
                                <table class="table mt-2">
                                    <thead class="table-dark">
                                        <tr>
                                            <td>{{ __('Payment Method') }}</td>
                                            <td class="text-right">
                                                {{ __('Amount') }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Cash') }}</td>
                                            <td class="text-right">{{ $cashSum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Bank transfer') }}</td>
                                            <td class="text-right">{{ $bankTransferSum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Cheque') }}</td>
                                            <td class="text-right">{{ $chequeSum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Credit card') }}</td>
                                            <td class="text-right">{{ $creditCardSum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Treaty') }}</td>
                                            <td class="text-right">{{ $treatySum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('TPE') }}</td>
                                            <td class="text-right">{{ $TPESum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Other') }}</td>
                                            <td class="text-right">{{ $otherSum }} DH</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Total') }}</td>
                                            <td class="text-right">{{ $totalSum }} DH</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card border  rounded shadow   py-1 mb-3">
                                <div class="card-header bg-secondary">{{ __('Facture summary') }}</div>

                                <div class="card_body px-4 ">


                                    <table class="table mt-2">
                                        <thead class="table-dark">
                                            <tr>
                                                <td>#</td>
                                                <td>{{ __('Date') }}</td>
                                                <td>{{ __('Total') }}</td>
                                                <td>{{ __('Amount') }}</td>
                                                <td>{{ __('Rest') }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($payments) > 0)
                                                <?php
                                                $totalDate = 0;
                                                $totalPayment = 0;
                                                $totalAmount = 0;
                                                $totalRest = 0;
                                                ?>

                                                @foreach ($payments as $index => $payment)
                                                    <?php
                                                    // Move the $totalPaymentAmount initialization here
                                                    $totalPaymentAmount = $payment->booking->payments->where('status', 0)->sum('amount');
                                                    
                                                    // Accumulate values for totals
                                                    $totalPayment += $payment->booking->payment;
                                                    $totalAmount += $payment->amount;
                                                    $totalRest += $payment->booking->payment - $totalPaymentAmount;
                                                    ?>
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}
                                                        </td>
                                                        <td>{{ $payment->booking->payment }} DH</td>
                                                        <td>{{ $payment->amount }} DH</td>
                                                        <td>{{ $payment->booking->payment - $totalPaymentAmount }} DH</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td>{{ __('Total') }}</td>
                                                    <td></td>
                                                    <td>{{ $totalPayment }} DH</td>
                                                    <td>{{ $totalAmount }} DH</td>
                                                    <td>{{ $totalRest }} DH</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">{{ __('No records found.') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>




                                </div>
                            </div>

                            <div class="card border  rounded shadow   py-1 mb-3">
                                <div class="card-header bg-secondary">{{ __('Services summary') }}</div>

                                <div class="card_body px-4">

                                    @php
                                        $servicesArray = [];

                                        foreach ($bookings as $index => $booking) {
                                            $bookingServices = json_decode($booking->service_id) ?? [];

                                            foreach ($bookingServices as $t => $serviceId) {
                                                $serviceName = $booking->services[$t]->name;
                                                $servicePrice = $booking->services[$t]->price;

                                                if (!isset($servicesArray[$serviceName])) {
                                                    $servicesArray[$serviceName] = [
                                                        'quantity' => 1,
                                                        'price' => $servicePrice,
                                                    ];
                                                } else {
                                                    $servicesArray[$serviceName]['quantity']++;
                                                }
                                            }
                                        }
                                    @endphp

                                    <table class="table mt-2">
                                        <thead class="table-dark">
                                            <tr>
                                                <td>{{ __('Service') }}</td>
                                                <td>{{ __('Quantité') }}</td>
                                                <td>{{ __('Price') }}</td>
                                                <td>{{ __('Total') }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($servicesArray) > 0)
                                                @foreach ($servicesArray as $serviceName => $data)
                                                    <tr>
                                                        <td>{{ $serviceName }}</td>
                                                        <td>{{ $data['quantity'] }}</td>
                                                        <td>{{ $data['price'] }} DH</td>
                                                        <td>{{ $data['price'] * $data['quantity'] }} DH</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">{{ __('No services found.') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
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
        <div class="modal-dialog" style="min-width: 900px"role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Touts les caisses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Day action') }}</th>
                                <th>Journée</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($caisse as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->date }}</td>
                                    <td>{{ \Carbon\Carbon::parse($c->day_caisse)->format('y/m/d') }}</td>


                                    <td>{{ $c->amount }}</td>
                                    <td>{{ $c->status == 1 ? 'Caisse cloturée' : 'Caisse ouverte' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/summary') }}?filter_date={{ $c->day_caisse }}"
                                            class="btn-white btn shadow-none p-0 m-0 table-action text-info
                                            bg-white"><i
                                                class="fas fa-eye"></i></a>
                                        <a href="{{ url('/admin/summary/print/') }}?filter_date={{ $c->day_caisse }}"
                                            class="btn-white btn shadow-none p-0 m-0 table-action text-primary
                                            bg-white"><i
                                                class="fas fa-print mr-1"></i></a>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <script></script>
@endpush
