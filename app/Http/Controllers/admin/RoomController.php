<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Room;
use App\Service;
use App\Salon;
use App\Booking;
use App\AdminSetting;
use Carbon\Carbon;
use DB;

class RoomController extends Controller
{

    public function index()
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $rooms = Room::where([['salon_id', $salon->salon_id], ['isdelete', 0]])
            ->orderBy('room_id', 'DESC')
            ->paginate(10);

        $services = Service::where([['salon_id', $salon->salon_id], ['status', 1]])->get();

        return view('admin.pages.room', compact('rooms', 'services', 'salon'));
    }

    public function create()
    {
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();


        $services = Service::where([['salon_id', $salon->salon_id], ['isdelete', 0]])->orderBy('cat_id', 'ASC')->get();



        return view('admin/room/create', compact('services', 'salon'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',

            'services' => 'bail|required',

        ]);

        $emp = new Room();


        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $emp->salon_id = $salon->salon_id;
        $emp->name = $request->name;

        $emp->service_id = json_encode($request->services);

        if ($request->sunopen == null || $request->sunclose == null) {
            $emp->sun = json_encode(array('open' => $request->sunopen, 'close' => $request->sunclose));
        } else {
            $emp->sun = json_encode(array('open' => Carbon::parse($request->sunopen)->format('H:i'), 'close' => Carbon::parse($request->sunclose)->format('H:i')));
        }

        if ($request->monopen == null || $request->monclose == null) {
            $emp->mon = json_encode(array('open' => $request->monopen, 'close' => $request->monclose));
        } else {
            $emp->mon = json_encode(array('open' => Carbon::parse($request->monopen)->format('H:i'), 'close' => Carbon::parse($request->monclose)->format('H:i')));
        }

        if ($request->tueopen == null || $request->tueclose == null) {
            $emp->tue = json_encode(array('open' => $request->tueopen, 'close' => $request->tueclose));
        } else {
            $emp->tue = json_encode(array('open' => Carbon::parse($request->tueopen)->format('H:i'), 'close' => Carbon::parse($request->tueclose)->format('H:i')));
        }

        if ($request->wedopen == null || $request->wedclose == null) {
            $emp->wed = json_encode(array('open' => $request->wedopen, 'close' => $request->wedclose));
        } else {
            $emp->wed = json_encode(array('open' => Carbon::parse($request->wedopen)->format('H:i'), 'close' => Carbon::parse($request->wedclose)->format('H:i')));
        }

        if ($request->thuopen == null || $request->thuclose == null) {
            $emp->thu = json_encode(array('open' => $request->thuopen, 'close' => $request->thuclose));
        } else {
            $emp->thu = json_encode(array('open' => Carbon::parse($request->thuopen)->format('H:i'), 'close' => Carbon::parse($request->thuclose)->format('H:i')));
        }

        if ($request->friopen == null || $request->friclose == null) {
            $emp->fri = json_encode(array('open' => $request->friopen, 'close' => $request->friclose));
        } else {
            $emp->fri = json_encode(array('open' => Carbon::parse($request->friopen)->format('H:i'), 'close' => Carbon::parse($request->friclose)->format('H:i')));
        }

        if ($request->satopen == null || $request->satclose == null) {
            $emp->sat = json_encode(array('open' => $request->satopen, 'close' => $request->satclose));
        } else {
            $emp->sat = json_encode(array('open' => Carbon::parse($request->satopen)->format('H:i'), 'close' => Carbon::parse($request->satclose)->format('H:i')));
        }

        $emp->save();
        return redirect('/admin/room');
    }
    public function show($id)
    {
    }

    public function edit($id)
    {
        $room = Room::find($id);
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $services = Service::where([['salon_id', $salon->salon_id], ['isdelete', 0]])->orderBy('cat_id', 'ASC')->get();

        $appointment = Booking::where('room_id', $id)->get();
        $arr = array();
        foreach ($appointment as $item) {
            array_push($arr, $item->user_id);
        }
        $count = array_count_values($arr);
        $client = array_keys($count);
        $symbol = AdminSetting::find(1)->currency_symbol;

        return view('admin.room.edit', compact('room', 'services', 'salon', 'appointment', 'client', 'symbol'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',

            'services' => 'bail|required',

        ]);

        $emp = Room::find($id);


        $emp->name = $request->name;


        $emp->service_id = json_encode($request->services);


        if ($request->sunopen == null || $request->sunclose == null) {
            $emp->sun = json_encode(array('open' => $request->sunopen, 'close' => $request->sunclose));
        } else {
            $emp->sun = json_encode(array('open' => Carbon::parse($request->sunopen)->format('H:i'), 'close' => Carbon::parse($request->sunclose)->format('H:i')));
        }

        if ($request->monopen == null || $request->monclose == null) {
            $emp->mon = json_encode(array('open' => $request->monopen, 'close' => $request->monclose));
        } else {
            $emp->mon = json_encode(array('open' => Carbon::parse($request->monopen)->format('H:i'), 'close' => Carbon::parse($request->monclose)->format('H:i')));
        }

        if ($request->tueopen == null || $request->tueclose == null) {
            $emp->tue = json_encode(array('open' => $request->tueopen, 'close' => $request->tueclose));
        } else {
            $emp->tue = json_encode(array('open' => Carbon::parse($request->tueopen)->format('H:i'), 'close' => Carbon::parse($request->tueclose)->format('H:i')));
        }

        if ($request->wedopen == null || $request->wedclose == null) {
            $emp->wed = json_encode(array('open' => $request->wedopen, 'close' => $request->wedclose));
        } else {
            $emp->wed = json_encode(array('open' => Carbon::parse($request->wedopen)->format('H:i'), 'close' => Carbon::parse($request->wedclose)->format('H:i')));
        }

        if ($request->thuopen == null || $request->thuclose == null) {
            $emp->thu = json_encode(array('open' => $request->thuopen, 'close' => $request->thuclose));
        } else {
            $emp->thu = json_encode(array('open' => Carbon::parse($request->thuopen)->format('H:i'), 'close' => Carbon::parse($request->thuclose)->format('H:i')));
        }

        if ($request->friopen == null || $request->friclose == null) {
            $emp->fri = json_encode(array('open' => $request->friopen, 'close' => $request->friclose));
        } else {
            $emp->fri = json_encode(array('open' => Carbon::parse($request->friopen)->format('H:i'), 'close' => Carbon::parse($request->friclose)->format('H:i')));
        }

        if ($request->satopen == null || $request->satclose == null) {
            $emp->sat = json_encode(array('open' => $request->satopen, 'close' => $request->satclose));
        } else {
            $emp->sat = json_encode(array('open' => Carbon::parse($request->satopen)->format('H:i'), 'close' => Carbon::parse($request->satclose)->format('H:i')));
        }

        $emp->save();
        return redirect('/admin/room');
    }

    public function destroy($id)
    {
        $emp = Room::find($id);
        $emp->isdelete = 1;
        $emp->status = 0;
        $emp->save();
        return redirect('/admin/room');
    }
    public function hideEmp(Request $request)
    {
        $emp = Room::find($request->empId);
        if ($emp->status == 0) {
            $emp->status = 1;
            $emp->save();
        } else if ($emp->status == 1) {
            $emp->status = 0;
            $emp->save();
        }
    }

    public function getRoomId($id)
    {
        $room = Room::find($id);
        return response()->json(['msg' => 'Room successfully', 'data' => $room, 'success' => true], 200);
    }
}
