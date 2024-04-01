<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Title -->
    <?php $app_name = \App\AdminSetting::find(1)->app_name; ?>
    <title>{{ $app_name }}</title>

    <!-- Favicon -->
    <?php $favicon = \App\AdminSetting::find(1)->favicon; ?>
    <link href="{{ asset('storage/images/app/' . $favicon) }}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Argon CSS -->
    <link href="{{ asset('includes/css/argon.css') }}" rel="stylesheet">
    <link href="{{ asset('includes/css/mystyle.css') }}" rel="stylesheet">
    @if (session('direction') == 'rtl')
        <link href="{{ asset('includes/css/rtl.css') }}" rel="stylesheet">
    @endif
    <style>
        tr th,
        tr td {
            padding-block: .7rem !important;
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body class="{{ $class ?? '' }}">
    <div class="book">



        <div class="page">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col text-center center">
                                    <h1 class="pt-1 font-size-27">{{ __('Summary') }}</h1>
                                    <h3 class="font-size-20">{{ __('Date') }}:
                                        {{ request('filter_date') !== null ? str_replace('to ', '/', request('filter_date')) : date('Y-m-d') }}
                                        @php
                                            $dates = explode(' to ', request('filter_date'));
                                            $startDate = $dates[0];
                                            $endDate = count($dates) > 1 ? $dates[1] : null;
                                        @endphp
                                        @if (!$endDate)<br>
                                            Recette Caisse :

                                            @if (isset($startDate))
                                                {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse(today())->format('d-m-Y') }}
                                            @endif

                                        @endif
                                        <br>

                                        @if (count($caisse) > 0)
                                            Statut :
                                            {{ $caisse[0]->status == 1 ? 'Caisse cloturée' : 'Caisse ouverte' }}
                                        @endif
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left">

                                    <div class="font-weight-bold">{{ $salon->name }}</div>
                                    <div>{{ $salon->address }},</div>
                                    <div>{{ $salon->city }} - <span></span>{{ $salon->zipcode }},
                                    </div>

                                    <div>{{ $salon->country }}</div>
                                </div>
                                <div class="col-6 text-right rtl-align-left">
                                    <img src="{{ asset('storage/images/app/' . $salon->logo) }}" id="black_logo_output"
                                        class="mt-2  rtl-float-left" width="200px">
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="d-flex justify-content-end">

                            </div>
                            <table class="table table-bordered" width="80%">
                                <tr>
                                    <th>#</th>
                                    <th><b>{{ __('Client Name') }}</b></th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Payer Name') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Payment type') }}</th>
                                </tr>
                                <tbody>
                                    @if (count($payments) > 0)

                                        @foreach ($payments as $index => $payment)
                                            <tr>
                                                <td class="td">{{ $index + 1 }}</td>
                                                <td>{{ $payment->booking->user->name }}</td>
                                                <td>{{ $payment->payment_date }}</td>
                                                <td>{{ $payment->created_by }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>{{ __($payment->payment_type) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">{{ __('No record found') }}</td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>

                                    <table class="table table-bordered">
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

                                        <table class="table table-bordered" width="40%">
                                            <thead class="table-dark">
                                                <tr>
                                                    <td><b>{{ __('Service') }}</b></td>
                                                    <td><b>{{ __('Quantité') }}</b></td>
                                                    <td><b>{{ __('Price') }}</b></td>
                                                    <td><b>{{ __('Total') }}</b></td>
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
                                                        <td colspan="4" class="text-center">
                                                            {{ __('No services found.') }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </table>
                                </div>


                                <div>
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <td><b>{{ __('Payment Method') }}</b></td>
                                                <td class="text-right">
                                                    <b>{{ __('Amount') }}</b>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($cashSum)
                                                <tr>
                                                    <td><b>{{ __('Cash') }}</b></td>
                                                    <td class="text-right">{{ $cashSum }} DH</td>
                                                </tr>
                                            @endif
                                            @if ($bankTransferSum)
                                                <tr>
                                                    <td><b>{{ __('Bank transfer') }}</b></td>
                                                    <td class="text-right">{{ $bankTransferSum }} DH</td>
                                                </tr>
                                            @endif
                                            @if ($chequeSum)
                                                <tr>
                                                    <td><b>{{ __('Bank transfer') }}</b></td>
                                                    <td class="text-right">{{ $chequeSum }} DH</td>
                                                </tr>
                                            @endif
                                            @if ($creditCardSum)
                                                <tr>
                                                    <td><b>{{ __('Credit card') }}</b></td>
                                                    <td class="text-right">{{ $creditCardSum }} DH</td>
                                                </tr>
                                            @endif
                                            @if ($treatySum)
                                                <tr>
                                                    <td><b>{{ __('Treaty') }}</b></td>
                                                    <td class="text-right">{{ $treatySum }} DH</td>
                                                </tr>
                                            @endif
                                            @if ($TPESum)
                                                <tr>
                                                    <td><b>{{ __('TPE') }}</b></td>
                                                    <td class="text-right">{{ $TPESum }} DH</td>
                                                </tr>
                                            @endif
                                            @if ($otherSum)
                                                <tr>
                                                    <td><b>{{ __('Other') }}</b></td>
                                                    <td class="text-right">{{ $otherSum }} DH</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><b>{{ __('Total') }}</b></td>
                                                <td class="text-right">{{ $totalSum }} DH</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="d-flex justify-content-center mt-3">
                                <div class="w-50">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td style="width: 200px"><b>Emargement Directeur</b></td>
                                            <td style="width: 200px"><b>Emargement Responsable Guichet</b></td>
                                        </tr>
                                        <tr>
                                            <td style="height: 70px"></td>
                                            <td style="height: 70px"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
