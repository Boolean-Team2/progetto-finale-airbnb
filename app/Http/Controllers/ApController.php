<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Service;

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

        dd($request);

        return "hello";
    }
}
