<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Ad;
use App\User;

class LoggedUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // User show
    public function show($id) {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

    // User edit
    public function edit(Request $request, $id) {

        $validator = $request -> validate([
            'firstname' => 
                [
                    'nullable',
                    'min:3',
                    'max:255',
                    'regex:/^[a-zA-Z]*([a-zA-Z]|[a-zA-Z])[a-zA-Z]*$/'
                ],
            'lastname' => 
                [
                    'nullable',
                    'min:3',
                    'max:255',
                    'regex:/^[a-zA-Z]*([a-zA-Z]|[a-zA-Z])[a-zA-Z]*$/'
                ],
            'date_of_birth' => 'nullable|string|date', 
            'email' => 'email:rfc,dns',
            'avatar' => 'nullable|dimensions:ratio=1/1|mimes:jpeg|max:1024',
        ]);

        if(isset($validator['avatar'])) {
            $fileName = $validator['avatar'] -> getClientOriginalName();
            $validator['avatar'] -> move('assets/images/users/' . $id . '/avatar/', $fileName);
            $validator['avatar'] = $fileName;
        }

        $editedUser = User::findOrFail($id);
        $editedUser -> update($validator);

        return redirect() -> back() -> with('status', 'All informations was edited');
    }

}
