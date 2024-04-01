<?php

namespace App\Http\Controllers\admin;

use App\Salon;

use Carbon\Carbon;

use App\ParametageServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ParametageServicesController extends Controller
{
    public function index()
    {

        $parametrageServices =  ParametageServices::where('status', 1)->where('is_deleted', 0)->get();


        return view('admin.parametageServices.index', compact('parametrageServices'));
    }

    public function create()
    {
        return view('admin.parametageServices.create');
    }

    public function store(Request $request)
    {


        request()->validate([
            'name' => 'required',
            'energie' => 'required',
            'frequence' => 'required',
            'refoidissement' => 'required',
            'gender' => 'required',
            'service' => 'required',

        ]);
        $salon = Salon::where('owner_id', Auth()->user()->id)->first();

        $parametageServices = new ParametageServices();
        $parametageServices->salon_id = $salon->salon_id;
        $parametageServices->name = $request->name;
        $parametageServices->energie = $request->energie;
        $parametageServices->frequence = $request->frequence;
        $parametageServices->refoidissement = $request->refoidissement;
        $parametageServices->gender = $request->gender;
        $parametageServices->service_name = $request->service;
        $parametageServices->status = 1;
        $parametageServices->is_deleted = 0;

        $parametageServices->save();

        return redirect('admin/parametrage/user_service')->with('success', 'ParametageServices created successfully.');
    }

    public function update(request $request)
    {
        $parametageServices = ParametageServices::find($request->id);
        $parametageServices->name = $request->name;
        $parametageServices->energie = $request->energie;
        $parametageServices->frequence = $request->frequence;
        $parametageServices->refoidissement = $request->refoidissement;
        $parametageServices->gender = $request->gender;
        $parametageServices->service_name = $request->service;
        $parametageServices->status = 1;
        $parametageServices->is_deleted = 0;

        $parametageServices->save();

        return redirect('admin/parametrage/user_service')->with('success', 'ParametageServices updated successfully.');
    }

    public function destroy($id)
    {
        $parametageServices = ParametageServices::find($id);
        $parametageServices->is_deleted = 1;
        $parametageServices->save();

        return redirect('admin/parametrage/user_service')->with('success', 'ParametageServices deleted successfully.');
    }
}
