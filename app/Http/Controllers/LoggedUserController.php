<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Apartment;
use App\Ad;
use Braintree;
use DateTime;

class LoggedUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index');
    }

    // User show
    public function show($id) {
        $user = User::findOrFail($id);
        return view('pages.users.show', compact('user'));
    }

    // User edit
    public function edit(Request $request, $id) {

        $validator = $request -> validate([
            'firstname' => 'nullable|string|min:3|max:255',
            'lastname' => 'nullable|string|min:3|max:255',
            'date_of_birth' => 'nullable|string|date', 
            'email' => 'email:rfc,dns',
        ]);

        $editedUser = User::findOrFail($id);
        $editedUser -> update($validator);

        return redirect() -> back() -> with('status', 'All informations was edited');
    }

    // User messages show
    public function messagesShow($id) {
        if($id == Auth::user()->id) {
            $userAps = Apartment::all()->where('user_id', $id);
            $userMsgs = [];
            foreach ($userAps as $apartment) {
                $userMsgs [] = $apartment->messages;
            }
            return view('pages.users.messages.show', compact('userMsgs'));
        } else {
            return back()->withErrors('Non puoi vedere questa pagina');
        }
    }

    // All user's apartments statistics
    public function apartmentsStatistics($id){
        if($id == Auth::user()->id) {
            $user = User::findOrFail($id);
            $userApartments = $user->apartments;
            return view('pages.users.statistics.show', compact('userApartments'));
        } else {
            return back()->withErrors('Non puoi vedere questa pagina');
        }
    }

    // All user's apartment statistics
    public function apartmentStatistics($id, $ida){
        $apartment = Apartment::findOrFail($ida);
        if($id == $apartment->user_id && $id == Auth::user()->id) {
            return view('pages.users.apartments.statistics', compact('apartment'));
        } else {
            return back()->withErrors('Non puoi vedere questa pagina');
        }
    }

    // User show his sponsor payments
    public function userPayments($id) {
        if($id == Auth::user()->id) {
            $user = User::findOrFail($id);
            return view('pages.users.payments.show', compact('user'));
        } else {
            return back()->withErrors('Non puoi vedere questa pagina');
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

        // Richiamare pivot table
        $apartment = Apartment::findOrFail($ida);
        // $ads = $apartment->ads()->where('apartment_id', $ida)->firstOrFail();
      
        if($apartment->user_id == Auth::user()->id) {

            // if($apartment->ads()->active == 0) {
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
                    // header("Location: transaction.php?id=" . $transaction->id);

                    // Sponsorizzare appartamento
                    $ads = Ad::all();
                    // $apSponsor = $apartment -> sponsored; 
                    // $apSponsor=[
                    //     "sponsored" => 1
                    // ];
                    // $apartment -> update($apSponsor);
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
            
                    // $_SESSION["errors"] = $errorString;
                    // header("Location: index.php");
                    return back()->withErrors('An error occurred with the message: '.$result->message);
                }
            // } else {
            //     return back()->withErrors('Hai già una sponsorizzazione attiva');
            // }
        } else {
            return back()->withErrors('Sei sicuro di voler sponsorizzare un appartamento della concorrenza?');
        }
    }
}
