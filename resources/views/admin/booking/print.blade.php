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
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col text-center center">

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
                            <div class="d-flex justify-content-between mb-2">
                                <div class="font-weight-bold">Client: {{ $bookings[0]->user->name }}</div>
                                <div class="font-weight-bold">Date: {{ $bookings[0]->date }}</div>

                            </div>

                            <table class="table table-bordered" width="60%">
                                <tr>
                                    <th>Date</th>
                                    <th>duréé</th>
                                    <th>Service</th>
                                    <th>Employée</th>
                                    <th>Statut</th>
                                </tr>

                                @foreach ($bookings as $booking)
                                    <tr>

                                        <td>{{ $booking->date }}</td>
                                        <td>{{ $booking->start_time }} à {{ $booking->end_time }}</td>
                                        <td>{{ $booking->services[0]->name }}</td>
                                        <td>{{ $booking->employee->name }}</td>
                                        <td>{{ $booking->booking_status }}</td>

                                    </tr>
                                @endforeach

                            </table>
                            <hr class="my-4" />
                            <div class="d-flex justify-content-end">
                                <table class="table  table-bordered" style="width: 400px">
                                    <tr>
                                        <td class="text-center">Signature</td>
                                    </tr>
                                    <tr>
                                        <td style="height: 120px"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
