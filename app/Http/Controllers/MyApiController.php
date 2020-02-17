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
                if ($km <= $radius) {
                    $apps[] = $apartament; 
                }
                
            }
        };
        
        return response() -> json(compact('apps'));
  
    }

}
