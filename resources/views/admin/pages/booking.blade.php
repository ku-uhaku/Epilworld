@extends('layouts.app')

{{-- Check if the custom file exists --}}
@if (file_exists(resource_path('views/admin/pages/custom/booking.blade.php')))
    {{-- Include the custom file if it exists --}}
    @include('admin.pages.custom.booking')
@else
    {{-- Show the default content --}}
    @section('content')
        @include('layouts.top-header', [
            'title' => __('Booking'),
            'class' => 'col-lg-7',
        ])

        <div class="container-fluid mt--6">
            <div class="row mb-5">
                <div class="col">
                    <div class="card pb-4">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <span class="h3">{{ __('Booking table') }}</span>
                            <div class="">
                                <button class="btn btn-primary addbtn float-right p-2 add_appointment" id="add_appointment"><i
                                        class="fas fa-plus mr-1"></i>{{ __('Add Appointment') }}</button>
                            </div>
                        </div>

                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-textt" role="tablist">
                                <li class="nav-item my_nav_item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                        aria-selected="true">
                                        <i class="fa fa-calendar mr-2"></i>{{ __('Booking Calander') }}</a>
                                </li>
                                <li class="nav-item my_nav_item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                        href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                        aria-selected="false"><i class="fa fa-table mr-2"></i>{{ __('Booking Table') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card shadow">

                            <div class="card-body">
                                <div class="tab-content sssss" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                        aria-labelledby="tabs-icons-text-1-tab">
                                        <div class="pt-20">

                                            <div class="row  mb-3">

                                                <form action="{{ url('/admin/booking') }}" method="get" class="col-5">


                                                    <div class="row">

                                                        <button type="submite" name="previousDay"
                                                            class="btn btn-primary btn-md col-1">
                                                            <i class="fa fa-arrow-left"></i>
                                                        </button>


                                                        <div class="col-6">
                                                            <input type="date" name="Day" id="Day"
                                                                class="form-control bg-white"
                                                                value="{{ $thisDay ? $thisDay : date('Y-m-d') }}"
                                                                placeholder="{{ __('-- Select Date --') }}"
                                                                autocomplete="off" onchange="submitForm()">

                                                        </div>


                                                        <button type="submite" name="nextDay"
                                                            class="btn btn-primary btn-md 1  col-1">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </button>
                                                        <button type="submite" name="today"
                                                            class="btn btn-primary btn-md col-3 ">
                                                            {{ __('Today') }}
                                                        </button>
                                                        <button type="submit" id="submitBtn"
                                                            style="display: none;"></button>
                                                    </div>

                                                </form>


                                                <form action="{{ url('/admin/booking') }}" method="get" class="col-5">
                                                    <div class="row">

                                                        <button type="submit" name="previousOf"
                                                            class="btn btn-primary btn-md col-2">
                                                            {{ __('Previous') }}
                                                        </button>
                                                        <input type="text" class="form-control mr-2 col-1 "
                                                            name="numOfNext" placeholder="{{ __('Next of what') }}"
                                                            value="1">
                                                        <input type="hidden" name="currentDay"
                                                            value="{{ $thisDay }}">
                                                        <select name="nextOfWhat" class="form-control mr-2 col-2">
                                                            <option value="Day">{{ __('Day') }}</option>
                                                            <option value="Week">{{ __('Week') }}</option>
                                                            <option value="Month">{{ __('Month') }}</option>
                                                        </select>
                                                        <button type="submit" name="nextOf"
                                                            class="btn btn-primary btn-md col-2">
                                                            {{ __('Next') }}
                                                        </button>
                                                    </div>
                                                </form>

                                                <div class="col-2">

                                                    <input type="text" name="" id="" disabled
                                                        class="border-0 font-weight-bold mt-2 bg-white outline-none border-0"
                                                        style="font-size: 22px; color:#66e1c8" value="{{ $thisDay }}">
                                                </div>

                                            </div>
                                        </div>



                                        <table class="table table-striped" width="100%">
                                            <thead>
                                                <tr>
                                                    <td width="40px">{{ __('#') }}</td>
                                                    @foreach ($emps as $emp)
                                                        <td class="text-center">
                                                            <b>
                                                                {{ $emp->name }}
                                                            </b>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $generatedColors = [];
                                                    $my_array_duration = [];
                                                    foreach ($today_booking as $booking) {
                                                        // Assuming $booking->date is available for the booking date
                                                        $startTimeMilliseconds = timeToMilliseconds($booking->date . ' ' . $booking->start_time);
                                                        $endTimeMilliseconds = timeToMilliseconds($booking->date . ' ' . $booking->end_time);

                                                        // Calculate the duration in milliseconds
                                                        $durationMilliseconds = $endTimeMilliseconds - $startTimeMilliseconds;

                                                        $Duration = ceil($durationMilliseconds / 1800000);

                                                        $Duration = intval($Duration);

                                                        $my_array_duration[] = ['id' => $booking->id, 'duration' => $Duration];

                                                        // Generate random color
                                                        $color = '#' . str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);
                                                        $generatedColors[] = $color;
                                                    }
                                                    $i = -1;

                                                    function timeToMilliseconds($time)
                                                    {
                                                        $date = new DateTime($time);
                                                        return $date->getTimestamp() * 1000;
                                                    }
                                                @endphp


                                                @if ($master)
                                                    @foreach ($master as $m)
                                                        <tr
                                                            class="{{ $m['disabled'] != 1 ? '' : 'bg-gray my_disable_td' }}">
                                                            <td>
                                                                {{ $m['start_time'] }} - {{ $m['end_time'] }}
                                                            </td>

                                                            @foreach ($emps as $emp)
                                                                @php
                                                                    $cellTime = $m['start_time'];
                                                                    $cellEndTime = $m['end_time'];
                                                                    $bookingFound = false;

                                                                    $cellTime = DateTime::createFromFormat('h:i A', $cellTime);
                                                                    $cellTime = $cellTime->getTimestamp() * 1000;

                                                                    $cellEndTime = DateTime::createFromFormat('h:i A', $cellEndTime);
                                                                    $cellEndTime = $cellEndTime->getTimestamp() * 1000;

                                                                    $status = '';
                                                                    $content = '';
                                                                    $rowspan = '';

                                                                    foreach ($today_booking as $index => $booking) {
                                                                        $bookingTimeStart = $booking['start_time'];
                                                                        $bookingTimeStart = DateTime::createFromFormat('h:i A', $bookingTimeStart);
                                                                        $bookingTimeStart = $bookingTimeStart->getTimestamp() * 1000;

                                                                        $bookingTimeEnd = $booking['end_time'];
                                                                        $bookingTimeEnd = DateTime::createFromFormat('h:i A', $bookingTimeEnd);
                                                                        $bookingTimeEnd = $bookingTimeEnd->getTimestamp() * 1000;

                                                                        if ($booking['emp_id'] == $emp->emp_id) {
                                                                            if ($bookingTimeStart == $cellTime) {
                                                                                $bookingFound = $booking->user->name;
                                                                                $booking_id = $booking->id;

                                                                                $status = $booking['booking_status'];
                                                                                $content =
                                                                                    '
                                                                                 <div class="my_content_tr" onclick="edit_booking(' .
                                                                                    $booking['id'] .
                                                                                    ', \'' .
                                                                                    url('/') .
                                                                                    '\', \'' .
                                                                                    'booking' .
                                                                                    '\')">
                                                                                              <span>' .
                                                                                    trans('Client') .
                                                                                    ' : ' .
                                                                                    $bookingFound .
                                                                                    '</span><br>
                                                                                                    <span>' .
                                                                                    trans('From') .
                                                                                    ' : ' .
                                                                                    $booking['start_time'] .
                                                                                    ' : ' .
                                                                                    trans('To') .
                                                                                    ' : ' .
                                                                                    $booking['end_time'] .
                                                                                    '</span><br>
                                                                                        <ul>'; // Open the unordered list

                                                                                foreach ($booking->services as $service) {
                                                                                    $content .= '<li>' . $service->name . ' - ' . $service->price . ' DH</li>'; // Assuming each service has a 'name' and 'price' property
                                                                                }

                                                                                $content .= '</ul>';
                                                                                $content .=
                                                                                    '<span>Salle : ' .
                                                                                    $booking->room->name .
                                                                                    '
                                                                                
                                                                                </span>';

                                                                                $content .= '</div>';

                                                                                $i++;
                                                                            }
                                                                        } else {
                                                                            $bookingFound = false;
                                                                        }
                                                                    }

                                                                @endphp

                                                                <td class="my_new_td"
                                                                    onclick="open_A_Pop_Up('{{ $m['start_time'] }}','{{ $thisDay }}','{{ $emp->emp_id }}')">


                                                                    @if ($status && $status != 'Cancel')
                                                                        <div class="all_new_tr"
                                                                            style="{{-- --}}
                                                                         @foreach ($my_array_duration as $ss)
                                                                            @if ($ss['id'] == $booking_id)
                                                                            height:{{ $ss['duration'] * 60 }}px;
                                                                                
                                                                            @endif @endforeach
                                                                        background:
                                                                        @if ($status == 'in session') #dbf739;border: 2px solid #6b7d00;color:black;
                                                                        @elseif($status == 'Completed') #85E7D3;border:1px solid #007a62;color:black;
                                                                        @elseif($status == 'Approved') #42e6f5; border:2px solid #007a62;color:black; @endif ">
                                                                            {!! $content !!}




                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="8" class="text-center">
                                                            {{ __('No Booking') }}
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>


                                        </table>


                                    </div>


                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                        aria-labelledby="tabs-icons-text-2-tab">
                                        <div class="p-20">
                                            <div class="filter ml-4">
                                                <form action="{{ url('/admin/booking') }}" method="get">
                                                    @csrf
                                                    <div class="row rtl-date-filter-row d-flex align-items-center">
                                                        <div class="form-group col-3">
                                                            <select type="text"
                                                                class="form-control col-5 select2 bg-white"
                                                                name="filter_emp" id="filter_emp">
                                                                <option value="">{{ __('Select Emp') }} </option>
                                                                @foreach ($emps as $emp)
                                                                    <option value="{{ $emp->emp_id }}"
                                                                        {{ request()->get('filter_emp') == $emp->emp_id ? 'selected' : '' }}>
                                                                        {{ $emp->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('filter_emp')
                                                                <h4 class="text-center text-red mt-2">{{ $message }}</h4>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <input type="text" id="filter_date" name="filter_date"
                                                                class="form-control bg-white"
                                                                placeholder="{{ __('-- Select Date --') }}"
                                                                value="{{ request()->get('filter_date') }}"
                                                                autocomplete="off">
                                                            @error('filter_date')
                                                                <h4 class="text-center text-red mt-2">{{ $message }}</h4>
                                                            @enderror
                                                        </div>


                                                        <div class="form-group col-3">

                                                            <select class="form-control select2" name="user_name"
                                                                id="user_name"
                                                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                                                <option disabled selected value>
                                                                    {{ __('-- Select Client --') }} </option>
                                                                @foreach ($users as $user)
                                                                    <option value={{ $user->id }}
                                                                        {{ request()->get('user_name') == $user->id ? 'selected' : '' }}>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-div"><span class="user_id"></span></div>
                                                        </div>
                                                        <div class="form-group col-3">
                                                            <button type="submit"
                                                                class="btn btn-primary rtl-date-filter-btn">
                                                                <i class="fas fa-filter"></i>
                                                                {{ __('Filter') }}
                                                            </button>
                                                            <a href="{{ url('/') }}/admin/booking"
                                                                class="btn btn-primary rtl-date-filter-btn">
                                                                <i class="fas fa-filter-slash"></i>
                                                                {{ __('Clear Filter') }}
                                                            </a>
                                                        </div>

                                                    </div>
                                                </form>

                                            </div>

                                            <!-- table -->
                                            <div class="table-responsive">
                                                <table class="table align-items-center table-flush" id="booking_dt"
                                                    class="display">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            {{-- <th scope="col" class="sort">{{__('#')}}</th> --}}
                                                            <th scope="col" class="sort">{{ __('Booking id') }}</th>
                                                            <th scope="col" class="sort">{{ __('User Name') }}</th>
                                                            <th scope="col" class="sort">{{ __('Services') }}</th>
                                                            <th scope="col" class="sort">{{ __('Date') }}</th>
                                                            <th scope="col" class="sort">{{ __('Emp') }}</th>
                                                            <th scope="col" class="sort">{{ __('Room') }}</th>
                                                            <th scope="col" class="sort">{{ __('Duration') }}</th>
                                                            <th scope="col" class="sort">Montant</th>
                                                            <th scope="col" class="sort">
                                                                {{ __('Statut de paiement') }}
                                                            </th>
                                                            <th scope="col" class="sort">{{ __('Booking Status') }}
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        @if (count($bookings) != 0)
                                                            @foreach ($bookings as $key => $booking)
                                                                <tr>
                                                                    <th>{{ $bookings->firstItem() + $key }}</th>
                                                                    {{-- <td>{{$booking->booking_id}}</td> --}}
                                                                    <td>{{ $booking->user->name }}<i class=<td>
                                                                            <i
                                                                                class="fa {{ $booking->user->gender == 1 ? 'fa-mars-stroke text-info' : 'fa-venus text-pink' }}"></i>
                                                                    </td>


                                                                    </td>
                                                                    <td>
                                                                        <div class="avatar-group">
                                                                            @foreach ($booking->services as $service)
                                                                                <a href="#"
                                                                                    class="avatar avatar-sm rounded-circle"
                                                                                    data-toggle="tooltip"
                                                                                    data-original-title="{{ $service->name }}">
                                                                                    <img alt="service"
                                                                                        class="service_icon"
                                                                                        src="{{ asset('storage/images/services/' . $service->image) }}">
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $booking->date }}</td>
                                                                    <td>{{ $booking->employee->name }}</td>
                                                                    <td>{{ $booking->room->name }}</td>
                                                                    <td>{{ $booking->start_time }} To
                                                                        {{ $booking->end_time }}</td>

                                                                    <td>{{ $booking->payment }}{{ $symbol }}</td>
                                                                    <td class="text-center">

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
                                                                    <td>
                                                                        <select
                                                                            class="form-control my_status_payment_select"
                                                                            onchange="changeStatus({{ $booking->id }})"
                                                                            name="selector"
                                                                            id="selector{{ $booking->id }}">

                                                                            <option value="Cancel"
                                                                                {{ $booking->booking_status == 'Cancel' ? 'selected' : '' }}>
                                                                                {{ __('Cancel') }}
                                                                            </option>
                                                                            <option value="Réservée"
                                                                                {{ $booking->booking_status == 'Réservée' ? 'selected' : '' }}>
                                                                                {{ __('Réservée') }}
                                                                            </option>
                                                                            <option value="in session"
                                                                                {{ $booking->booking_status == 'in session' ? 'selected' : '' }}>
                                                                                {{ __('in session') }}
                                                                            </option>
                                                                            <option value="Approved"
                                                                                {{ $booking->booking_status == 'Approved' ? 'selected' : '' }}>
                                                                                {{ __('Approved') }}</option>
                                                                            <option value="Completed"
                                                                                {{ $booking->booking_status == 'Completed' ? 'selected' : '' }}>
                                                                                {{ __('Completed') }}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="table-actions">
                                                                        @php
                                                                            $base_url = url('/');
                                                                        @endphp
                                                                        <button
                                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                                            onclick="show_booking({{ $booking->id }},'{{ $base_url }}','booking')"
                                                                            data-toggle="tooltip"
                                                                            data-original-title="{{ __('View Appointment') }}">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                        <button
                                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-primary bg-white"
                                                                            onclick="edit_booking({{ $booking->id }},'{{ $base_url }}','booking')"
                                                                            data-toggle="tooltip"
                                                                            data-original-title="{{ __('Edit Appointment') }}">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        @if ($booking->payment_status == 1)
                                                                            <a href="{{ url('/admin/booking/invoice/' . $booking->id) }}"
                                                                                class=" btn-white btn shadow-none p-0 m-0 table-action text-cyan bg-white text-blue cursor table-action
                                                                        my_invoice_btn
                                                                        "
                                                                                data-toggle="tooltip"
                                                                                data-original-title="{{ __('View Invoice') }}">
                                                                                <i class="fas fa-file-invoice"></i>
                                                                            </a>
                                                                        @endif

                                                                        <a href="{{ url('/admin/payment/create/' . $booking->id) }}"
                                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-purple bg-white my_payment_btn"
                                                                            data-toggle="tooltip"
                                                                            data-original-title="{{ __('Payment') }}">
                                                                            <i class="fas fa-coins"></i>
                                                                        </a>

                                                                        {{-- <form
                                                                        action="{{ url('/admin/booking/' . $booking->id) }}"
                                                                        method="post" class="d-inline-block">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white">
                                                                            <i class="fas fa-trash-alt"
                                                                                data-toggle="tooltip"
                                                                                data-original-title="{{ __('Delete') }}"></i>
                                                                        </button>
                                                                    </form> --}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <th colspan="15" class="text-center">
                                                                    {{ __('No Bookings') }}</th>
                                                            </tr>
                                                        @endif

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
                </div>
            </div>
        </div>

        </div>

        @include('admin.booking.popUp')
        @include('admin.booking.edit')

        @include('admin.booking.create')

        @include('admin.booking.show')
    @endsection

@endif
