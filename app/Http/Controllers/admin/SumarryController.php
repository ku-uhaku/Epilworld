<?php

namespace App\Http\Controllers\admin;

use App\Salon;
use App\Caisse;
use App\Booking;
use App\Payment;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



class SumarryController extends Controller
{
    public function index(Request $request)
    {
        $isCaisse = False;
        if ($request->filled('filter_date')) {
            $dates = explode(' to ', $request->filter_date);
            $from = $dates[0];
            if (!isset($dates[1])) {
                $to = $dates[0];
            } else {
                $to = $dates[1];
            }
            $cashSum = Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'cash')->where('status', 0)->sum('amount');
            $bankTransferSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'bank transfer')->where('status', 0)->sum('amount');
            $chequeSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'cheque')->where('status', 0)->sum('amount');
            $creditCardSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'credit card')->where('status', 0)->sum('amount');
            $treatySum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'Treaty')->where('status', 0)->sum('amount');
            $TPESum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'TPE')->where('status', 0)->sum('amount');
            $otherSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'other')->where('status', 0)->sum('amount');
            $payments = Payment::whereBetween('payment_date', [$from, $to])->where('status', 0)->get();
            $bookings = Booking::whereBetween('date', [$from, $to]);
            if ($to == $from) {
                $isCaisse = True;
                $caisse = Caisse::whereDate('day_caisse', $from)->get();
            } else {
                $caisse = Caisse::whereBetween('day_caisse', [$from, $to])->get();
            }
        } else {

            $cashSum = Payment::whereDate('payment_date', today())->where('payment_type', 'cash')->where('status', 0)->sum('amount');
            $bankTransferSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'bank transfer')->where('status', 0)->sum('amount');
            $chequeSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'cheque')->where('status', 0)->sum('amount');
            $creditCardSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'credit card')->where('status', 0)->sum('amount');
            $treatySum =  Payment::whereDate('payment_date', today())->where('payment_type', 'Treaty')->where('status', 0)->sum('amount');
            $TPESum =  Payment::whereDate('payment_date', today())->where('payment_type', 'TPE')->where('status', 0)->sum('amount');
            $otherSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'other')->where('status', 0)->sum('amount');
            $bookings = Booking::whereDate('date', today());
            $payments = Payment::whereDate('payment_date', today())->where('status', 0)->get();
            $isCaisse = True;
            $caisse = Caisse::whereDate('day_caisse', today())->get();
        }







        $totalSum = $cashSum + $bankTransferSum + $chequeSum + $creditCardSum + $treatySum + $TPESum + $otherSum;

        $bookings = $bookings->where('booking_status', 'Completed')->get();

        $services = Service::all();

        return view('admin.summary.index', compact('cashSum', 'bankTransferSum', 'chequeSum', 'creditCardSum', 'treatySum', 'TPESum', 'otherSum', 'totalSum', 'bookings', 'services', 'payments', 'caisse', 'isCaisse'));
    }

    public function print(Request $request)
    {
        $salon = Salon::where('owner_id', auth()->user()->id)->first();

        $isCaisse = False;
        if ($request->filled('filter_date')) {

            $dates = explode(' to ', $request->filter_date);
            $from = $dates[0];
            if (!isset($dates[1])) {
                $to = $dates[0];
            } else {
                $to = $dates[1];
            }
            $cashSum = Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'cash')->where('status', 0)->sum('amount');
            $bankTransferSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'bank transfer')->where('status', 0)->sum('amount');
            $chequeSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'cheque')->where('status', 0)->sum('amount');
            $creditCardSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'credit card')->where('status', 0)->sum('amount');
            $treatySum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'Treaty')->where('status', 0)->sum('amount');
            $TPESum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'TPE')->where('status', 0)->sum('amount');
            $otherSum =  Payment::whereBetween('payment_date', [$from, $to])->where('payment_type', 'other')->where('status', 0)->sum('amount');
            $payments = Payment::whereBetween('payment_date', [$from, $to])->where('status', 0)->get();
            $bookings = Booking::whereBetween('date', [$from, $to])->where('booking_status', 'Completed')->get();

            if ($to == $from) {
                $isCaisse = True;
                $caisse = Caisse::whereDate('day_caisse', $from)->get();
            } else {
                $caisse = Caisse::whereBetween('day_caisse', [$from, $to])->get();
            }
        } else {


            $bookings = Booking::whereDate('date', today())->where('booking_status', 'Completed')->get();

            $payments = Payment::whereDate('payment_date', today())->where('status', 0)->get();

            $cashSum = Payment::whereDate('payment_date', today())->where('payment_type', 'cash')->where('status', 0)->sum('amount');
            $bankTransferSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'bank transfer')->where('status', 0)->sum('amount');
            $chequeSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'cheque')->where('status', 0)->sum('amount');
            $creditCardSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'credit card')->where('status', 0)->sum('amount');
            $treatySum =  Payment::whereDate('payment_date', today())->where('payment_type', 'Treaty')->where('status', 0)->sum('amount');
            $TPESum =  Payment::whereDate('payment_date', today())->where('payment_type', 'TPE')->where('status', 0)->sum('amount');
            $otherSum =  Payment::whereDate('payment_date', today())->where('payment_type', 'other')->where('status', 0)->sum('amount');
            $caisse = Caisse::whereDate('day_caisse', today())->get();
        }


        $totalSum = $cashSum + $bankTransferSum + $chequeSum + $creditCardSum + $treatySum + $TPESum + $otherSum;

        return view('admin.summary.print', compact('cashSum', 'bankTransferSum', 'chequeSum', 'creditCardSum', 'treatySum', 'TPESum', 'otherSum', 'totalSum', 'salon', 'bookings', 'payments', 'caisse', 'isCaisse'));
    }

    public function paymentDone(Request $request)
    {
        if ($request->caisse) {
            $caisse =  Caisse::find($request->caisse);
            $caisse->status = 1;
        } else {
            $caisse = new Caisse();
            $caisse->status = 1;
        }
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        if ($request->filled('filter_date')) {
            $dates = explode(' to ', $request->filter_date);
            $from = $dates[0];
            $to = isset($dates[1]) ? $dates[1] : $dates[0];

            $payments = Payment::whereBetween('payment_date', [$from, $to])->get();
            $caisse->salon_id = $salon->salon_id;
            $caisse->day_caisse = $from;

            $caisse->date = today();
            $caisse->amount =  $request->totalSum;
            $caisse->save();
            foreach ($payments as $payment) {
                if ($payment->payment_done == null) {

                    $payment->payment_done = $payment->payment_date;
                    $payment->save();
                }
            }
        } else {
            $payments = Payment::whereDate('payment_date', today())->get();

            $caisse->salon_id = $salon->salon_id;
            $caisse->day_caisse = today();
            $caisse->date = today();
            $caisse->amount = $request->totalSum;
            $caisse->status = 1;
            $caisse->save();
            foreach ($payments as $payment) {
                if ($payment->payment_done == null) {


                    // Use the payment date or modify as needed
                    $payment->payment_done = $payment->payment_date;
                    $payment->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Payment done successfully.');
    }

    public function paymentNotDone(Request $request)
    {
        if ($request->filter_date) {
            $dates = explode(' to ', $request->filter_date);
            $from = $dates[0];
            $to = isset($dates[1]) ? $dates[1] : $dates[0];
            $payments = Payment::whereBetween('payment_date', [$from, $to])->get();
        } else {
            $payments = Payment::whereDate('payment_date', today())->get();
        }
        $caisse =  Caisse::find($request->caisse);

        $caisse->status = 0;
        $caisse->save();

        foreach ($payments as $payment) {
            if ($payment->payment_done != null) {
                $payment->payment_done = null;
                $payment->save();
            }
        }

        return redirect()->back()->with('success', 'Payment not done successfully.');
    }
}
