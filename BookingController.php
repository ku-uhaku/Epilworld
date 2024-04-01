<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Salon;
use App\Booking;
use App\Coupon;
use App\Service;
use App\User;
use App\Employee;
use DateTime;
use Carbon\Carbon;
use App\AdminSetting;
use OneSignal;
use App\Notification;
use App\Template;
use App\Mail\BookingStatus;
use App\Mail\PaymentStatus;
use App\Mail\CreateAppointment;
use App\Mail\AppCreateAppointment;
use App\Payment;
use App\Room;

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
            $lastEndTime = end($master)['end_time'];
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
                $bookings->where('emp_id', $employeeId);
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
                $bookings->whereBetween('date', [$from, $to]);
            }

            if ($request->filled('user_name')) {
                $bookings->where('user_id', $request->input('user_name'));
            }

            // Finalize the query
            $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);
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
                $lastEndTime = end($master)['end_time'];
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


            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
        } else if ($request->has('previousDay')) {

            $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);

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
                $lastEndTime = end($master)['end_time'];
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

            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
        } else if ($request->has('nextDay')) {
            $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);

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
                $lastEndTime = end($master)['end_time'];
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
            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
        } else if ($request->has('today')) {
            $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);

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
                $lastEndTime = end($master)['end_time'];
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

            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
        } else if ($request->has('Day')) {
            $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);

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
                $lastEndTime = end($master)['end_time'];
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
            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
        }

        if ($request->has('nextOf') || $request->has('previousOf')) {

            $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);



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
                $lastEndTime = end($master)['end_time'];
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
            return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
        }




        $today_booking = $today_booking
            ->where('date', Carbon::today()->toDateString())
            ->get();

        $bookings = $bookings->orderBy('id', 'DESC')->paginate(8);



        // Default case when no filters are applied
        return view('admin.pages.booking', compact('bookings', 'symbol', 'users', 'services', 'emps', 'master', 'today_booking', 'thisDay'));
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

    public function paymentcount(Request $request)
    {
        $data['price'] = Service::whereIn('service_id', $request->ser_id)->sum('price');
        $data['time'] = Service::whereIn('service_id', $request->ser_id)->sum('time');

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
                if ($request->date == date('Y-m-d')) {
                    if (strtotime(date("h:i A")) < strtotime($temp['start_time'])) {
                        array_push($master, $temp);
                    }
                } else {
                    array_push($master, $temp);
                }
            }
        }

        if (count($master) == 0) {
            return response()->json(['msg' => 'Day off', 'success' => false], 200);
        } else {
            return response()->json(['msg' => 'Time slots', 'data' => $master, 'success' => true], 200);
        }
    }

    public function selectemployee(Request $request)
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $emp_array = array();
        $emps_all = Employee::where([['salon_id', $salon->salon_id], ['status', 1]])->get();
        $book_service = $request->service;

        $duration = Service::whereIn('service_id', $book_service)->sum('time') - 1;
        foreach ($emps_all as $emp) {
            $emp_service = json_decode($emp->service_id);
            foreach ($book_service as $ser) {
                if (in_array($ser, $emp_service)) {
                    array_push($emp_array, $emp->emp_id);
                }
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

        $duration = Service::whereIn('service_id', $book_service)->sum('time') - 1;
        foreach ($emps_all as $emp) {
            $emp_service = json_decode($emp->service_id);
            foreach ($book_service as $ser) {
                if (in_array($ser, $emp_service)) {
                    array_push($emp_array, $emp->room_id);
                }
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
        $booking = new Booking();

        $services =  str_replace('"', '', json_encode($request->service_id));
        $booking->service_id = $services;
        $duration = Service::whereIn('service_id', $request->service_id)->sum('time');

        $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $booking->end_time = $start_time->addMinutes($duration)->format('h:i A');
        $booking->salon_id = $salon->salon_id;
        $booking->emp_id = $request->emp_id;
        $booking->room_id = $request->room_id;
        $booking->payment = $request->payment;
        $booking->start_time = $request->start_time;
        $booking->date = $request->date;
        $booking->payment_type = "LOCAL";
        $booking->booking_status = "Approved";
        $booking->user_id = $request->user_id;
        $booking->booking_id = $request->booking_id;

        $booking->save();

        $create_appointment = Template::where('title', 'Create Appointment')->first();

        $not = new Notification();
        $not->booking_id = $booking->id;
        $not->user_id = $booking->user_id;
        $not->title = $create_appointment->subject;

        $detail['UserName'] = $booking->user->name;
        $detail['Date'] = $booking->date;
        $detail['Time'] = $booking->start_time;
        $detail['BookingId'] = $booking->booking_id;
        $detail['SalonName'] = $booking->salon->name;
        $detail['AdminName'] = AdminSetting::first()->app_name;

        $data = ["{{UserName}}", "{{Date}}", "{{Time}}", "{{BookingId}}", "{{SalonName}}"];
        $message = str_replace($data, $detail, $create_appointment->msg_content);
        $not->msg = $message;
        $not->save();

        $mail_enable = AdminSetting::first()->mail;
        $notification_enable = AdminSetting::first()->notification;

        if ($mail_enable == 1) {
            try {
                Mail::to($booking->user->email)->send(new CreateAppointment($create_appointment->mail_content, $detail));
            } catch (\Throwable $th) {
            }
        }
        if ($notification_enable == 1 && $booking->user->device_token != null) {
            try {
                OneSignal::sendNotificationToUser(
                    $message,
                    $booking->user->device_token,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null,
                    $create_appointment->subject
                );
            } catch (\Throwable $th) {
            }
        }
        return response()->json(['msg' => 'Booking successfully', 'data' => $booking, 'success' => true], 200);
    }

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
        if ($request->status == "Completed") {
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

        $services =  str_replace('"', '', json_encode($request->service_id));
        $booking->service_id = $services;
        $duration = Service::whereIn('service_id', $request->service_id)->sum('time');

        $start_time = new Carbon($request['date'] . ' ' . $request['start_time']);
        $booking->end_time = $start_time->addMinutes($duration)->format('h:i A');
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

        return response()->json(['msg' => 'Booking successfully', 'data' => $booking, 'success' => true], 200);
    }

    public function destroy($id)
    {
        //delete payment
        $payment = Payment::where('booking_id', $id)->delete();
        //delete booking
        $booking = Booking::find($id)->delete();



        return redirect()->to('admin/booking')
            ->with('success', 'Booking successfully');
    }
}
