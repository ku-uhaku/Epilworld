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
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>

    <script>
        //format A5
        var style = '@page { size: A5; }';

        var styleSheet = document.createElement("style");
        styleSheet.type = "text/css";
        styleSheet.innerText = style;
        document.head.appendChild(styleSheet);

        //print
        window.print();
    </script>

</head>

<body>
    <div class="book">
        <div class="page">
            <div class="row">
                <div class="col-10 position-relative">
                    <div class="card shadow">
                        <div class="card-body">

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

                            <hr class="my-4" />

                            <div class="px-3">
                                <span class="row px-2">
                                    <div class="col-12">
                                        <b>Réservation : </b> {{ $payment->booking->booking_id }}
                                    </div>

                                </span>

                                <span class="row px-2">
                                    <div class="col-12">
                                        <b>{{ __('Client Name') }} : </b> {{ $payment->booking->user->name }}
                                    </div>

                                </span>

                                <span class="row px-2 mb-3">
                                    <div class="col-12">
                                        <b>{{ __('Date') }} : </b> {{ $payment->payment_date }}
                                    </div>

                                </span>
                            </div>





                            <table class="table" style="width: 100%">
                                <tr>
                                    <th colspan="2" style="height: 20px">
                                        <span style="font-size: 20px"><b>{{ __('Services') }}</b></span>
                                    </th>
                                </tr>


                                @php
                                    $total = 0; // Initialize total before the loop
                                @endphp

                                @foreach ($payment->booking->services as $service)
                                    <?php
                                    $total += $service->price;
                                    ?>
                                    <tr>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->price }} DH</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>{{ __('Mode de paiement') }}</th>
                                    <td>{{ __($payment->payment_type) }}</td>
                                </tr>
                                <tr>
                                    <th><b>{{ __('Amount') }}</b></th>
                                    <td>{{ $payment->amount }} DH</td>
                                </tr>

                                <tr>
                                    <th><b>{{ __('Total') }}</b></th>
                                    <td>{{ $total }} DH</td>
                                </tr>





                            </table>
                            <hr class="my-4" />
                            <div class="d-flex justify-content-end">
                                <table class="table  table-bordered" style="width: 400px">
                                    <tr>
                                        <td class="text-center">Signature</td>
                                    </tr>
                                    <tr>
                                        <td style="height: 80px"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="footer">
                                {{ __('We appreciate your confidence in us.') }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
