<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Apartment;
use App\Ad;
use App\User;

use Braintree;
use DateTime;

class AdsController extends Controller
{
    // User show his sponsor payments
    public function userPayments($id) {
        if($id == Auth::user()->id) {
            $user = User::findOrFail($id);
            $total = [];
            foreach ($user->apartments as $apartment) {
                $total[]=$apartment->ads->sum('price');
            }
            $result = array_sum($total);
            return view('pages.users.payments.show', compact('user', 'result'));
        } else {
            return back()->withErrors("You don't have permission to visit this page");
        }
    }

    // User sponsor his apartment
    public function apartmentSponsor($id, $ida){

        $apartment = Apartment::findOrFail($ida);

        if($id == $apartment->user_id) {
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
            $token = $gateway->ClientToken()->generate();
            $ads = Ad::all();
            return view('pages.users.apartments.apartmentSponsor', compact('apartment','ads','token'));
        } else {
            return back()->withErrors('Sei sicuro di voler sponsorizzare un appartamento della concorrenza?');
        }
    }

    public function checkout(Request $request, $id, $ida){
        
        $apartment = Apartment::findOrFail($ida);
      
        if($apartment->user_id == Auth::user()->id) {
                $gateway = new Braintree\Gateway([
                    'environment' => config('services.braintree.environment'),
                    'merchantId' => config('services.braintree.merchantId'),
                    'publicKey' => config('services.braintree.publicKey'),
                    'privateKey' => config('services.braintree.privateKey')
                ]);
            
                $amount = $request->amount;
                $nonce = $request->payment_method_nonce;
            
                $result = $gateway->transaction()->sale([
                    'amount' => $amount,
                    'paymentMethodNonce' => $nonce,
                    'customer' => [
                        'firstName' => 'Tony',
                        'lastName' => 'Stark',
                        'email' => 'tony@avengers.com',
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ]
                ]);
            
                if ($result->success) {
                    $transaction = $result->transaction;
                    $ads = Ad::all();
                    foreach ($ads as $ad) {
                        if($ad->price==$amount){
                            if($amount==2.99){
                                $start = new DateTime();
                                $end = date("Y-m-d H:i:s", time() + 86400);
                                $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end,'active'=>1]);
                            } elseif ($amount==5.99) {
                                $start = new DateTime();
                                $end = date("Y-m-d H:i:s", time() + 259200);
                                $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end,'active'=>1]);
                            }elseif ($amount==9.99) {
                                $start = new DateTime();
                                $end = date("Y-m-d H:i:s", time() + 518400);
                                $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end,'active'=>1]);
                            }
                        }
                    }
                    return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
                } else {
                    $errorString = "";
                    foreach ($result->errors->deepAll() as $error) {
                        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                    }
                    return back()->withErrors('An error occurred with the message: '.$result->message);
                }
        } else {
            return back()->withErrors('Sei sicuro di voler sponsorizzare un appartamento della concorrenza?');
        }
    }
}
