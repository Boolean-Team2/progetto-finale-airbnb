<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\User;

class StatisticsController extends Controller
{
    // All user's apartments statistics
    public function apartmentsStatistics($id){
        if($id == Auth::user()->id) {
            $user = User::findOrFail($id);
            $userApartments = $user->apartments;
            return view('pages.users.statistics.show', compact('userApartments'));
        } else {
            return back()->withErrors("You don't have permission to visit this page");
        }
    }

    // All user's apartment statistics
    public function apartmentStatistics($id, $ida){
        $apartment = Apartment::findOrFail($ida);
        if($id == $apartment->user_id && $id == Auth::user()->id) {
            return view('pages.users.apartments.statistics', compact('apartment'));
        } else {
            return back()->withErrors("You don't have permission to visit this page");
        }
    }
}
