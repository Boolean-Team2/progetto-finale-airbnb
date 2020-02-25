<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\User;
use App\Service;
use App\Apartment;

class ApController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // User's apartments show
    public function apartmentsShow($id) {
        if($id == Auth::user()->id) {
            $owner = User::findOrFail($id);
            $apartments= new Apartment;
            $apartments = $owner -> apartments;

            $apartmentsAdActive = [];
            $apartmentsAdNotActive= [];
            
            foreach ($apartments as $apartment) {

                $idApp = $apartment->id;
                
                $ad = Apartment::join('ad_apartment', 'apartments.id', '=', 'ad_apartment.apartment_id')
                -> where('apartment_id', $idApp)
                -> where('ad_apartment.active',1)
                -> get();

                if($ad->count()){
                    foreach ($ad as $a) {
                        $apartmentsAdActive[]=$a;
                    }
                } else{
                    $apartmentsAdNotActive[]=$apartment;
                }
            }

            return view('pages.users.apartments.show', compact('apartmentsAdActive','apartmentsAdNotActive'));
        } else {
            return back()->withErrors('Non puoi vedere questa pagina');
        }

    
        $apartments = Apartment::join('ad_apartment', 'apartments.id', '=', 'ad_apartment.apartment_id') 
            -> where('apartments.visibility', 1)
            -> where('apartments.sponsored', 1)
            -> where('ad_apartment.active',1)
            -> where('apartment_id', $idApp)
            -> orderBy('start_time', 'desc')
            -> get();

        dd($apartments);
        // $messages = Message::select('id', 'created_at','apartment_id')
        // ->where('apartment_id', $idApp) //Colonna=valore
        // ->get()
        // ->groupBy(function($date) {
        //     return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // });
        // return view('pages.users.apartments.show', compact('apartments'));
    }
    
    // User's apartments create
    public function apartmentCreate() {

        $services = Service::all();

        return view('pages.users.apartments.create', compact('services'));
    }

    // User's apartment created store
    public function apartmentStore(Request $request) {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'baths' => 'required',
            'mq' => 'required',
            'img' => 'nullable',
            'services' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'visibility' => 'required',
            'sponsored' => '',
            'user_id' => ''
        ]);

        $data['sponsored'] = 0;

        $apartment = Apartment::create($data);

        if(isset($data['img'])) {

            // Mi salvo il nome del file
            $fileName = $data['img'] -> getClientOriginalName();
    
            // Salvo il file nella cartella "public/assets/images/users/{id_user}/apartments/{apartment->id/nomefile.ext"
            $data['img'] -> move('assets/images/users/' . $apartment['user_id'] . '/apartments/' . $apartment->id , $fileName);

            // Inserisco il nome dell'immagine nel campo della tabella
            $apartment['img'] = $fileName;

            // Salvo nuovamente l'appartamente in caso di inserimento dell'immagine
            $apartment->save();
        }

        $services = $request->input('services');
        $apartment -> services() -> sync($services);

        return redirect() -> route('account.apartment.edit', $apartment['id']) -> with('status', 'Apartment created with success');
    }

    // User's apartment edit
    public function apartmentEdit($id) {

        $apartment = Apartment::findOrFail($id);
        $services = Service::all();
        return view('pages.users.apartments.edit', compact('apartment', 'services'));

    }

    // User's apartment edit
    public function apartmentUpdate(Request $request, $id) {

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'baths' => 'required',
            'mq' => 'required',
            'img' => 'nullable',
            'services' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'visibility' => 'required',
            'user_id' => ''
        ]);

        $apartment = Apartment::findOrFail($id);
        $apartment -> update($data);

        if(isset($data['img'])) {
            // Mi salvo il nome del file
            $fileName = $data['img'] -> getClientOriginalName();
            // Salvo il file nella cartella "public/assets/images/users/{id_user}/apartments/{apartment->id/nomefile.ext"
            $data['img'] -> move('assets/images/users/' . $apartment['user_id'] . '/apartments/' . $apartment->id , $fileName);
            // Inserisco il nome dell'immagine nel campo della tabella
            $apartment['img'] = $fileName;
            // Salvo nuovamente l'appartamente in caso di inserimento dell'immagine
            $apartment->save();
                        
        }

        $services = $request->input('services');
        $apartment -> services() -> sync($services);

        return redirect() -> route('account.apartments.show', $data['user_id']) -> with('status', 'Apartment was edited with success');

    }
    
}
