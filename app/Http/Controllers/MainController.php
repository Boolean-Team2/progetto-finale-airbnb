<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class MainController extends Controller
{
    public function index() {

        $appartments = Apartment::all();
        return view('pages.index', compact('appartments'));
    }
}
