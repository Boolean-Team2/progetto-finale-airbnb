<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class MainController extends Controller
{
    public function index() {

        $apartments = Apartment::paginate(4);
        return view('pages.index', compact('apartments'));
    }
}
