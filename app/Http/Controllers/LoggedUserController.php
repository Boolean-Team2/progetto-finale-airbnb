<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Apartment;

class LoggedUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index');
    }

    public function show($id) {

        $user = User::findOrFail($id);

        return view('pages.users.show', compact('user'));
    }

    public function edit(Request $request, $id) {

        $validator = $request -> validate([
            'firstname' => 'nullable|string|min:3|max:255',
            'lastname' => 'nullable|string|min:3|max:255',
            'date_of_birth' => 'nullable|string|date', 
            'email' => 'email:rfc,dns',
        ]);

        $editedUser = User::findOrFail($id);
        $editedUser -> update($validator);

        return redirect() -> back() -> with('status', 'All informations was edited');
    }

    public function apartmentShow($id) {

        $owner = User::findOrFail($id);

        $apartments = $owner -> apartments;

        return view('pages.users.apartments.show', compact('apartments'));
    }
}
