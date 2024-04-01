<?php

namespace App\Http\Controllers\admin;

use App\Bill;
use App\Salon;
use App\Booking;
use App\GlobalInvoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlobalInvoiceController extends Controller
{
    public function index()
    {
        $invoices = GlobalInvoice::orderBy('id', 'DESC')->paginate(20);
        return view('admin.pages.globalInvoice', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = GlobalInvoice::find($id);

        $bookings = $invoice->bookings;

        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        return view('admin.booking.show_global_invoice', compact('invoice', 'salon', 'bookings'));
    }

    public function global_invoice_p($id)
    {
        $invoice = GlobalInvoice::find($id);
        $bookings = $invoice->bookings;
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        return view('admin.booking.global_invoice_p', compact('invoice', 'salon', 'bookings'));
    }

    public function edit($id)
    {
        $invoice = GlobalInvoice::find($id)->with('bookings')->with('user')->get()[0];
        return response()->json([
            'msg' => 'Service frecuency successfully retrieved',
            'data' => $invoice,
            'success' => true
        ], 200);
    }

    public function update(Request $request)
    {


        // Find the invoice by ID
        $invoice = GlobalInvoice::find($request->id);

        // Get the booking IDs from the request input
        $bookingIds = $request->input('booking', []);

        // Sync the bookings with the invoice
        $invoice->bookings()->sync($bookingIds);

        // Detach any bookings that are not included in the request


        // Redirect back with success message
        return redirect()->back()->with('success', 'Invoice Updated Successfully');
    }
    public function destroy($id)
    {

        $invoice = GlobalInvoice::find($id);


        $invoice->bookings()->detach();

        $invoice->delete();
        return redirect()->back()->with('success', 'Invoice Deleted Successfully');
    }

    public function getAllBookingsForUser($id)
    {
        $bookings = Booking::where('user_id', $id)->where('is_repeat', 1)->get();
        return response()->json([
            'msg' => 'Service frecuency successfully retrieved',
            'data' => $bookings,
            'success' => true
        ], 200);
    }

    public function getDetailsForBooking($id)
    {
        $booking = Booking::find($id);
        return response()->json([
            'msg' => 'Service frecuency successfully retrieved',
            'data' => $booking,
            'success' => true
        ], 200);
    }
}
