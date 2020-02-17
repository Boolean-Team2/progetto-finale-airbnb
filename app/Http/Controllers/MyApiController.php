<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class MyApiController extends Controller
{
    // Apartments show API
    public function showApartmentsApi(Request $request) {

        $apartments = Apartment::all();

        $lat1 = $request['lat'];
        $lon1 = $request['lon'];
        $radius = $request['radius'];
        $beds = $request['beds'];
        $rooms = $request['rooms'];
        $services = $request['services'];

        $apps = [];
        
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
                if ($km <= $radius && $apartament['beds'] == $beds && $apartament['rooms'] == $rooms) {
                    // Check sui servizi ricevuti in input
                    if(!empty($services)) { // se pieno .. 
                        // Prendo tutti i servizi dell'appartamento e li ciclo
                        $apServices = $apartament->services;
                        foreach ($apServices as $apService) {
                            // check sui valori dei due array
                            if(in_array($apService['id'], $services) && !in_array($apartament, $apps)) {
                                $apps[] = $apartament;
                            }
                        }
                    } else { // altrimenti ..
                        $apps[] = $apartament;
                    }
                }
            }
        };
        return response() -> json(compact('apps'));
    }
}
