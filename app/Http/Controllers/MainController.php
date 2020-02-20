<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Apartment;
use App\Message;
use App\Service;

class MainController extends Controller
{
    public function index() {

        $apartments = Apartment::join('ad_apartment', 'apartments.id', '=', 'ad_apartment.apartment_id') 
            -> where('apartments.visibility', 1)
            -> orderBy('start_time', 'desc')
            -> get();
        $services = Service::all();

        foreach ($apartments as $apartment) {
            $finish = Carbon::parse($apartment->end_time);
            $now = Carbon::now();

            if($now < $finish) {
                $sponsoredApartments [] = $apartment;
            }
        }

        return view('pages.index', compact('sponsoredApartments', 'services'));
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
