<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Apartment;
use App\Message;
use App\Service;

class MainController extends Controller
{
    public function index() {
        $apartments = Apartment::all()->where('visibility', '=', 1);
        $services = Service::all();
        return view('pages.index', compact('apartments', 'services'));
    }

    // Apartment details show
    public function apartmentShow($id) {

        $apartment = Apartment::findOrFail($id);

        $viewsDB = $apartment -> views; 

        $views=[
            "views" => $viewsDB + 1
        ];

        $apartment -> update($views);
        
        return view('pages.apartments.apartmentShow', compact('apartment'));
    }

    public function sendMail($ida, Request $request) {

        $infoMsg = $request -> validate([
            'email_sender' => 'email:rfc,dns',
            'body' => 'string|min:3|max:255',
        ]);

        $infoMsg['apartment_id']= $ida;

        Message::create($infoMsg);

        $apartment = Apartment::findOrFail($ida);
        Mail::to('miamail@mail.it') -> send(new ContactMail($apartment));

        return redirect() -> back() -> with('status', 'Message was sended');

    }
}
