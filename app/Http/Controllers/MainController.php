<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class MainController extends Controller
{
    public function index() {

        // fare query per appartamenti sponsorizzati, aggiungere campo nel db$authorId = 956;

        $apartments = Apartment::orderBy('id', 'DESC')->paginate(4);
        return view('pages.index', compact('apartments'));
    }

    // Apartment details show
    public function apartmentShow($id) {
        $apartment = Apartment::findOrFail($id);
        return view('pages.apartments.apartmentShow', compact('apartment'));
    }
}
