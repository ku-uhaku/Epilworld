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

    <script>
        window.print();
    </script>

</head>

<body class="{{ $class ?? '' }}">
    <div class="book">
        <div class="page">
            <div class="row">
                <div class="col">
                    <div class="card pb-4">

                        <div class="card shadow mx-auto ">
                            <div class="card-body ">
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
                                            <img src="{{ asset('storage/images/app/' . $salon->logo) }}"
                                                id="black_logo_output" class="mt-2  rtl-float-left" width="200px">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="row ">

                                    <div class="col-6">
                                        <div class="col-12">
                                            <b>{{ __('Client Name') }} : </b> {{ $bookings->first()->user->name }}
                                        </div>
                                        <div class="col-12">
                                            <b>{{ __('Phone') }} : </b> {{ $bookings->first()->user->phone }}
                                        </div>
                                    </div>

                                    <div class="col-6 text-right">
                                        <div class="col-12">
                                            <b>{{ __('Invoice No') }} : </b> {{ $global_invoice->id }}
                                        </div>
                                        <div class="col-12">
                                            <b>{{ __('Date') }} : </b>
                                            {{-- format date y m d --}}
                                            {{ $global_invoice->date->format('d-m-Y') }}
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
                                                                <td>{{ $service->service_details_id ? '-' : $key + 1 }}
                                                                </td>
                                                                <td
                                                                    @if ($service->service_details_id) colspan="3" @endif>
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
        </div>
    </div>
</body>

</html>
