<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Apartment;
use App\Message;
use App\Service;
use App\View;

class MainController extends Controller
{
    public function index() {

        $services = Service::all();
        $apartments = Apartment::where('apartments.visibility', 1) ->where('apartments.sponsored', 1) ->get();

        $sponsoredApartments = [];
 
        foreach ($apartments as $apartment) {
            $adsApp = $apartment -> ads;
            $endTimes = [];
            foreach ($adsApp as $adApp) {
                $adEndTime = $adApp -> pivot -> end_time;
                $endTimes[]= $adEndTime;
            }
            $maxEnd = max($endTimes);
            
            $finish = Carbon::parse($maxEnd);
            $now = Carbon::now();

                if ($now < $finish) {
                    $sponsoredApartments[] = $apartment;
                } else {
                    $sponsor = [
                        "sponsored" => 0
                    ];
                    $apartment->update($sponsor);
                }

        }

        return view('pages.index', compact('sponsoredApartments', 'services'));
    }

    // Apartment details show
    public function apartmentShow($id) {

        $apartment = Apartment::findOrFail($id);
        $viewsDB = $apartment -> views;

        // Le views non aumentano se lo visita il proprietario
        if(Auth::user()) {
            if(Auth::user()->id !== $apartment->user_id){
                $view = [
                    'apartment_id' => $id
                ];
                View::create($view);
            }
        }

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
