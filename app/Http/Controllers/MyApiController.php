<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Service;
use App\Message;
use App\User;
use App\View;
use Carbon\Carbon;

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

        $apartments = $apartments -> where('visibility', 1) -> get();
                
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
        array_multisort($distance, SORT_ASC, $apps);

        return response() -> json(compact('apps'));
    }

    public function messagesStatistic(Request $request){
        $idApp = $request['id'];

        $messages = Message::select('id', 'created_at','apartment_id')
        ->where('apartment_id', $idApp) //Colonna=valore
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $messagesMonthCount = [];
        $messagesForMonth = [];

        foreach ($messages as $key => $value) {
            $messagesMonthCount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($messagesMonthCount[$i])){
                $messagesForMonth[] = $messagesMonthCount[$i];    
            }else{
                $messagesForMonth[] = 0;    
            }
        }

        return response()->json(compact('messagesForMonth'));

    }

    public function viewsStatistics(Request $request){
        $idApp = $request['id'];

        $views = View::select('id', 'created_at','apartment_id')
        ->where('apartment_id', $idApp) //Colonna=valore
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $viewsMonthCount = [];
        $viewsForMonth = [];

        foreach ($views as $key => $value) {
            $viewsMonthCount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            if(!empty($viewsMonthCount[$i])){
                $viewsForMonth[] = $viewsMonthCount[$i];    
            }else{
                $viewsForMonth[] = 0;    
            }
        }

        return response()->json(compact('viewsForMonth'));
    }
}
