<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;
use App\Message;
use App\User;

class MyApiController extends Controller
{
    // Apartments show API
    public function showApartmentsApi(Request $request) {

        $lat1 = $request['lat'];
        $lon1 = $request['lon'];
        $radius = $request['radius'];
        $beds = $request['beds'];
        $rooms = $request['rooms'];
        $services = $request['services'];

        $apps = [];

        // Filtrare la query all'inizio
        $apartments = new Apartment();

        // Controlli sui filtri che arrivano dall'input
        if($beds) {
            $apartments = $apartments->where('beds', '>=', $beds);
        }
        if($rooms) {
            $apartments = $apartments->where('rooms', '>=', $rooms);
        }

        $apartments = $apartments -> where('visibility', 1) -> orderBy('sponsored', 'desc') -> get();
                
        foreach ($apartments as $apartament) {
            $lat2 = $apartament['latitude'];
            $lon2 = $apartament['longitude'];

            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            } else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $km = $miles * 1.609344;

                // Check su distanza, numero di letti e stanze
                if ($km <= $radius && !empty($services)) {
                    $apartament['km'] = $km;
                    
                    // Prendo tutti i servizi dell'appartamento e li ciclo
                    $apServices = $apartament->services;

                    // Azzero gli array da usare per il confronto ad ogni giro
                    $intersectServices = [];
                    $array = [];
                    
                    // Creo l'array di id dei servizi
                    foreach ($apServices as $apService) {
                        $array [] = $apService['id'];
                    }
                    
                    // check sui valori dei due array
                    $intersectServices = array_intersect($services, $array);

                    // Check sui servizi ricevuti in input
                    if((count(array_unique(array_merge($intersectServices, $services))) === count($intersectServices)) && !in_array($apartament, $apps)) {
                        $apps[] = $apartament;
                    }
                } 
                else if($km <= $radius && empty($services)) {
                    $apartament['km'] = $km;
                    $apps[] = $apartament;
                }
            }
        }

        // Ordinazione array per sponsorizzati e distanza
        $distance = array_column($apps, 'km');
        $sponsor = array_column($apps, 'sponsored');
        array_multisort($sponsor, SORT_DESC, $distance, SORT_ASC, $apps);

        return response() -> json(compact('apps'));
    }

    public function myApStatistic(Request $request){
        $idApp = $request['id'];
        
        $apartament = Apartment::findOrFail($idApp);
        $messages = $apartament-> messages;

        // return $messages;

        // $results = $messages 
        //     ->selectRaw('extract(month from messages.created_at) as month')
        //     ->groupBy('month')
        //     -> get();

        $results = $messages->whereRaw('extract(month from created_at)') -> get();
        
        return $results;
            // ->pluck('messages', 'month');

        // return $results;

        // $results = Message::all()
        //     ->where('messages.apartament_id', $idApp)
        //     ->selectRaw('count(*) as messages, extract(month from messages.created_at) as month');
            // ->groupBy('month')
            // ->pluck('messages', 'month');
            // -> 
            // ->leftjoin('apartaments', 'message.apartament_id', '=', 'apartament.id')

        // $finalResults = array_replace(array_fill_keys(range(1, 12), 0), $results->all());

        // return $finalResults;
        
        

        // return response()->json(compact('finalResults'));


    }
}
