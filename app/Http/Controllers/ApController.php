<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;
// use Illuminate\Filesystem\Filesystem;

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
    public function apartmentShow($id) {

        $owner = User::findOrFail($id);

        $apartments = $owner -> apartments;

        return view('pages.users.apartments.show', compact('apartments'));
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
            'user_id' => ''
        ]);

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

        // dd($request);

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
            'user_id' => ''
        ]);

        $apartment = Apartment::findOrFail($id);

        $services = $request->input('services');

        $apartment -> update($data);

        $apartment -> services() -> sync($services);

        return redirect() -> route('account.apartments.show', $data['user_id']);

    }


    
}
