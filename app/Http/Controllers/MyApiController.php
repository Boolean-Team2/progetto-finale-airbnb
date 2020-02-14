<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;

class MyApiController extends Controller
{
    // Apartments show API
    public function showApartmentsApi() {
        $apartments = Apartment::all();
        return response() -> json(compact('apartments'));
    }

    // // https://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php
    // public function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius) {
    //     $latFrom = deg2rad($latitudeFrom);
    //     $lonFrom = deg2rad($longitudeFrom);
    //     $latTo = deg2rad($latitudeTo);
    //     $lonTo = deg2rad($longitudeTo);

    //     $lonDelta = $lonTo - $lonFrom;
    //     $a = pow(cos($latTo) * sin($lonDelta), 2) +
    //     pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    //     $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    //     $angle = atan2(sqrt($a), $b);
    //     return $angle * $earthRadius;
    // }

    // // https://gist.github.com/LucaRosaldi/5676464
    // $point1 = array('lat' => 40.770623, 'long' => -73.964367);
    // $point2 = array('lat' => 40.758224, 'long' => -73.917404);

    // $distance = getDistanceBetweenPoints($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
    // foreach ($distance as $unit => $value) {
    //     echo $unit.': '.number_format($value,4).'<br />';
    // }

    // function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
    //     $theta = $lon1 - $lon2;
    //     $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    //     $miles = acos($miles);
    //     $miles = rad2deg($miles);
    //     $miles = $miles * 60 * 1.1515;
    //     $feet = $miles * 5280;
    //     $yards = $feet / 3;
    //     $kilometers = $miles * 1.609344;
    //     $meters = $kilometers * 1000;
    //     return compact('miles','feet','yards','kilometers','meters'); 
    // }

}
