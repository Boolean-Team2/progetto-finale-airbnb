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
use App\View;
use App\Service;
use DB;

class MainController extends Controller
{
    public function index() {

        $apartments = Apartment::join('ad_apartment', 'apartments.id', '=', 'ad_apartment.apartment_id') 
            -> where('apartments.visibility', 1)
            -> where('ad_apartment.active', 1)
            -> orderBy('start_time', 'desc')
            -> get();

        $services = Service::all();
        $sponsoredApartments = [];
 
        foreach ($apartments as $apartment) {

            $finish = Carbon::parse($apartment->end_time);
            $now = Carbon::now();
        
            if($now < $finish) {
                $sponsoredApartments [] = $apartment;
            } else { 
                $idAd = $apartment->id;
                $active=[
                    "active" => 0
                ];
                DB::table('ad_apartment')->where('id', $idAd)->update($active);
            }
        }

        $collection = collect($sponsoredApartments);

        return view('pages.index', compact('sponsoredApartments', 'services', 'collection'));
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
        } else {
            $view = [
                'apartment_id' => $id
            ];
            View::create($view);
        }

        return view('pages.apartments.apartmentShow', compact('apartment'));
    }

    public function sendMail($ida, Request $request) {

        $infoMsg = $request -> validate([
            'email_sender' => 'email:rfc,dns',
            'body' => 'string|min:3|max:255',
            'is_read' => 'nullable',
        ]);

        $infoMsg['apartment_id'] = $ida;
        $infoMsg['is_read'] = 0;

        Message::create($infoMsg);

        $apartment = Apartment::findOrFail($ida);
        Mail::to('miamail@mail.it') -> send(new ContactMail($apartment));

        return redirect() -> back() -> with('status', 'Message was sended');

    }
}
