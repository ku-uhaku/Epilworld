<?php

namespace App\Http\Controllers\admin;

use App\Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BillController extends Controller
{
    public function index(Request $request)
    {

        if ($request->filled('date')) {

            $bills = Bill::where('date', $request->date)->orderBy('id', 'DESC')->paginate(5);
            return view('admin.bill.index', compact('bills'));
        }
        $bills = Bill::orderBy('id', 'DESC')->paginate(5);
        return view('admin.bill.index', compact('bills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'price' => 'bail|required',
            'date' => 'date|required',
            'mode_Payment' => 'bail|required'
        ]);

        $bill = new Bill();

        $bill->name = $request->name;
        $bill->price = $request->price;
        $bill->mode_payment = $request->mode_Payment;
        $bill->date = Carbon::parse($request->date);
        $bill->tiers = $request->tiers;
        $bill->note = $request->note;
        $bill->ref_pay = $request->ref;
        $bill->created_by = Auth::user()->name;
        $bill->status = 1;

        $bill->save();

        return redirect()->back()->with('success', 'Bill created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'price' => 'bail|required',
            'date' => 'date|required',
            'mode_Payment' => 'bail|required'
        ]);
        $id = $request->id;
        $bill = Bill::find($id);

        $bill->name = $request->name;
        $bill->price = $request->price;
        $bill->mode_payment = $request->mode_Payment;
        $bill->date = Carbon::parse($request->date);
        $bill->tiers = $request->tiers;
        $bill->note = $request->note;
        $bill->ref_pay = $request->ref;
        $bill->status = 1;

        $bill->save();

        return redirect()->back()->with('success', 'Bill updated successfully');
    }

    public function destroy($id)
    {


        $bill = Bill::find($id);
        $bill->delete();
        return redirect()->back()->with('success', 'Bill deleted successfully');
    }
}
