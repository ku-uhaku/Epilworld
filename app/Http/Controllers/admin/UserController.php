<?php

namespace App\Http\Controllers\admin;

use Auth;
use Hash;
use App\User;
use App\Salon;
use App\Review;
use App\Address;
use App\Booking;
use App\Employee;
use App\AdminSetting;
use App\Notification;
use App\ParametageServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $praticiennes = Employee::where(
            ['status' => 1]
        )->get();
        if (isset($request->filter_date)) {
            if ($request->filter_date != null) {
                $pass = $request->filter_date;
                $dates = explode(' to ', $request->filter_date);
                $from = $dates[0];
                $to = $dates[1];

                $users = User::where('role', '=', 3)
                    ->whereBetween('created_at', [$from, $to])
                    ->orderBy('id', 'DESC')->get();
                return view('admin.pages.user', compact('users', 'pass', 'praticiennes'));
            } else {
                return redirect('/admin/users')->withErrors(['Select Date In Range']);
            }
        } else {
            $pass = '';
            $users = User::where('role', '=', 3)
                ->orderBy('id', 'DESC')->get();
            return view('admin.pages.user', compact('users', 'pass', 'praticiennes'));
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {

        // Validation
        $request->validate([
            'name' => 'bail|required',
            'prenom' => 'bail|required',
            // Add validation for other fields as needed
        ]);

        $salon = Salon::where('owner_id', Auth::user()->id)->first();
        $salon_id = $salon->salon_id;

        $user = new User();
        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->code = "+" . $request->code;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->origine = $request->origin;
        $user->practice = $request->praticienne;
        $user->review = $request->review;
        $user->password = Hash::make($request->password);
        $user->added_by = $salon_id;
        $user->verify = 1;
        $user->save();



        // Get the parameters from the request
        $epulationserviceParametageIds = $request->input('epulation', []);
        $epulationEnergies = $request->input('epulation_energie', []);
        $epulationFrequences = $request->input('epulation_frequence', []);
        $epulationRefroidissements = $request->input('epulation_refoidissement', []);





        $laiserserviceParametageIds = $request->input('laiser', []);
        $laiserEnergie = $request->input('laiser_energie', []);
        $laiserFrequences = $request->input('laiser_frequence', []);
        $laiserRefroidissements = $request->input('laiser_refroidissement', []);

        // Attach parametrage services to the user
        $user->parametrage_services()->attach(array_map(function ($epulationserviceParametageIds, $energie, $frequence, $refroidissement) {

            return [
                'service_parametage_id' => $epulationserviceParametageIds,
                'energie' => $energie,
                'frequence' => $frequence,
                'refroidissement' => $refroidissement
            ];
        }, $epulationserviceParametageIds, $epulationEnergies, $epulationFrequences, $epulationRefroidissements));

        $user->parametrage_services()->attach(array_map(function ($laiserserviceParametageIds, $energie, $frequence, $refroidissement) {
            return [
                'service_parametage_id' => $laiserserviceParametageIds,
                'energie' => $energie,
                'frequence' => $frequence,
                'refroidissement' => $refroidissement
            ];
        }, $laiserserviceParametageIds, $laiserEnergie, $laiserFrequences, $laiserRefroidissements));

        //return response()->json(['success' => true, 'data' => $user, 'msg' => 'User created'], 200);

        return redirect()->back()->with('success', 'User created successfully');
    }


    public function show($id)
    {
        $user = User::find($id);
        $completed = Booking::where([['user_id', $user->id], ['booking_status', 'Completed']])->orderBy('date', 'DESC')->get();
        $pending = Booking::where([['user_id', $user->id], ['booking_status', 'in session']])->orderBy('date', 'DESC')->get();
        $approved = Booking::where([['user_id', $user->id], ['booking_status', 'Approved']])->orderBy('date', 'DESC')->get();
        $cancel = Booking::where([['user_id', $user->id], ['booking_status', 'Cancel']])->orderBy('date', 'DESC')->get();
        $setting = AdminSetting::find(1, ['currency_symbol']);
        $address = Address::where('user_id', $user->id)->get();
        return view('admin.users.show', compact('user', 'completed', 'cancel', 'pending', 'approved', 'setting', 'address'));
    }

    public function destroy($id)
    {
        // delete address
        $addr = Address::where('user_id', $id)->get();
        foreach ($addr as $item) {
            $item->delete();
        }

        // Delete Booking
        $booking = Booking::where('user_id', $id)->get();
        foreach ($booking as $item) {
            $item->delete();
        }

        // Delete Notification
        $notification = Notification::where('user_id', $id)->get();
        foreach ($notification as $item) {
            $item->delete();
        }

        // delete Review
        $review = Review::where('user_id', $id)->get();
        foreach ($review as $item) {
            $item->delete();
        }

        // delete User
        $user = User::find($id);
        if ($user->image != "noimage.jpg") {
            \File::delete(public_path('/storage/images/users/' . $user->image));
        }
        $user->delete();
        return redirect()->back();
    }

    public function hideUser(Request $request)
    {
        $user = User::find($request->userId);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
        } else if ($user->status == 1) {
            $user->status = 0;
            $user->save();
        }
    }

    public function edit($id)
    {
        $data = array();
        $user = User::find($id);


        $parametrage_services = $user->parametrage_services()->get();

        $data = [
            'user' => $user,
            'parametrage_services' => $parametrage_services
        ];

        return response()->json(['success' => true, 'data' => $data, 'msg' => 'User create'], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'prenom' => 'bail|required',
        ]);

        $salon = Salon::where('owner_id', Auth::user()->id)->first();
        $salon_id = $salon->salon_id;

        $user = User::find($id);

        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->code = "+" . $request->code;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->origine = $request->origin;
        $user->practice = $request->praticienne;
        $user->review = $request->review;

        $user->password = Hash::make($request->password);
        $user->added_by = $salon_id;
        $user->verify = 1;
        $user->save();


        // Get the parameters from the request
        $epulationserviceParametageIds = $request->input('epulation', []);
        $epulationEnergies = $request->input('epulation_energie', []);
        $epulationFrequences = $request->input('epulation_frequence', []);
        $epulationRefroidissements = $request->input('epulation_refoidissement', []);

        $laiserserviceParametageIds = $request->input('laiser', []);

        $laiserEnergie = $request->input('laiser_energie', []);
        $laiserFrequences = $request->input('laiser_frequence', []);
        $laiserRefroidissements = $request->input('laiser_refroidissement', []);

        // Get existing parametrage service IDs for 'Epulation' service
        $existingParametrageServiceIds = $user->parametrage_services()->pluck('service_parametage_id')->toArray();
        $serviceParametageIds = array_merge($epulationserviceParametageIds, $laiserserviceParametageIds);
        $energies = array_merge($epulationEnergies, $laiserEnergie);
        $frequences = array_merge($epulationFrequences, $laiserFrequences);
        $refroidissements = array_merge($epulationRefroidissements, $laiserRefroidissements);



        // Attach or update parametrage services
        foreach ($serviceParametageIds as $index => $serviceParametageId) {
            if (isset($energies[$index], $frequences[$index], $refroidissements[$index])) {
                $user->parametrage_services()->syncWithoutDetaching([$serviceParametageId => [
                    'energie' => $energies[$index],
                    'frequence' => $frequences[$index],
                    'refroidissement' => $refroidissements[$index]
                ]]);
            }

            // Remove the ID from the list of existing IDs
            unset($existingParametrageServiceIds[array_search($serviceParametageId, $existingParametrageServiceIds)]);
        }



        // Remove any remaining associations for parametrage services that were deleted from the form
        if (!empty($existingParametrageServiceIds)) {
            foreach ($existingParametrageServiceIds as $serviceParametageId) {

                $user->parametrage_services()->detach($serviceParametageId);
            }
        }






        // // Attach or update epulations
        // foreach ($epulationserviceParametageIds as $index => $epulationId) {
        //     if (isset($epulationEnergies[$index], $epulationFrequences[$index], $epulationRefroidissements[$index])) {
        //         $user->parametrage_services()->syncWithoutDetaching([$epulationId => [
        //             'energie' => $epulationEnergies[$index],
        //             'frequence' => $epulationFrequences[$index],
        //             'refroidissement' => $epulationRefroidissements[$index]
        //         ]]);
        //         // Remove the ID from the list of existing IDs
        //         unset($existingEpulationParametrageServiceIds[array_search($epulationId, $existingEpulationParametrageServiceIds)]);
        //     }
        // }

        // // Attach or update laisers
        // foreach ($laiserserviceParametageIds as $index => $laiserId) {
        //     if (isset($laiserEnergie[$index], $laiserFrequences[$index], $laiserRefroidissements[$index])) {
        //         $user->parametrage_services()->syncWithoutDetaching([$laiserId => [
        //             'energie' => $laiserEnergie[$index],
        //             'frequence' => $laiserFrequences[$index],
        //             'refroidissement' => $laiserRefroidissements[$index]
        //         ]]);
        //         // Remove the ID from the list of existing IDs
        //         unset($existingLaiserParametrageServiceIds[array_search($laiserId, $existingLaiserParametrageServiceIds)]);
        //     }
        // }

        // // Remove any remaining associations for 'Epulation' service (parametrage services that were deleted from the form)
        // // Remove any remaining associations for 'Epulation' service (parametrage services that were deleted from the form)
        // if (!empty($existingEpulationParametrageServiceIds)) {
        //     $user->parametrage_services()->where('service_name', 'Epilation')->detach($existingEpulationParametrageServiceIds);
        //     dd(,)
        // }

        // // Remove any remaining associations for 'Laiser' service (parametrage services that were deleted from the form)
        // if (!empty($existingLaiserParametrageServiceIds)) {
        //     $user->parametrage_services()->where('service_name', 'Laiser')->detach($existingLaiserParametrageServiceIds);
        // }











        return redirect()->back()->with('success', 'User Updated successfully');
    }

    public function serviceParameter(Request $request)
    {
        $data = ParametageServices::where('status', 1)->where('gender', $request->gender)->where('is_deleted', 0)->get();
        return response()->json(['success' => true, 'data' => $data, 'msg' => 'User Updated '], 200);
    }

    public function ServiceParDetails(Request $request)
    {
        $data = ParametageServices::where('id', $request->id)->first();
        return response()->json(['success' => true, 'data' => $data, 'msg' => 'User Updated '], 200);
    }
}
