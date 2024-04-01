<?php

namespace App\Http\Controllers\admin;

use DB;
use App\User;
use App\Salon;
use App\Booking;
use App\Payment;
use App\Service;
use App\Employee;
use Carbon\Carbon;
use App\AdminSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::where('booking_status', 'Completed');
        $symbol = AdminSetting::find(1)->currency_symbol;

        if ($request->filled('filter_date') || $request->filled('filter_emp') || $request->filled('user_name')) {

            if ($request->filled('filter_date')) {
                $dates = explode(' to ', $request->filter_date);
                $from = $dates[0];
                $to = isset($dates[1]) ? $dates[1] : $dates[0];

                $bookings->whereHas('payments', function ($query) use ($from, $to) {
                    $query->whereBetween('payment_date', [$from, $to]);
                });
            }
        } else {
            $bookings->whereHas('payments', function ($query) {
                $query->whereDate('payment_date', today());
            });
        }



        $bookings = $bookings->paginate(8);
        $cancelPayments = Payment::where('status', 1)->get();

        return view('admin.payment.index', compact('bookings', 'symbol', 'cancelPayments'));
    }


    public function create($id)
    {
        $booking = Booking::find($id);
        $totalPaid = Payment::where('booking_id', $id)->where('status', 0)->sum('amount');


        $services = $booking->service_id;
        $services = explode(',', $services);
        $services = array_map(function ($service) {
            return trim(str_replace(['[', ']'], '', $service));
        }, $services);
        $services = Service::whereIn('service_id', $services)->get();

        $payments = Payment::where('booking_id', $id)->get();
        $symbol = AdminSetting::find(1)->currency_symbol;

        $restToPay = $booking->payment - $totalPaid;


        return view('admin.payment.create', compact('booking', 'restToPay', 'services', 'symbol', 'payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_type' => 'required',
        ]);

        $bookings = Booking::where('booking_id', $request->booking_id)->get();
        $totalPaid = Payment::where('booking_id', $request->id)->where('status', 0)->sum('amount');

        if ($totalPaid + $request->amount > $bookings[0]->payment) {
            //call metode create
            return $this->create($request->booking_id)
                //how return input error
                ->withErrors(['amount' => 'The amount is too much.']);
        }

        $payment = new Payment();
        $payment->booking_id  = $request->id;
        $payment->amount = $request->amount;
        $payment->payment_date = $request->payment_date;
        $payment->created_by =  Auth::user()->name;


        if ($totalPaid + $request->amount == $bookings[0]->payment) {
            foreach ($bookings as $booking) {
                $booking->payment_status = 1;
                $booking->save();
            }
        } elseif ($totalPaid + $request->amount < $bookings[0]->payment) {

            foreach ($bookings as $booking) {
                $booking->payment_status = 2;
                $booking->save();
            }
        } else {
            foreach ($bookings as $booking) {
                $booking->payment_status = 0;
                $booking->save();
            }
        }

        $payment->payment_type = $request->payment_type;
        $payment->payment_reference = $request->payment_reference;
        $payment->collection_date = $request->collection_date;

        $booking->save();

        $payment->save();
        return redirect()->to('admin/payment/create/' . $request->id)
            ->with('success', 'Payment successfully');
    }

    public function edit($id)
    {
        $payment = Payment::find($id);


        return response()->json(['msg' => 'Payment successfully', 'data' => $payment, 'success' => true], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount_edit' => 'required|numeric',
            'payment_date_edit' => 'required|date',
        ]);

        $payment = Payment::find($id);



        $booking = Booking::find($payment->booking_id);

        $bookings = Booking::where('booking_id', $booking->booking_id)->get();

        $payment->amount = $request->amount_edit;
        $payment->payment_date = $request->payment_date_edit;

        $payment->payment_type = $request->edit_payment_type;
        $payment->payment_reference = $request->edit_payment_reference;
        $payment->save();

        $totalPaid = Payment::where('booking_id', $request->booking_id)->where('status', 0)->sum('amount');

        if ($totalPaid == $booking->payment) {
            foreach ($bookings as $booking) {
                $booking->payment_status = 1;
                $booking->save();
            }
        } elseif ($totalPaid == 0) {

            foreach ($bookings as $booking) {
                $booking->payment_status = 0;
                $booking->save();
            }
        } else {
            foreach ($bookings as $booking) {
                $booking->payment_status = 2;
                $booking->save();
            }
        }


        return response()->json(['msg' => 'Payment successfully', 'data' => $totalPaid, 'success' => true], 200);
    }

    public function destroy(Request $request)
    {
        $payment = Payment::find($request->booking_iddd);

        $booking = Booking::find($payment->booking_id);
        $bookings = Booking::where('booking_id', $booking->booking_id)->get();

        $payment->status = 1;
        $payment->whycancel = $request->whycancel;
        $payment->who_cancel = Auth::user()->name;
        $payment->cancel_date = today();

        $payment->save();


        foreach ($booking->payments as $paymentt) {
            if ($paymentt->status == 0) {
                foreach ($bookings as $booking) {
                    $booking->payment_status = 2;
                    $booking->save();
                }

                break;
            } else {
                foreach ($bookings as $booking) {
                    $booking->payment_status = 0;
                    $booking->save();
                }
            }
        }





        return redirect()->to('admin/booking')
            ->with('success', 'Payment successfully');
    }

    public function cancelPayment(Request $request)
    {
        $booking = Booking::find($request->booking_iddd);
        $bookings = Booking::where('booking_id', $booking->booking_id)->get();
        // Check if there are existing payments
        $existingPayments = $booking->payments->where('payment_done', null);
        foreach ($existingPayments as $existingPayment) {
            // Update each existing payment if it exists and whycancel is not empty
            if ($existingPayment && $existingPayment->whycancel == '' && !empty($request->whycancel)) {
                $existingPayment->whycancel = $request->whycancel;
                $existingPayment->status = 1;
                $existingPayment->who_cancel = Auth::user()->name;
                $existingPayment->cancel_date = today();
                $existingPayment->save();

                foreach ($bookings as $booking) {
                    $booking->payment_status = 0;
                    $booking->save();
                }
            }
        }



        // Other logic...

        return redirect()->back()->with('success', 'Payment cancelled successfully.');
    }

    public function print($id)
    {
        $salon = Salon::where('owner_id', auth()->user()->id)->first();
        $payment = Payment::where('id', $id)->first();

        return view('admin.payment.print', compact('payment', 'salon'));
    }

    public function show($id)
    {
        $user = User::find($id);


        $bookings = $user->booking;


        foreach ($bookings as $booking) {
            $payments = $booking->payments;
        }
        $allPayments = $bookings->flatMap->payments;


        return view('admin.payment.show', compact('user', 'bookings', 'allPayments'));
    }

    public function showPaymentBooking($booking_id)
    {
        $booking = Booking::where('booking_id', '#' . $booking_id)->first();


        $payments = Payment::where('booking_id', $booking->id)->get();



        return view('admin.payment.booking-payment', compact('payments'));
    }
}
