<?php

namespace App\Http\Controllers\admin;

use App\Room;
use App\User;
use DateTime;
use App\Salon;
use OneSignal;
use App\Coupon;
use App\Booking;
use App\Payment;
use App\Service;
use App\Category;
use App\Employee;
use App\Template;
use Carbon\Carbon;
use App\AdminSetting;
use App\Notification;
use App\GlobalInvoice;
use App\ServiceDetails;
use App\Mail\BookingStatus;
use App\Mail\PaymentStatus;
use Illuminate\Http\Request;
use App\Mail\CreateAppointment;
use App\Mail\AppCreateAppointment;
use Illuminate\Support\Facades\DB;

//Auth
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class BookingController extends Controller
{
    public function index(Request $request)
    {

        $salon = Salon::where('owner_id', auth()->user()->id)->first();


        $today_booking = Booking::where('salon_id', $salon->salon_id);

        $users = User::where([['status', 1], ['role', 3]])->get();
        $emps = Employee::where([['status', 1], ['salon_id', $salon->salon_id]])->get();
        $services = Service::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
        $symbol = AdminSetting::find(1)->currency_symbol;
        $bookings = Booking::where('salon_id', $salon->salon_id);


        $masterBooking = [];

        $category = Category::all();

        $thisDay = Carbon::today()->toDateString();



        $master = array();
        $day = strtolower(Carbon::parse($request->date)->format('l'));
        $s = Salon::find($salon->salon_id)->$day;
        $start_time = new Carbon($request['date'] . ' ' . $s['open']);

        $end_time = new Carbon($request['date'] . ' ' . $s['close']);


        $diff_in_minutes = $start_time->diffInMinutes($end_time);

        for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
            if ($start_time >= $end_time) {
                break;
            } else {
                $temp['start_time'] = $start_time->format('h:i A');
                $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                $temp['disabled'] = false;
                if ($request->date == date('Y-m-d')) {
                    if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                        array_push($master, $temp);
                    }
                } else {
                    array_push($master, $temp);
                }
            }
        }


        $end_of_day = now()->endOfDay();
        if (count($master) > 0) {
            $lastEndTime = end($master)['start_time'];
            $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
            $gapStartTime = $lastEndTime->copy()->addMinutes(30);
            $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
            // Check if there is a gap, and if so, add new time slots
            if ($gapStartTime < $targetEndTime) {
                while ($gapStartTime < $targetEndTime) {
                    $temp['start_time'] = $gapStartTime->format('h:i A');
                    $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                    $temp['disabled'] = true;
                    array_push($master, $temp);
                }
            }
        }

        if ($request->filled('filter_date') || $request->filled('filter_emp') || $request->filled('user_name')) {
            // Handling filter logic

            // Filter by employee (user)
            if ($request->filled('filter_emp')) {
                $employeeId = $request->input('filter_emp');
                $bookings = $bookings->where('emp_id', $employeeId);
            }



            if ($request->filled('user_name')) {
                $bookings = $bookings->where('user_id', $request->input('user_name'));
            }

            // Filter by date
            if ($request->filled('filter_date')) {
                $dates = explode(' to ', $request->filter_date);
                $from = $dates[0];
                if (!isset($dates[1])) {
                    $to = $dates[0];
                } else {
                    $to = $dates[1];
                }


                $bookings = $bookings->whereBetween('date', [$from, $to]);
            }
            // Finalize the query
            $bookings = $bookings->orderBy('id', 'DESC')->paginate(100);

            //remove duplicate booking_id
            $bookingss = $bookings->unique('booking_id');




            foreach ($bookingss as $booking) {

                $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
            }

            $today_booking = $today_booking->where('date', Carbon::parse($thisDay)->toDateString())
                ->get();



            //change request date
            $thisDay = Carbon::parse($thisDay)->toDateString();
            $master = array();
            $day = strtolower(Carbon::parse($thisDay)->format('l'));
            $s = Salon::find($salon->salon_id)->$day;
            $start_time = new Carbon($request['date'] . ' ' . $s['open']);

            $end_time = new Carbon($request['date'] . ' ' . $s['close']);
            $diff_in_minutes = $start_time->diffInMinutes($end_time);
            for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
                if ($start_time >= $end_time) {
                    break;
                } else {
                    $temp['start_time'] = $start_time->format('h:i A');
                    $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                    $temp['disabled'] = false;
                    if ($request->date == date('Y-m-d')) {
                        if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                            array_push($master, $temp);
                        }
                    } else {
                        array_push($master, $temp);
                    }
                }
            }
            $end_of_day = now()->endOfDay();
            if (count($master) > 0) {
                $lastEndTime = end($master)['start_time'];
                $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
                $gapStartTime = $lastEndTime->copy()->addMinutes(30);
                $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
                // Check if there is a gap, and if so, add new time slots
                if ($gapStartTime < $targetEndTime) {
                    while ($gapStartTime < $targetEndTime) {
                        $temp['start_time'] = $gapStartTime->format('h:i A');
                        $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                        $temp['disabled'] = true;
                        array_push($master, $temp);
                    }
                }
            }


            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
        } else if ($request->has('previousDay')) {

            $bookings = $bookings->orderBy('id', 'DESC')->where('date', Carbon::today()->toDateString())->paginate(100);

            //remove duplicate booking_id
            $bookingss = $bookings->unique('booking_id');




            foreach ($bookingss as $booking) {

                $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
            }
            $today_booking = $today_booking->where('date', Carbon::parse($request->Day)->subDay()->toDateString())
                ->get();

            //change request date
            $thisDay = Carbon::parse($request->Day)->subDay()->toDateString();
            $master = array();
            $day = strtolower(Carbon::parse($thisDay)->format('l'));
            $s = Salon::find($salon->salon_id)->$day;
            $start_time = new Carbon($request['date'] . ' ' . $s['open']);

            $end_time = new Carbon($request['date'] . ' ' . $s['close']);
            $diff_in_minutes = $start_time->diffInMinutes($end_time);
            for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
                if ($start_time >= $end_time) {
                    break;
                } else {
                    $temp['start_time'] = $start_time->format('h:i A');
                    $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                    $temp['disabled'] = false;
                    if ($request->date == date('Y-m-d')) {
                        if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                            array_push($master, $temp);
                        }
                    } else {
                        array_push($master, $temp);
                    }
                }
            }
            $end_of_day = now()->endOfDay();
            if (count($master) > 0) {
                $lastEndTime = end($master)['start_time'];
                $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
                $gapStartTime = $lastEndTime->copy()->addMinutes(30);
                $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
                // Check if there is a gap, and if so, add new time slots
                if ($gapStartTime < $targetEndTime) {
                    while ($gapStartTime < $targetEndTime) {
                        $temp['start_time'] = $gapStartTime->format('h:i A');
                        $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                        $temp['disabled'] = true;
                        array_push($master, $temp);
                    }
                }
            }

            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
        } else if ($request->has('nextDay')) {
            $bookings = $bookings->orderBy('id', 'DESC')->where('date', Carbon::today()->toDateString())->paginate(100);

            //remove duplicate booking_id
            $bookingss = $bookings->unique('booking_id');




            foreach ($bookingss as $booking) {

                $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
            }
            $today_booking = $today_booking->where('date', Carbon::parse($request->Day)->addDay()->toDateString())
                ->get();



            //change request date
            $thisDay = Carbon::parse($request->Day)->addDay()->toDateString();

            $master = array();
            $day = strtolower(Carbon::parse($thisDay)->format('l'));
            $s = Salon::find($salon->salon_id)->$day;
            $start_time = new Carbon($request['date'] . ' ' . $s['open']);

            $end_time = new Carbon($request['date'] . ' ' . $s['close']);
            $diff_in_minutes = $start_time->diffInMinutes($end_time);


            for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
                if ($start_time >= $end_time) {
                    break;
                } else {
                    $temp['start_time'] = $start_time->format('h:i A');

                    $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                    $temp['disabled'] = false;

                    if ($request->date == date('Y-m-d')) {
                        if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                            array_push($master, $temp);
                        }
                    } else {
                        array_push($master, $temp);
                    }
                }
            }
            $end_of_day = now()->endOfDay();
            if (count($master) > 0) {
                $lastEndTime = end($master)['start_time'];
                $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
                $gapStartTime = $lastEndTime->copy()->addMinutes(30);
                $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
                // Check if there is a gap, and if so, add new time slots
                if ($gapStartTime < $targetEndTime) {
                    while ($gapStartTime < $targetEndTime) {
                        $temp['start_time'] = $gapStartTime->format('h:i A');
                        $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                        $temp['disabled'] = true;
                        array_push($master, $temp);
                    }
                }
            }

            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
        } else if ($request->has('today')) {
            $bookings = $bookings->orderBy('id', 'DESC')->where('date', Carbon::today()->toDateString())->paginate(100);

            //remove duplicate booking_id
            $bookingss = $bookings->unique('booking_id');




            foreach ($bookingss as $booking) {

                $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
            }

            $today_booking = $today_booking->where('date', Carbon::today()->toDateString())
                ->get();

            //change request date
            $thisDay = Carbon::today()->toDateString();
            $master = array();
            $day = strtolower(Carbon::parse($thisDay)->format('l'));
            $s = Salon::find($salon->salon_id)->$day;
            $start_time = new Carbon($request['date'] . ' ' . $s['open']);

            $end_time = new Carbon($request['date'] . ' ' . $s['close']);
            $diff_in_minutes = $start_time->diffInMinutes($end_time);
            for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
                if ($start_time >= $end_time) {
                    break;
                } else {
                    $temp['start_time'] = $start_time->format('h:i A');
                    $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                    $temp['disabled'] = false;
                    if ($request->date == date('Y-m-d')) {
                        if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                            array_push($master, $temp);
                        }
                    } else {
                        array_push($master, $temp);
                    }
                }
            }
            $end_of_day = now()->endOfDay();
            if (count($master) > 0) {
                $lastEndTime = end($master)['start_time'];
                $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
                $gapStartTime = $lastEndTime->copy()->addMinutes(30);
                $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
                // Check if there is a gap, and if so, add new time slots
                if ($gapStartTime < $targetEndTime) {
                    while ($gapStartTime < $targetEndTime) {
                        $temp['start_time'] = $gapStartTime->format('h:i A');
                        $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                        $temp['disabled'] = true;
                        array_push($master, $temp);
                    }
                }
            }

            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
        } else if ($request->has('Day')) {
            $bookings = $bookings->orderBy('id', 'DESC')->where('date', Carbon::today()->toDateString())->paginate(100);

            //remove duplicate booking_id
            $bookingss = $bookings->unique('booking_id');




            foreach ($bookingss as $booking) {

                $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
            }

            $today_booking = $today_booking->where('date', Carbon::parse($request->Day)->toDateString())
                ->get();

            //change request date
            $thisDay = Carbon::parse($request->Day)->toDateString();

            $master = array();
            $day = strtolower(Carbon::parse($thisDay)->format('l'));
            $s = Salon::find($salon->salon_id)->$day;
            $start_time = new Carbon($request['date'] . ' ' . $s['open']);

            $end_time = new Carbon($request['date'] . ' ' . $s['close']);
            $diff_in_minutes = $start_time->diffInMinutes($end_time);
            for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
                if ($start_time >= $end_time) {
                    break;
                } else {
                    $temp['start_time'] = $start_time->format('h:i A');
                    $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                    $temp['disabled'] = false;
                    if ($request->date == date('Y-m-d')) {
                        if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                            array_push($master, $temp);
                        }
                    } else {
                        array_push($master, $temp);
                    }
                }
            }
            $end_of_day = now()->endOfDay();
            if (count($master) > 0) {
                $lastEndTime = end($master)['start_time'];
                $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
                $gapStartTime = $lastEndTime->copy()->addMinutes(30);
                $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
                // Check if there is a gap, and if so, add new time slots
                if ($gapStartTime < $targetEndTime) {
                    while ($gapStartTime < $targetEndTime) {
                        $temp['start_time'] = $gapStartTime->format('h:i A');
                        $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                        $temp['disabled'] = true;
                        array_push($master, $temp);
                    }
                }
            }
            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
        }

        if ($request->has('nextOf') || $request->has('previousOf')) {

            $bookings = $bookings->orderBy('id', 'DESC')->where('date', Carbon::today()->toDateString())->paginate(100);

            //remove duplicate booking_id
            $bookingss = $bookings->unique('booking_id');

            foreach ($bookingss as $booking) {
                $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
            }

            $numOfNext = $request->numOfNext;
            $nextOfWhat = $request->nextOfWhat;



            if ($nextOfWhat == 'Day') {
                $interval = $request->has('nextOf') ? 'addDays' : 'subDays';
            } elseif ($nextOfWhat == 'Week') {
                $interval = $request->has('nextOf') ? 'addWeeks' : 'subWeeks';
            } elseif ($nextOfWhat == 'Month') {
                $interval = $request->has('nextOf') ? 'addMonths' : 'subMonths';
            }

            $today_booking = $today_booking->where('date', Carbon::parse($request->currentDay)->$interval($numOfNext)->toDateString())
                ->get();

            $thisDay = Carbon::parse($request->currentDay)->$interval($numOfNext)->toDateString();
            $master = array();
            $day = strtolower(Carbon::parse($thisDay)->format('l'));
            $s = Salon::find($salon->salon_id)->$day;
            $start_time = new Carbon($request['date'] . ' ' . $s['open']);

            $end_time = new Carbon($request['date'] . ' ' . $s['close']);
            $diff_in_minutes = $start_time->diffInMinutes($end_time);
            for ($i = 0; $i <= $diff_in_minutes; $i += 30) {
                if ($start_time >= $end_time) {
                    break;
                } else {
                    $temp['start_time'] = $start_time->format('h:i A');
                    $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');
                    $temp['disabled'] = false;
                    if ($request->date == date('Y-m-d')) {
                        if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                            array_push($master, $temp);
                        }
                    } else {
                        array_push($master, $temp);
                    }
                }
            }
            $end_of_day = now()->endOfDay();
            if (count($master) > 0) {
                $lastEndTime = end($master)['start_time'];
                $lastEndTime = Carbon::createFromFormat('h:i A', $lastEndTime);
                $gapStartTime = $lastEndTime->copy()->addMinutes(30);
                $targetEndTime = Carbon::createFromFormat('h:i A', '11:30 PM');
                // Check if there is a gap, and if so, add new time slots
                if ($gapStartTime < $targetEndTime) {
                    while ($gapStartTime < $targetEndTime) {
                        $temp['start_time'] = $gapStartTime->format('h:i A');
                        $temp['end_time'] = $gapStartTime->addMinutes(30)->format('h:i A');
                        $temp['disabled'] = true;
                        array_push($master, $temp);
                    }
                }
            }
            $today_booking = Booking::where('date', $thisDay)->get();
            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
        }

        $today_booking = $today_booking
            ->where('date', Carbon::today()->toDateString())
            ->get();

        $bookings = $bookings->orderBy('id', 'DESC')->where('date', Carbon::today()->toDateString())->paginate(100);


        //remove duplicate booking_id
        $bookingss = $bookings->unique('booking_id');

        foreach ($bookingss as $booking) {
            $masterBooking[] = Booking::where('salon_id', $salon->salon_id)->where('booking_id', $booking->booking_id)->get();
        }

        // Default case when no filters are applied
        return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay', 'masterBooking'));
    }

    public function invoice($id)
    {
        $booking = Booking::find($id);
        $symbol = AdminSetting::find(1)->currency_symbol;
        return view('admin.booking.invoice', compact('booking', 'symbol'));
    }

    public function invoice_print($id)
    {
        $booking = Booking::find($id);
        $symbol = AdminSetting::find(1)->currency_symbol;
        return view('admin.booking.invoicePrint', compact('booking', 'symbol'));
    }

    public function create()
    {
        $salon_id = Salon::where('owner_id', Auth()->user()->id)->first()->salon_id;
        $services = Service::where('salon_id', $salon_id)->get();
        $users = User::where([['status', 1], ['role', 3]])->get();
        $emps = Employee::where([['status', 1], ['salon_id', $salon_id]])->get();

        return view('admin.booking.create', compact('services', 'users', 'emps'));
    }

    // public function paymentcount(Request $request)
    // {
    //     $data['price'] = Service::whereIn('service_id', $request->ser_id)->sum('price');
    //     $data['time'] = Service::whereIn('service_id', $request->ser_id)->sum('time');

    //     return response()->json(['success' => true, 'data' => $data, 'msg' => 'Single Service'], 200);
    // }
    public function paymentcount(Request $request)
    {
        $data['price'] = Service::where('service_id', $request->ser_id)->sum('price');
        $data['time'] = Service::where('service_id', $request->ser_id)->sum('time');

        return response()->json(['success' => true, 'data' => $data, 'msg' => 'Single Service'], 200);
    }

    public function getPaymentCountZone(Request $request)
    {
        $data['price'] = Service::whereIn('service_id', $request->zone_id)->sum('price');
        $data['time'] = Service::whereIn('service_id', $request->zone_id)->sum('time');
        if ($request->zone_id == null) {
            $data['price'] = 0;
            $data['time'] = 0;
        }
        return response()->json(['success' => true, 'data' => $data, 'msg' => 'Single Service'], 200);
    }

    public function timeslot(Request $request)
    {

        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $master = array();
        $day = strtolower(Carbon::parse($request->date)->format('l'));

        $salon = Salon::find($salon->salon_id)->$day;
        $start_time = new Carbon($request['date'] . ' ' . $salon['open']);


        $end_time = new Carbon($request['date'] . ' ' . $salon['close']);
        $diff_in_minutes = $start_time->diffInMinutes($end_time);
        for ($i = 0; $i <= $diff_in_minutes; $i += 30) {

            if ($start_time >= $end_time) {

                break;
            } else {

                $temp['start_time'] = $start_time->format('h:i A');
                $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');



                array_push($master, $temp);

                // $temp['start_time'] = $start_time->format('h:i A');
                // $temp['end_time'] = $start_time->addMinutes('30')->format('h:i A');

                // if ($request->date == date('Y-m-d')) {
                //     if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                //         array_push($master, $temp);

                //     }
                // } else {
                //     array_push($master, $temp);

            }
        }


        if (count($master) == 0) {
            return response()->json(['msg' => 'Day off',  'success' => false], 200);
        } else {
            return response()->json(['msg' => 'Time slots', 'data' => $master, 'success' => true], 200);
        }
    }

    // public function selectemployee(Request $request)
    // {
    //     $salon = Salon::where('owner_id', Auth()->user()->id)->first();

    //     $emp_array = array();
    //     $emps_all = Employee::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
    //     $book_service = $request->service;

    //     $duration = Service::whereIn('service_id', $book_service)->sum('time') - 1;
    //     foreach ($emps_all as $emp) {
    //         $emp_service = json_decode($emp->service_id);
    //         foreach ($book_service as $ser) {
    //             if (in_array($ser, $emp_service)) {
    //                 array_push($emp_array, $emp->emp_id);
    //             }
    //         }
    //     }
    //     $master =  array();
    //     $emps = Employee::whereIn('emp_id', $emp_array)->get();

    //     $time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //     $day = strtolower(Carbon::parse($request->date)->format('l'));
    //     $date = $request->date;

    //     foreach ($emps as $emp) {
    //         $employee = $emp->$day;
    //         $start_time = new Carbon($request['date'] . ' ' . $employee['open']);
    //         $end_time = new Carbon($request['date'] . ' ' . $employee['close']);
    //         $end_time = $end_time->subMinutes(1);

    //         if ($time->between($start_time, $end_time)) {
    //             array_push($master, $emp);
    //         }
    //     }

    //     $emps_final = array();
    //     $booking_start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //     $booking_end_time = $booking_start_time->addMinutes($duration)->format('h:i A');

    //     $booking_start_time = \DateTime::createFromFormat('H:i a', $request['start_time']);
    //     $booking_end_time =  \DateTime::createFromFormat('H:i a', $booking_end_time);
    //     foreach ($master as $emp) {
    //         $booking = Booking::where([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Approved']])
    //             ->orWhere([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Pending']])
    //             ->get();
    //         $emp->push = 1;
    //         foreach ($booking as $book) {
    //             $start = \DateTime::createFromFormat('H:i a', $book->start_time);
    //             $end = \DateTime::createFromFormat('H:i a', $book->end_time);
    //             $end->modify('-1 minute');

    //             if ($booking_start_time >= $start && $booking_start_time <= $end) {
    //                 $emp->push = 0;
    //                 break;
    //             }
    //             if ($booking_end_time >= $start && $booking_end_time <= $end) {
    //                 $emp->push = 0;
    //                 break;
    //             }
    //         }
    //         if ($emp->push == 1)
    //             array_push($emps_final, $emp);
    //     }
    //     $new = array();
    //     foreach ($emps_final as $emp) {
    //         array_push($new, $emp->emp_id);
    //     }
    //     $emps_final_1 = Employee::whereIn('emp_id', $new)->get();
    //     if (count($emps_final_1) > 0) {
    //         return response()->json(['msg' => 'Employees', 'data' => $emps_final_1, 'success' => true], 200);
    //     } else {
    //         return response()->json(['msg' => 'No employee available at this time', 'success' => false], 200);
    //     }
    // }

    // public function selectRoom(Request $request)
    // {
    //     $salon = Salon::where('owner_id', Auth()->user()->id)->first();

    //     $emp_array = array();
    //     $emps_all = Room::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
    //     $book_service = $request->service;

    //     $duration = Service::whereIn('service_id', $book_service)->sum('time') - 1;
    //     foreach ($emps_all as $emp) {
    //         $emp_service = json_decode($emp->service_id);
    //         foreach ($book_service as $ser) {
    //             if (in_array($ser, $emp_service)) {
    //                 array_push($emp_array, $emp->room_id);
    //             }
    //         }
    //     }

    //     $master =  array();
    //     $emps = Room::whereIn('room_id', $emp_array)->get();


    //     $time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //     $day = strtolower(Carbon::parse($request->date)->format('l'));
    //     $date = $request->date;

    //     foreach ($emps as $emp) {
    //         $employee = $emp->$day;
    //         $start_time = new Carbon($request['date'] . ' ' . $employee['open']);
    //         $end_time = new Carbon($request['date'] . ' ' . $employee['close']);
    //         $end_time = $end_time->subMinutes(1);

    //         if ($time->between($start_time, $end_time)) {
    //             array_push($master, $emp);
    //         }
    //     }

    //     $emps_final = array();
    //     $booking_start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //     $booking_end_time = $booking_start_time->addMinutes($duration)->format('h:i A');

    //     $booking_start_time = \DateTime::createFromFormat('H:i a', $request['start_time']);
    //     $booking_end_time =  \DateTime::createFromFormat('H:i a', $booking_end_time);
    //     foreach ($master as $emp) {
    //         $booking = Booking::where([['room_id', $emp->room_id], ['date', $date], ['booking_status', 'Approved']])
    //             ->orWhere([['room_id', $emp->room_id], ['date', $date], ['booking_status', 'Pending']])
    //             ->get();
    //         $emp->push = 1;
    //         foreach ($booking as $book) {
    //             $start = \DateTime::createFromFormat('H:i a', $book->start_time);
    //             $end = \DateTime::createFromFormat('H:i a', $book->end_time);
    //             $end->modify('-1 minute');

    //             if ($booking_start_time >= $start && $booking_start_time <= $end) {
    //                 $emp->push = 0;
    //                 break;
    //             }
    //             if ($booking_end_time >= $start && $booking_end_time <= $end) {
    //                 $emp->push = 0;
    //                 break;
    //             }
    //         }
    //         if ($emp->push == 1)
    //             array_push($emps_final, $emp);
    //     }
    //     $new = array();
    //     foreach ($emps_final as $emp) {
    //         array_push($new, $emp->room_id);
    //     }
    //     $emps_final_1 = Room::whereIn('room_id', $new)->get();
    //     if (count($emps_final_1) > 0) {
    //         return response()->json(['msg' => 'Employees', 'data' => $emps_final_1, 'success' => true], 200);
    //     } else {
    //         return response()->json(['msg' => 'No employee available at this time', 'success' => false], 200);
    //     }
    // }

    public function selectemployee(Request $request)
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $emp_array = array();
        $emps_all = Employee::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
        $book_service = $request->service;

        $duration = Service::where('service_id', $book_service)->sum('time') - 1;



        foreach ($emps_all as $emp) {
            $emp_service = json_decode($emp->service_id);

            // Assuming $book_service is not an array, and is a single service ID
            if (in_array($book_service, $emp_service)) {
                $emp_array[] = $emp->emp_id;
            }
        }

        $master =  array();
        $emps = Employee::whereIn('emp_id', $emp_array)->get();

        $time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $day = strtolower(Carbon::parse($request->date)->format('l'));
        $date = $request->date;

        foreach ($emps as $emp) {
            $employee = $emp->$day;
            $start_time = new Carbon($request['date'] . ' ' . $employee['open']);
            $end_time = new Carbon($request['date'] . ' ' . $employee['close']);
            $end_time = $end_time->subMinutes(1);

            if ($time->between($start_time, $end_time)) {
                array_push($master, $emp);
            }
        }

        $emps_final = array();
        $booking_start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $booking_end_time = $booking_start_time->addMinutes($duration)->format('h:i A');

        $booking_start_time = \DateTime::createFromFormat('H:i a', $request['start_time']);
        $booking_end_time =  \DateTime::createFromFormat('H:i a', $booking_end_time);
        foreach ($master as $emp) {
            $booking = Booking::where([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Approved']])
                ->orWhere([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Pending']])
                ->orWhere([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Réservée']])
                ->get();
            $emp->push = 1;
            foreach ($booking as $book) {
                $start = \DateTime::createFromFormat('H:i a', $book->start_time);
                $end = \DateTime::createFromFormat('H:i a', $book->end_time);
                $end->modify('-1 minute');

                if ($booking_start_time >= $start && $booking_start_time <= $end) {
                    $emp->push = 0;
                    break;
                }
                if ($booking_end_time >= $start && $booking_end_time <= $end) {
                    $emp->push = 0;
                    break;
                }
            }
            if ($emp->push == 1)
                array_push($emps_final, $emp);
        }
        $new = array();
        foreach ($emps_final as $emp) {
            array_push($new, $emp->emp_id);
        }
        $emps_final_1 = Employee::whereIn('emp_id', $new)->get();
        if (count($emps_final_1) > 0) {
            return response()->json(['msg' => 'Employees', 'data' => $emps_final_1, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'No employee available at this time', 'success' => false], 200);
        }
    }

    public function selectRoom(Request $request)
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $emp_array = array();
        $emps_all = Room::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
        $book_service = $request->service;

        $duration = Service::where('service_id', $book_service)->sum('time') - 1;
        foreach ($emps_all as $emp) {
            $emp_service = json_decode($emp->service_id);

            // Assuming $book_service is not an array, and is a single service ID
            if (in_array($book_service, $emp_service)) {
                $emp_array[] = $emp->room_id;
            }
        }

        $master =  array();
        $emps = Room::whereIn('room_id', $emp_array)->get();


        $time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $day = strtolower(Carbon::parse($request->date)->format('l'));
        $date = $request->date;

        foreach ($emps as $emp) {
            $employee = $emp->$day;
            $start_time = new Carbon($request['date'] . ' ' . $employee['open']);
            $end_time = new Carbon($request['date'] . ' ' . $employee['close']);
            $end_time = $end_time->subMinutes(1);

            if ($time->between($start_time, $end_time)) {
                array_push($master, $emp);
            }
        }

        $emps_final = array();
        $booking_start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $booking_end_time = $booking_start_time->addMinutes($duration)->format('h:i A');


        $booking_start_time = \DateTime::createFromFormat('H:i a', $request['start_time']);
        $booking_end_time =  \DateTime::createFromFormat('H:i a', $booking_end_time);

        foreach ($master as $emp) {
            $booking = Booking::where([['room_id', $emp->room_id], ['date', $date], ['booking_status', 'Approved']])
                ->orWhere([['room_id', $emp->room_id], ['date', $date], ['booking_status', 'Pending']])
                ->orWhere([['room_id', $emp->room_id], ['date', $date], ['booking_status', 'Réservée']])
                ->get();
            $emp->push = 1;
            foreach ($booking as $book) {
                $start = \DateTime::createFromFormat('H:i a', $book->start_time);
                $end = \DateTime::createFromFormat('H:i a', $book->end_time);
                $end->modify('-1 minute');

                if ($booking_start_time >= $start && $booking_start_time <= $end) {
                    $emp->push = 0;
                    break;
                }
                if ($booking_end_time >= $start && $booking_end_time <= $end) {
                    $emp->push = 0;
                    break;
                }
            }
            if ($emp->push == 1)
                array_push($emps_final, $emp);
        }
        $new = array();
        foreach ($emps_final as $emp) {
            array_push($new, $emp->room_id);
        }
        $emps_final_1 = Room::whereIn('room_id', $new)->get();
        if (count($emps_final_1) > 0) {
            return response()->json(['msg' => 'Employees', 'data' => $emps_final_1, 'success' => true], 200);
        } else {
            return response()->json(['msg' => 'No employee available at this time', 'success' => false], 200);
        }
    }

    public function empAvilable($services, $start_time, $date)
    {




        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $emp_array = array();
        $emps_all = Employee::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
        $book_service = $services;



        $number = json_decode($book_service)[0];




        $duration = Service::where('service_id', $number)->sum('time') - 1;


        foreach ($emps_all as $emp) {
            $emp_service = json_decode($emp->service_id);

            // Assuming $book_service is not an array, and is a single service ID
            if (in_array($number, $emp_service)) {
                $emp_array[] = $emp->emp_id;
            }
        }

        $master =  array();
        $emps = Employee::whereIn('emp_id', $emp_array)->get();
        $time = new Carbon($date . ' ' . $start_time);
        $day = strtolower(Carbon::parse($date)->format('l'));
        $date = $date;

        foreach ($emps as $emp) {
            $employee = $emp->$day;
            $start_time = new Carbon($date . ' ' . $employee['open']);
            $end_time = new Carbon($date . ' ' . $employee['close']);
            $end_time = $end_time->subMinutes(1);
            if ($time->between($start_time, $end_time)) {
                array_push($master, $emp);
            }
        }

        $emps_final = array();
        $booking_start_time = new Carbon($date . ' ' . $time->toTimeString());


        $formated_start_time = $booking_start_time->format('h:i A');


        $booking_end_time = $booking_start_time->addMinutes($duration)->format('h:i A');


        $booking_start_time = \DateTime::createFromFormat('H:i a', $formated_start_time);

        $booking_end_time =  \DateTime::createFromFormat('H:i a', $booking_end_time);



        foreach ($master as $emp) {
            $booking = Booking::where([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Approved']])
                ->orWhere([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Pending']])
                ->orWhere([['emp_id', $emp->emp_id], ['date', $date], ['booking_status', 'Réservée']])
                ->get();


            $emp->push = 1;
            foreach ($booking as $book) {
                $start = \DateTime::createFromFormat('H:i a', $book->start_time);
                $end = \DateTime::createFromFormat('H:i a', $book->end_time);
                $end->modify('-1 minute');

                if ($booking_start_time >= $start && $booking_start_time <= $end) {
                    $emp->push = 0;
                    break;
                }
                if ($booking_end_time >= $start && $booking_end_time <= $end) {
                    $emp->push = 0;
                    break;
                }
            }
            if ($emp->push == 1)
                array_push($emps_final, $emp);
        };




        $new = array();
        foreach ($emps_final as $emp) {
            array_push($new, $emp->emp_id);
        }
        $emps_final_1 = Employee::whereIn('emp_id', $new)->get();




        return $emps_final_1;
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'bail|required',
            'user_id' => 'bail|required',
            'service_id' => 'bail|required',
            'date' => 'bail|required',
            'start_time' => 'bail|required',
            'payment' => 'bail|required|numeric',
            'emp_id' => 'bail|required',
            'room_id' => 'bail|required'
        ]);

        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $random = rand(100, 999);

        // $services =  str_replace('"', '', json_encode($request->service_id));



        $servicesArray = json_decode(str_replace('"', '', json_encode($request->service_id)), true);


        if ($request->zone_id == null) {
            $zoneArray = [];
        } else {
            $zoneArray = json_decode(str_replace('"', '', json_encode($request->zone_id)), true);
        }


        $mergedArray = array_merge($servicesArray, $zoneArray);

        // If you need to encode the merged array back into JSON
        $mergedJson = json_encode($mergedArray);


        $theErrorBooking = [];
        $duration = Service::whereIn('service_id', $mergedArray)->sum('time');




        $newDate = $request->date;

        for ($i = 0; $i < $request->nbs; $i++) {
            $booking = new Booking();
            $booking->service_id = $mergedJson;

            $booking->zone_id;
            $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
            $new_start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
            $booking->end_time = $start_time->addMinutes($duration)->format('h:i A');

            $booking->salon_id = $salon->salon_id;
            $booking->emp_id = $request->emp_id;
            $booking->room_id = $request->room_id;
            $booking->payment = $request->payment;
            $booking->start_time = $request->start_time;

            if ($i == 0) {

                $booking->date = $request->date;
                $booking->is_repeat = 1;
            } else {

                if ($request->frequency == 'Day') {

                    $newDate = date('Y-m-d', strtotime($newDate . ' +' . $request->frequency_nb . ' day'));

                    $day = strtolower(Carbon::parse($newDate)->format('l'));
                    $s = Salon::find($salon->salon_id)->$day;
                    $end_timee = new Carbon($newDate . ' ' . $s['close']);
                    $end_timee = $end_timee->format('h:i A');

                    $ee = $this->empAvilable($mergedJson, $request->start_time, $newDate);
                    $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                    if (!$employeeWithId) {
                        while (!$employeeWithId) {

                            if (Carbon::parse($start_time) == $end_timee || $end_timee == '12:00 AM') {
                                //add day to new date

                                $newDate = date('Y-m-d', strtotime($newDate . ' +1 day'));
                                $ee = $this->empAvilable($mergedJson, $request->start_time, $newDate);
                                $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                                if ($employeeWithId) {
                                    $booking->start_time = Carbon::parse($request->start_time)->format('h:i A');
                                    $booking->end_time = Carbon::parse($request->start_time)->addMinutes($duration)->format('h:i A');
                                    $booking->date = $newDate;
                                    $booking->is_repeat = 0;
                                } else {
                                    // reset end time
                                    $day = strtolower(Carbon::parse($newDate)->format('l'));
                                    $s = Salon::find($salon->salon_id)->$day;


                                    $aa = new Carbon($newDate . ' ' . $s['close']);
                                    $end_timee = $aa->format('h:i A');

                                    $employeeWithId = false;
                                }
                            } else {

                                $newStartTime = Carbon::parse($new_start_time)->addMinutes(30)->format('h:i A');
                                $ee = $this->empAvilable($mergedJson, $newStartTime, $newDate);
                                $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                                if ($employeeWithId) {
                                    $booking->start_time = Carbon::parse($newStartTime)->format('h:i A');
                                    $booking->end_time = Carbon::parse($newStartTime)->addMinutes($duration)->format('h:i A');
                                    $booking->date = $newDate;
                                    $booking->is_repeat = 0;
                                } else {
                                    // Restart the while loop
                                    $employeeWithId = false;
                                    $new_start_time = Carbon::parse($new_start_time)->addMinutes(30)->format('h:i A');
                                }
                            }
                        }
                    } else {
                        $booking->start_time = Carbon::parse($request->start_time)->format('h:i A');
                        $booking->end_time = Carbon::parse($request->start_time)->addMinutes($duration)->format('h:i A');
                        $booking->date = $newDate;
                        $booking->is_repeat = 0;
                    }
                } else if ($request->frequency == 'Week') {
                    $newDate = date('Y-m-d', strtotime($newDate . ' +' . $request->frequency_nb . ' week'));
                    $day = strtolower(Carbon::parse($newDate)->format('l'));
                    $s = Salon::find($salon->salon_id)->$day;
                    $end_timee = new Carbon($newDate . ' ' . $s['close']);
                    $end_timee = $end_timee->format('h:i A');





                    $ee = $this->empAvilable($mergedJson, $request->start_time, $newDate);
                    $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                    if (!$employeeWithId) {
                        while (!$employeeWithId) {

                            if (Carbon::parse($start_time) == $end_timee || $end_timee == '12:00 AM') {
                                //add day to new date

                                $newDate = date('Y-m-d', strtotime($newDate . ' +1 day'));
                                $ee = $this->empAvilable($mergedJson, $request->start_time, $newDate);
                                $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                                if ($employeeWithId) {
                                    $booking->start_time = Carbon::parse($request->start_time)->format('h:i A');
                                    $booking->end_time = Carbon::parse($request->start_time)->addMinutes($duration)->format('h:i A');
                                    $booking->date = $newDate;
                                    $booking->is_repeat = 0;
                                } else {
                                    // reset end time
                                    $day = strtolower(Carbon::parse($newDate)->format('l'));
                                    $s = Salon::find($salon->salon_id)->$day;


                                    $aa = new Carbon($newDate . ' ' . $s['close']);
                                    $end_timee = $aa->format('h:i A');

                                    $employeeWithId = false;
                                }
                            } else {

                                $newStartTime = Carbon::parse($new_start_time)->addMinutes(30)->format('h:i A');
                                $ee = $this->empAvilable($mergedJson, $newStartTime, $newDate);
                                $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                                if ($employeeWithId) {
                                    $booking->start_time = Carbon::parse($newStartTime)->format('h:i A');
                                    $booking->end_time = Carbon::parse($newStartTime)->addMinutes($duration)->format('h:i A');
                                    $booking->date = $newDate;
                                    $booking->is_repeat = 0;
                                } else {
                                    // Restart the while loop
                                    $employeeWithId = false;
                                    $new_start_time = Carbon::parse($new_start_time)->addMinutes(30)->format('h:i A');
                                }
                            }
                        }
                    } else {
                        $booking->start_time = Carbon::parse($request->start_time)->format('h:i A');
                        $booking->end_time = Carbon::parse($request->start_time)->addMinutes($duration)->format('h:i A');
                        $booking->date = $newDate;
                        $booking->is_repeat = 0;
                    }
                } else if ($request->frequency == "Month") {
                    $newDate = date('Y-m-d', strtotime($newDate . ' +' . $request->frequency_nb . ' month'));
                    $day = strtolower(Carbon::parse($newDate)->format('l'));
                    $s = Salon::find($salon->salon_id)->$day;
                    $end_timee = new Carbon($newDate . ' ' . $s['close']);
                    $end_timee = $end_timee->format('h:i A');





                    $ee = $this->empAvilable($mergedJson, $request->start_time, $newDate);
                    $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                    if (!$employeeWithId) {
                        while (!$employeeWithId) {

                            if (Carbon::parse($start_time) == $end_timee || $end_timee == '12:00 AM') {
                                //add day to new date

                                $newDate = date('Y-m-d', strtotime($newDate . ' +1 day'));
                                $ee = $this->empAvilable($mergedJson, $request->start_time, $newDate);
                                $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                                if ($employeeWithId) {
                                    $booking->start_time = Carbon::parse($request->start_time)->format('h:i A');
                                    $booking->end_time = Carbon::parse($request->start_time)->addMinutes($duration)->format('h:i A');
                                    $booking->date = $newDate;
                                    $booking->is_repeat = 0;
                                } else {
                                    // reset end time
                                    $day = strtolower(Carbon::parse($newDate)->format('l'));
                                    $s = Salon::find($salon->salon_id)->$day;


                                    $aa = new Carbon($newDate . ' ' . $s['close']);
                                    $end_timee = $aa->format('h:i A');

                                    $employeeWithId = false;
                                }
                            } else {

                                $newStartTime = Carbon::parse($new_start_time)->addMinutes(30)->format('h:i A');
                                $ee = $this->empAvilable($mergedJson, $newStartTime, $newDate);
                                $employeeWithId = $ee->contains('emp_id', $request->emp_id);

                                if ($employeeWithId) {
                                    $booking->start_time = Carbon::parse($newStartTime)->format('h:i A');
                                    $booking->end_time = Carbon::parse($newStartTime)->addMinutes($duration)->format('h:i A');
                                    $booking->date = $newDate;
                                    $booking->is_repeat = 0;
                                } else {
                                    // Restart the while loop
                                    $employeeWithId = false;
                                    $new_start_time = Carbon::parse($new_start_time)->addMinutes(30)->format('h:i A');
                                }
                            }
                        }
                    } else {
                        $booking->start_time = Carbon::parse($request->start_time)->format('h:i A');
                        $booking->end_time = Carbon::parse($request->start_time)->addMinutes($duration)->format('h:i A');
                        $booking->date = $newDate;
                        $booking->is_repeat = 0;
                    }
                }
            }
            $booking->payment_type = "LOCAL";
            $booking->booking_status = "Réservée";
            $booking->user_id = $request->user_id;
            $booking->NBS = $request->nbs;
            $booking->frequency = $request->frequency;
            $booking->frequency_nb = $request->frequency_nb;


            $booking->created_by = Auth()->user()->name;



            $booking->booking_id = $request->booking_id . '_' . $random;



            $booking->save();
        }
        return redirect()->back()->with('success', 'Booking created successfully');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'booking_id' => 'bail|required',
    //         'user_id' => 'bail|required',
    //         'service_id' => 'bail|required',
    //         'date' => 'bail|required',
    //         'start_time' => 'bail|required',
    //         'payment' => 'bail|required|numeric',
    //         'emp_id' => 'bail|required',
    //         'room_id' => 'bail|required'
    //     ]);

    //     $salon = Salon::where('owner_id', Auth()->user()->id)->first();


    //     $random = rand(100, 999);

    //     $services =  str_replace('"', '', json_encode($request->service_id));
    //     $theErrorBooking = [];
    //     $duration = Service::whereIn('service_id', $request->service_id)->sum('time');
    //     $newDate = $request->date;
    //     for ($i = 0; $i < $request->nbs; $i++) {
    //         $booking = new Booking();
    //         $booking->service_id = $services;
    //         $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //         $booking->end_time = $start_time->addMinutes($duration)->format('h:i A');
    //         $booking->salon_id = $salon->salon_id;
    //         $booking->emp_id = $request->emp_id;
    //         $booking->room_id = $request->room_id;
    //         $booking->payment = $request->payment;
    //         $booking->start_time = $request->start_time;

    //         if ($i == 0) {
    //             $booking->date = $request->date;
    //             $booking->is_repeat = 1;
    //         } else {
    //             if ($request->frequency == 'Day') {
    //                 $newDate = date('Y-m-d', strtotime($newDate . ' +' . $request->frequency_nb . ' day'));

    //                 $day = strtolower(Carbon::parse($newDate)->format('l'));
    //                 $s = Salon::find($salon->salon_id)->$day;
    //                 $end_timee = new Carbon($newDate . ' ' . $s['close']);
    //                 $end_timee = $end_timee->format('h:i A');
    //                 $ee = $this->empAvilable($services, $request->start_time, $newDate);

    //                 $employeeWithId = $ee->contains('emp_id', $request->emp_id);


    //                 if ($employeeWithId == false) {
    //                     //push the error to the array
    //                     array_push($theErrorBooking,  [
    //                         'service_id' => $services,
    //                         'start_time' => $start_time,
    //                         'date' => $newDate,
    //                     ]);
    //                     $start_time = Carbon::parse($start_time)->format('h:i A');

    //                     while (!$employeeWithId) {
    //                         $start_time = Carbon::parse($start_time)->addMinutes(30)->format('h:i A');

    //                         $ee = $this->empAvilable($services, $start_time, $newDate);

    //                         if (Carbon::parse($start_time) == $end_timee || $end_timee == '12:00 AM') {
    //                             // Extract the time portion from $request['start_time']
    //                             dd('r');
    //                             $newDate = date('Y-m-d', strtotime($newDate . ' +' . 1 . ' day'));
    //                             $start_time = Carbon::parse($request->start_time)->format('h:i A');
    //                             $eee = $this->empAvilable($services, $request->start_time, $newDate);
    //                             $employeeWithId = $eee->contains('emp_id', $request->emp_id);
    //                             $end_timee = $start_time;
    //                             if ($employeeWithId) {
    //                                 $booking->start_time = Carbon::parse($start_time)->format('h:i A');
    //                                 $booking->end_time = Carbon::parse($start_time)->addMinutes($duration)->format('h:i A');
    //                                 $booking->date = $newDate;
    //                                 $booking->is_repeat = 0;
    //                             } else {
    //                                 // Restart the while loop
    //                                 $employeeWithId = false;
    //                                 return;
    //                             }
    //                         } else {
    //                             dd($ee);
    //                             $employeeWithId = $ee->contains('emp_id', $request->emp_id);
    //                             if ($employeeWithId) {
    //                                 $booking->start_time = Carbon::parse($start_time)->format('h:i A');
    //                                 $booking->end_time = Carbon::parse($start_time)->addMinutes($duration)->format('h:i A');
    //                                 $booking->date = $newDate;
    //                                 $booking->is_repeat = 0;
    //                             } else {
    //                                 dd($start_time);
    //                                 $start_time = Carbon::parse($start_time)->addMinutes(30)->format('h:i A');
    //                             }
    //                         }
    //                     }
    //                 } else {
    //                     $booking->date = $newDate;
    //                     $booking->is_repeat = 0;
    //                 }
    //             } else if ($request->frequency == 'Week') {

    //                 $newDate = date('Y-m-d', strtotime($newDate . ' +' . $request->frequency_nb . 'week'));



    //                 $ee = $this->empAvilable($services, $request->start_time, $newDate);
    //                 $employeeWithId = $ee->contains('emp_id', $request->emp_id);
    //                 if ($employeeWithId == false) {
    //                     //push the error to the array
    //                     array_push($theErrorBooking,  [
    //                         'service_id' => $services,
    //                         'start_time' => $start_time,
    //                         'date' => $newDate,
    //                     ]);
    //                     $start_time = Carbon::parse($start_time)->format('h:i A');



    //                     while (!$employeeWithId) {


    //                         $ee = $this->empAvilable($services, $start_time, $newDate);


    //                         if (Carbon::parse($start_time) == (Carbon::parse('04:00 PM'))) {


    //                             // Extract the time portion from $request['start_time']
    //                             $newDate = date('Y-m-d', strtotime($newDate . ' +' . 1 . ' day'));
    //                             $start_time = Carbon::parse($request->start_time)->format('h:i A');
    //                             $eee = $this->empAvilable($services, $request->start_time, $newDate);
    //                             $employeeWithId = $eee->contains('emp_id', $request->emp_id);

    //                             if ($employeeWithId) {

    //                                 $booking->start_time = Carbon::parse($start_time)->format('h:i A');

    //                                 $booking->end_time = Carbon::parse($start_time)->addMinutes($duration)->format('h:i A');
    //                                 $booking->date = $newDate;
    //                                 $booking->is_repeat = 0;
    //                             } else {
    //                                 $employeeWithId = false;
    //                             }
    //                         } else {
    //                             $start_time = Carbon::parse($start_time)->addMinutes(30)->format('h:i A');
    //                             $employeeWithId = $ee->contains('emp_id', $request->emp_id);
    //                             if ($employeeWithId) {

    //                                 $booking->start_time = Carbon::parse($start_time)->format('h:i A');

    //                                 $booking->end_time = Carbon::parse($start_time)->addMinutes($duration)->format('h:i A');
    //                                 $booking->date = $newDate;
    //                                 $booking->is_repeat = 0;
    //                             } else {
    //                                 $employeeWithId = false;
    //                             }
    //                         }
    //                     }
    //                 } else {
    //                     $booking->date = $newDate;
    //                     $booking->is_repeat = 0;
    //                 }
    //             } else if ($request->frequency == 'Month') {
    //                 $newDate = date('Y-m-d', strtotime($newDate . ' +' . $request->frequency_nb . 'month'));
    //                 $ee = $this->empAvilable($services, $request->start_time, $newDate);

    //                 $employeeWithId = $ee->contains('emp_id', $request->emp_id);
    //                 if ($employeeWithId == false) {
    //                     //push the error to the array
    //                     array_push($theErrorBooking,  [
    //                         'service_id' => $services,
    //                         'start_time' => $start_time,
    //                         'date' => $newDate,
    //                     ]);
    //                     $start_time = Carbon::parse($start_time)->format('h:i A');



    //                     while (!$employeeWithId) {


    //                         $ee = $this->empAvilable($services, $start_time, $newDate);


    //                         if (Carbon::parse($start_time) == (Carbon::parse('04:00 PM'))) {


    //                             // Extract the time portion from $request['start_time']
    //                             $newDate = date('Y-m-d', strtotime($newDate . ' +' . 1 . ' day'));
    //                             $start_time = Carbon::parse($request->start_time)->format('h:i A');
    //                             $eee = $this->empAvilable($services, $request->start_time, $newDate);
    //                             $employeeWithId = $eee->contains('emp_id', $request->emp_id);

    //                             if ($employeeWithId) {

    //                                 $booking->start_time = Carbon::parse($start_time)->format('h:i A');

    //                                 $booking->end_time = Carbon::parse($start_time)->addMinutes($duration)->format('h:i A');
    //                                 $booking->date = $newDate;
    //                                 $booking->is_repeat = 0;
    //                             } else {
    //                                 $employeeWithId = false;
    //                             }
    //                         } else {
    //                             $start_time = Carbon::parse($start_time)->addMinutes(30)->format('h:i A');
    //                             $employeeWithId = $ee->contains('emp_id', $request->emp_id);
    //                             if ($employeeWithId) {

    //                                 $booking->start_time = Carbon::parse($start_time)->format('h:i A');

    //                                 $booking->end_time = Carbon::parse($start_time)->addMinutes($duration)->format('h:i A');
    //                                 $booking->date = $newDate;
    //                                 $booking->is_repeat = 0;
    //                             } else {
    //                                 $employeeWithId = false;
    //                             }
    //                         }
    //                     }
    //                 } else {
    //                     $booking->date = $newDate;
    //                     $booking->is_repeat = 0;
    //                 }
    //             }
    //         }





    //         $booking->payment_type = "LOCAL";
    //         $booking->booking_status = "Réservée";
    //         $booking->user_id = $request->user_id;
    //         $booking->NBS = $request->nbs;
    //         $booking->frequency = $request->frequency;
    //         $booking->frequency_nb = $request->frequency_nb;


    //         $booking->created_by = Auth()->user()->name;



    //         $booking->booking_id = $request->booking_id . '_' . $random;



    //         $booking->save();
    //     }



    //     $create_appointment = Template::where('title', 'Create Appointment')->first();

    //     $not = new Notification();
    //     $not->booking_id = $booking->id;
    //     $not->user_id = $booking->user_id;
    //     $not->title = $create_appointment->subject;

    //     $detail['UserName'] = $booking->user->name;
    //     $detail['Date'] = $booking->date;
    //     $detail['Time'] = $booking->start_time;
    //     $detail['BookingId'] = $booking->booking_id;
    //     $detail['SalonName'] = $booking->salon->name;
    //     $detail['AdminName'] = AdminSetting::first()->app_name;

    //     $data = ["{{UserName}}", "{{Date}}", "{{Time}}", "{{BookingId}}", "{{SalonName}}"];
    //     $message = str_replace($data, $detail, $create_appointment->msg_content);
    //     $not->msg = $message;
    //     $not->save();

    //     $mail_enable = AdminSetting::first()->mail;
    //     $notification_enable = AdminSetting::first()->notification;

    //     if ($mail_enable == 1) {
    //         try {
    //             Mail::to($booking->user->email)->send(new CreateAppointment($create_appointment->mail_content, $detail));
    //         } catch (\Throwable $th) {
    //         }
    //     }
    //     if ($notification_enable == 1 && $booking->user->device_token != null) {
    //         try {
    //             OneSignal::sendNotificationToUser(
    //                 $message,
    //                 $booking->user->device_token,
    //                 $url = null,
    //                 $data = null,
    //                 $buttons = null,
    //                 $schedule = null,
    //                 $create_appointment->subject
    //             );
    //         } catch (\Throwable $th) {
    //         }
    //     }

    //     //return response()->json(['msg' => 'Booking successfully', 'data' => $booking, 'success' => true], 200);

    //     //return redirect()->back()->with('success', 'Réservation créée avec succès');
    // }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'booking_id' => 'bail|required',
    //         'user_id' => 'bail|required',
    //         'service_id' => 'bail|required',
    //         'date' => 'bail|required',
    //         'start_time' => 'bail|required',
    //         'payment' => 'bail|required|numeric',
    //         'emp_id' => 'bail|required',
    //         'room_id' => 'bail|required'
    //     ]);

    //     $salon = Salon::where('owner_id', Auth()->user()->id)->first();
    //     $booking = new Booking();

    //     $services =  str_replace('"', '', json_encode($request->service_id));
    //     $booking->service_id = $services;
    //     $duration = Service::whereIn('service_id', $request->service_id)->sum('time');

    //     $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //     $booking->end_time = $start_time->addMinutes($duration)->format('h:i A');
    //     $booking->salon_id = $salon->salon_id;
    //     $booking->emp_id = $request->emp_id;
    //     $booking->room_id = $request->room_id;
    //     $booking->payment = $request->payment;
    //     $booking->start_time = $request->start_time;
    //     $booking->date = $request->date;
    //     $booking->payment_type = "LOCAL";
    //     $booking->booking_status = "Réservée";
    //     $booking->user_id = $request->user_id;
    //     $booking->booking_id = $request->booking_id;

    //     $booking->save();

    //     $create_appointment = Template::where('title', 'Create Appointment')->first();

    //     $not = new Notification();
    //     $not->booking_id = $booking->id;
    //     $not->user_id = $booking->user_id;
    //     $not->title = $create_appointment->subject;

    //     $detail['UserName'] = $booking->user->name;
    //     $detail['Date'] = $booking->date;
    //     $detail['Time'] = $booking->start_time;
    //     $detail['BookingId'] = $booking->booking_id;
    //     $detail['SalonName'] = $booking->salon->name;
    //     $detail['AdminName'] = AdminSetting::first()->app_name;

    //     $data = ["{{UserName}}", "{{Date}}", "{{Time}}", "{{BookingId}}", "{{SalonName}}"];
    //     $message = str_replace($data, $detail, $create_appointment->msg_content);
    //     $not->msg = $message;
    //     $not->save();

    //     $mail_enable = AdminSetting::first()->mail;
    //     $notification_enable = AdminSetting::first()->notification;

    //     if ($mail_enable == 1) {
    //         try {
    //             Mail::to($booking->user->email)->send(new CreateAppointment($create_appointment->mail_content, $detail));
    //         } catch (\Throwable $th) {
    //         }
    //     }
    //     if ($notification_enable == 1 && $booking->user->device_token != null) {
    //         try {
    //             OneSignal::sendNotificationToUser(
    //                 $message,
    //                 $booking->user->device_token,
    //                 $url = null,
    //                 $data = null,
    //                 $buttons = null,
    //                 $schedule = null,
    //                 $create_appointment->subject
    //             );
    //         } catch (\Throwable $th) {
    //         }
    //     }
    //     return response()->json(['msg' => 'Booking successfully', 'data' => $booking, 'success' => true], 200);
    // }





    public function show($id)
    {
        $data['booking'] = Booking::with('user')->find($id);
        $data['symbol'] = AdminSetting::find(1)->currency_symbol;
        return response()->json(['success' => true, 'data' => $data, 'msg' => 'Appointment show'], 200);
    }

    public function changeStatus(Request $request)
    {


        $booking = Booking::find($request->bookingId);
        $booking->booking_status = $request->status;

        if ($request->status == "Cancel") {
            $booking->whycancel = $request->whycancel;
            $booking->who_cancel = Auth()->user()->name;
            $booking->cancel_date = Carbon::now();
        } else {
            $booking->whycancel = '';
            $booking->who_cancel = '';
            $booking->cancel_date = '';
        }
        $booking->save();

        $user = User::find($booking->user_id);

        $booking_status = Template::where('title', 'Booking status')->first();

        $not = new Notification();
        $not->booking_id = $request->bookingId;
        $not->user_id = $booking->user_id;
        $not->title = $booking_status->subject;

        $detail['UserName'] = $booking->user->name;
        $detail['Date'] = $booking->date;
        $detail['Time'] = $booking->start_time;
        $detail['BookingId'] = $booking->booking_id;
        $detail['SalonName'] = $booking->salon->name;
        $detail['BookingStatus'] = $booking->booking_status;
        $detail['AdminName'] = AdminSetting::first()->app_name;

        $data = ["{{UserName}}", "{{Date}}", "{{Time}}", "{{BookingId}}", "{{SalonName}}", "{{BookingStatus}}"];
        $message = str_replace($data, $detail, $booking_status->msg_content);

        $not->msg = $message;
        $title = "Appointment " . $booking->booking_status;

        $not->save();
        $mail_enable = AdminSetting::first()->mail;
        $notification_enable = AdminSetting::first()->notification;

        if ($mail_enable) {
            try {
                Mail::to($booking->user->email)->send(new BookingStatus($booking_status->mail_content, $detail));
            } catch (\Throwable $th) {
            }
        }
        if ($notification_enable && $user->device_token != null) {
            try {
                OneSignal::sendNotificationToUser(
                    $message,
                    $user->device_token,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    $title
                );
            } catch (\Throwable $th) {
            }
        }
    }

    public function changePaymentStatus(Request $request)
    {
        // $booking = Booking::find($request->bookingId);
        // if ($booking->payment_status == 0) {
        //     $booking->payment_status = 1;
        //     $booking->save();

        //     $payment_status = Template::where('title', 'Payment status')->first();

        //     $not = new Notification();
        //     $not->booking_id = $request->bookingId;
        //     $not->user_id = $booking->user_id;
        //     $not->title = $payment_status->subject;

        //     $detail['UserName'] = $booking->user->name;
        //     $detail['Date'] = $booking->date;
        //     $detail['Time'] = $booking->start_time;
        //     $detail['BookingId'] = $booking->booking_id;
        //     $detail['SalonName'] = $booking->salon->name;
        //     $detail['Amount'] = $booking->payment;
        //     $detail['AdminName'] = AdminSetting::first()->app_name;

        //     $data = ["{{UserName}}", "{{Date}}", "{{Time}}", "{{BookingId}}", "{{SalonName}}", "{{Amount}}"];
        //     $message = str_replace($data, $detail, $payment_status->msg_content);

        //     $not->msg = $message;
        //     $not->save();

        //     $mail_enable = AdminSetting::first()->mail;
        //     $notification_enable = AdminSetting::first()->notification;

        //     if ($mail_enable) {
        //         try {
        //             Mail::to($booking->user->email)->send(new PaymentStatus($payment_status->mail_content, $detail));
        //         } catch (\Throwable $th) {
        //         }
        //     }
        //     if ($notification_enable && $booking->user->device_token != null) {
        //         try {
        //             OneSignal::sendNotificationToUser(
        //                 $message,
        //                 $booking->user->device_token,
        //                 $url = null,
        //                 $data = null,
        //                 $buttons = null,
        //                 $schedule = null,
        //                 "Payment Received"
        //             );
        //         } catch (\Throwable $th) {
        //         }
        //     }
        // } else if ($booking->payment_status == 1) {
        //     $booking->payment_status = 0;
        //     $booking->save();
        // }
    }


    public function edit($id)
    {
        $data['booking'] = Booking::with('user')->find($id);


        return response()->json(['success' => true, 'data' => $data, 'msg' => 'Appointment edit'], 200);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'booking_id' => 'bail|required',
            'user_id' => 'bail|required',
            'service_id' => 'bail|required',
            'date' => 'bail|required',
            'start_time' => 'bail|required',
            'payment' => 'bail|required|numeric',

        ]);


        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $booking = Booking::find($id);
        $start_time = new DateTime($booking->start_time);
        $end_time = new DateTime($booking->end_time);

        $duration = $end_time->diff($start_time);
        $duration_hours = $duration->h; // Extracts hours part from the difference
        $duration_minutes = $duration_hours * 60; // Convert hours to minutes
        $duration_minutes += $duration->i; // Add remaining minutes

        // This should output 90 if the start and end times are 14:30 and 16:00 respectively.

        // This will output 60 if the start and end times are 08:00 AM and 09:00 AM, respectively.



        // $services =  str_replace('"', '', json_encode($request->service_id));
        // $booking->service_id = $services;
        // $duration = Service::whereIn('service_id', $request->service_id)->sum('time');

        $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $booking->end_time = $start_time->addMinutes($duration_minutes)->format('h:i A');

        $booking->salon_id = $salon->salon_id;

        $booking->payment = $request->payment;
        $booking->start_time = $request->start_time;
        $booking->date = $request->date;
        $booking->payment_type = "LOCAL";
        $booking->booking_status = "Approved";
        $booking->user_id = $request->user_id;
        $booking->booking_id = $request->booking_id;

        if ($request->emp_id != null) {
            $booking->emp_id = $request->emp_id;
        }
        if ($request->room_id != null) {
            $booking->room_id = $request->room_id;
        }



        $booking->save();

        return redirect()->to('admin/booking')
            ->with('success', 'Réservation mise à jour avec succès');

        // return response()->json(['msg' => '
        // Réservation mise à jour avec succès', 'data' => $booking, 'success' => true], 200);
    }
    // public function update(Request $request, $id)
    // {

    //     $request->validate([
    //         'booking_id' => 'bail|required',
    //         'user_id' => 'bail|required',
    //         'service_id' => 'bail|required',
    //         'date' => 'bail|required',
    //         'start_time' => 'bail|required',
    //         'payment' => 'bail|required|numeric',

    //     ]);


    //     $salon = Salon::where('owner_id', Auth()->user()->id)->first();
    //     $booking = Booking::find($id);

    //     $services =  str_replace('"', '', json_encode($request->service_id));





    //     $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
    //     $booking->end_time = $start_time->addMinutes($)->format('h:i A');
    //     $booking->salon_id = $salon->salon_id;

    //     $booking->payment = $request->payment;
    //     $booking->start_time = $request->start_time;
    //     $booking->date = $request->date;
    //     $booking->payment_type = "LOCAL";
    //     $booking->booking_status = "Approved";
    //     $booking->user_id = $request->user_id;
    //     $booking->booking_id = $request->booking_id;

    //     if ($request->emp_id != null) {
    //         $booking->emp_id = $request->emp_id;
    //     }
    //     if ($request->room_id != null) {
    //         $booking->room_id = $request->room_id;
    //     }



    //     $booking->save();

    //     return response()->json(['msg' => '
    //     Réservation mise à jour avec succès', 'data' => $booking, 'success' => true], 200);
    // }

    public function destroy($id)
    {

        $booking = Booking::find($id);



        $bookings = Booking::where('booking_id', $booking->booking_id)->get();

        $gonnadelete = true;

        foreach ($bookings as $book) {
            if ($book->payment_status == 0) {
                $gonnadelete = false;
            } else {
                $gonnadelete = true;
            }
        }
        $isDeleted = false;
        if (!$gonnadelete) {
            foreach ($bookings as $book) {
                if ($book->delete()) {
                    $isDeleted = true;
                } else {
                    $isDeleted = false;
                }
            }
        }

        if ($isDeleted) {
            return redirect()->to('admin/booking')
                ->with('success', 'Réservation supprimée avec succès');
        } else {
            return redirect()->to('admin/booking')
                ->with('error', 'Tu ne peux pas supprimer cette réservation parce qu\'elle a déjà été payée');
        }
    }



    public function checkuser(Request $request)
    {
        $bookings = Booking::where('user_id', $request->user_id)->where('booking_status', 'Completed')->where('is_repeat', 1)->with('payments')->get();

        $sumOfPayments = 0;

        foreach ($bookings as $booking) {
            $sumOfPayments += $booking->payments->where('status', 0)->sum('amount');
        }

        $totalAmountToPay = $bookings->sum('payment'); // Assuming you have an 'amount' column in the Booking model

        $remainingAmountToPay = $totalAmountToPay - $sumOfPayments;

        return response()->json([
            'msg' => 'Remaining amount to pay successfully retrieved',
            'data' => [
                'total_amount_to_pay' => $totalAmountToPay,
                'sum_of_payments' => $sumOfPayments,
                'remaining_amount_to_pay' => $remainingAmountToPay,
                'id' => $request->user_id
            ],
            'success' => true
        ], 200);
    }

    public function store_user(Request $request)
    {

        //validation
        $request->validate([
            'name' => 'bail|required',
        ]);


        $salon = Salon::where('owner_id', Auth::user()->id)->first();
        $salon_id = $salon->salon_id;

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->code = "+" . $request->code;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->origine = $request->origin;


        $user->review = $request->review;

        $user->password = Hash::make($request->password);
        $user->added_by = $salon_id;
        $user->verify = 1;
        $user->save();

        return redirect()->to('admin/booking')
            ->with('success', 'Réservation ajoutée avec succès');
    }

    public function getServiceFrecuency(Request $request)
    {
        $data = [];
        $service_frecuency = Service::find($request->service_id)->frequency;
        $service_frecuency_nb = Service::find($request->service_id)->frequency_nb;
        $service_nbs = Service::find($request->service_id)->NBS;
        $data['NBS'] = $service_nbs;

        $data['service_frecuency'] = $service_frecuency;
        $data['service_frecuency_nb'] = $service_frecuency_nb;
        return response()->json([
            'msg' => 'Service frecuency successfully retrieved',
            'data' => $data,
            'success' => true
        ], 200);
    }

    public function listAppointment($booking_id)
    {

        return response()->json(['success' => true, 'data' => 1, 'msg' => 'Appointment list'], 200);
    }

    public function cancelBooking(Request $request)
    {
        //validation

        $request->validate([
            'whycancel' => 'bail|required',
        ]);

        $booking = Booking::find($request->booking_iddd);


        #
        $booking->whycancel = $request->whycancel;
        $booking->who_cancel = Auth::user()->name;
        $booking->cancel_date = Carbon::now();
        $booking->save();


        $request->merge(['bookingId' => $request->booking_iddd, 'status' => 'Cancel']);
        $this->changeStatus($request);
        return redirect()->to('admin/booking')
            ->with('success', 'Réservation annulée avec succès');
    }

    public function print_booking(Request $request)
    {
        $bookings = Booking::where('booking_id', $request->booking_id)->get();
        $salon = Salon::where('owner_id', Auth::user()->id)->first();
        return view(
            'admin.booking.print',
            compact('bookings', 'salon')
        );
    }

    public function global_invoice(Request $request)
    {

        $user = User::find($request->user_name);

        $selected = $request->selected;
        $selectedArray = explode(',', $selected);

        // Now $selectedArray contains the values as an array
        $bookings = Booking::whereIn('id', $selectedArray)->get();


        $salon = Salon::where('owner_id', Auth::user()->id)->first();

        return view(
            'admin.booking.global_invoice',
            compact(
                'bookings',
                'salon'
            )
        );
    }

    public function global_invoice_print($user_id, Request $request)
    {

        $user = User::find($user_id);
        $bookings = Booking::whereIn('id', $request->booking_id)->get();
        $salon = Salon::where('owner_id', Auth::user()->id)->first();
        $global_invoice = new GlobalInvoice();

        $global_invoice->user_id = $user_id;
        $global_invoice->salon_id  = $salon->salon_id;
        $global_invoice->date = Carbon::now();
        $global_invoice->status = "1";
        $global_invoice->save();



        $global_invoice->bookings()->attach(
            $bookings->pluck('id')->toArray(),
            ['status' => '1'] // Replace 'your_status' with the status you want to assign
        );

        return view(
            'admin.booking.global_invoice_print',
            compact('bookings', 'salon', 'global_invoice')
        );
    }
}
