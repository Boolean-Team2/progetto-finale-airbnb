<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Service;
use App\Apartment;

class ApController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // User's apartments show
    public function apartmentShow($id) {

        $owner = User::findOrFail($id);

        $apartments = $owner -> apartments;

        return view('pages.users.apartments.show', compact('apartments'));
    }

    // User's apartments create
    public function apartmentCreate() {

        $services = Service::all();

        return view('pages.users.apartments.create', compact('services'));
    }

    // User's apartment created store
    public function apartmentStore(Request $request) {

        // dd($request);

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'baths' => 'required',
            'mq' => 'required',
            'services' => 'nullable',
            // latitude
            // longitude
            'address' => 'required',
            'user_id' => ''
        ]);

        $apartment = Apartment::create($data);

        $services = $request->input('services');
        $apartment -> services() -> sync($services);

        return redirect() -> route('account.apartments.show', $data['user_id']);
    }
}
