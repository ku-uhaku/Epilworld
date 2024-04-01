<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Service;
use App\ServiceDetails;
use App\Category;
use App\Salon;
use App\AdminSetting;

class ServiceDetailsController extends Controller
{
    public function index(Request $request)

    {
        $service_id = $request->serviceId;
        $services = ServiceDetails::where('isdelete', 0)->where('service_id', $service_id)->get();
        return response()->json(['success' => true, 'data' => $services, 'msg' => 'Service create'], 200);
    }



    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'bail|required',
            'name' => 'bail|required',
            'time' => 'bail|required|numeric',

            'price' => 'bail|required|numeric',
            'NBS' => 'required|min:1',
            'frequency_nb' => 'required|min:1',
        ]);

        $salon = Salon::where('owner_id', Auth()->user()->id)->first();
        $service = new ServiceDetails();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'Service_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images/services');
            $image->move($destinationPath, $name);
            $service->image = $name;
        } else {
            $service->image = "noimage.jpg";
        }

        $service->name = $request->name;
        $service->price = $request->price;
        $service->time = $request->time;
        $service->service_id = $request->service_id;
        $service->NBS = $request->NBS;
        $service->gender = $request->gender;
        $service->frequency     = $request->frequency;
        $service->frequency_nb     = $request->frequency_nb;
        $service->status = 1;
        $service->isdelete = 0;

        $service->salon_id = $salon->salon_id;
        $service->save();

        $servicee_id = Service::all()->last()->service_id  + 1;

        $servicee = new Service();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'Service_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images/services');
            $image->move($destinationPath, $name);
            $servicee->image = $name;
        } else {
            $servicee->image = "noimage.jpg";
        }

        $servicee->name = $request->name;
        $servicee->service_details_id = $service->id;
        $servicee->is_mini_service = 1;
        // $serviceInstance = Service::where('service_id', $request->service_id)->first();

        $servicee->cat_id = Service::where('service_id', $request->service_id)->first()->cat_id;



        $servicee->price = $request->price;
        $servicee->gender = $request->gender;
        $servicee->time = $request->time;

        $servicee->NBS = $request->NBS;
        $servicee->frequency     = $request->frequency;
        $servicee->frequency_nb     = $request->frequency_nb;
        $servicee->status = 1;
        $servicee->isdelete = 0;
        $servicee->salon_id = $salon->salon_id;


        $servicee->save();



        return response()->json(['success' => true, 'data' => $service, 'msg' => 'Service create'], 200);
    }
    public function edit($id)
    {
        $service = ServiceDetails::find($id);

        return response()->json(['success' => true, 'data' => $service, 'msg' => 'Service create'], 200);
    }

    public function update(Request $request)
    {

        $request->validate([
            'service_id' => 'bail|required',
            'name' => 'bail|required',
            'time' => 'bail|required|numeric',
            'price' => 'bail|required|numeric',
            'NBS' => 'required|min:1',
            'frequency_nb' => 'required|min:1',
        ]);
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $service = ServiceDetails::find($request->my_id);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'Service_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images/services');
            $image->move($destinationPath, $name);
            $service->image = $name;
        } else {
            $service->image = "noimage.jpg";
        }

        $service->name = $request->name;
        $service->price = $request->price;
        $service->time = $request->time;
        $service->NBS = $request->NBS;
        $service->gender = $request->gender;
        $service->service_id = $request->service_id;
        $service->frequency     = $request->frequency;
        $service->frequency_nb     = $request->frequency_nb;
        $service->status = 1;
        $service->isdelete = 0;

        $service->salon_id = $salon->salon_id;

        $service->save();

        $servicee = Service::where('service_details_id', $request->my_id)->first();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'Service_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/images/services');
            $image->move($destinationPath, $name);
            $servicee->image = $name;
        } else {
            $servicee->image = "noimage.jpg";
        }

        $servicee->name = $request->name;
        $servicee->service_details_id = $service->id;
        $servicee->is_mini_service = 1;
        // $serviceInstance = Service::where('service_id', $request->service_id)->first();

        $servicee->cat_id = Service::where('service_id', $request->service_id)->first()->cat_id;



        $servicee->price = $request->price;
        $servicee->time = $request->time;
        $servicee->NBS = $request->NBS;
        $servicee->gender = $request->gender;
        $servicee->frequency = $request->frequency;
        $servicee->frequency_nb = $request->frequency_nb;
        $servicee->status = 1;
        $servicee->isdelete = 0;

        $servicee->salon_id = $salon->salon_id;

        $servicee->save();

        return redirect()->back()->with('success', 'Service Updated');
    }

    public function destroy($id)
    {

        $service = ServiceDetails::find($id);

        $service->isdelete = 1;
        $service->save();

        $servicee = Service::where('service_details_id', $id)->first();
        $servicee->isdelete = 1;
        $servicee->save();

        return redirect()->back()->with('success', 'Service Deleted');
    }
    public function getZones(Request $request)
    {
        $serviceId = $request->input('service_id');
        $zones = ServiceDetails::where('service_id', $serviceId)->pluck('id');

        $services = Service::whereIn('service_details_id', $zones)->where('isdelete', 0)->get();


        return response()->json(['success' => true, 'data' =>  $services, 'msg' => 'Service create'], 200);
    }
}
