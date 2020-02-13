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

    // User show
    public function show($id) {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

    // User edit
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

    // User messages show
    public function messagesShow($id) {

        $user = User::findOrFail($id);
        $userAps = Apartment::all()->where('user_id', '=', $id);

        foreach ($userAps as $apartment) {
            $userMsgs = $apartment->messages;
        }

        return view('pages.users.messages.show', compact('userMsgs'));
    }

    public function apartmentStatistics($ida){

        $apartment = Apartment::findOrFail($ida);
        return view('pages.users.apartments.apartmentStatistics', compact('apartment'));
    }
}
