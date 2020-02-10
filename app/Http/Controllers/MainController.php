<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class MainController extends Controller
{
    public function index() {

        $apartments = Apartment::all();
        return view('pages.index', compact('apartments'));
    }
}
