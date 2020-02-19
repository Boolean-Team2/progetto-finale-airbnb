<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $userAps = Apartment::all()->where('user_id', $id);

        foreach ($userAps as $apartment) {
            $userMsgs = $apartment->messages;
        }

        return view('pages.users.messages.show', compact('userMsgs'));
    }

    // All user's apartments statistics
    public function apartmentsStatistics($id){

        $user = User::findOrFail($id);
        $userApartments = $user->apartments;

        return view('pages.users.statistics.show', compact('userApartments'));

    }

    // All user's apartment statistics
    public function apartmentStatistics($id){

        // TO DO: Ricerca appartamento e ritorno dei dati nella pagina dedicata

    }

    // User sponsor his apartment
    public function apartmentSponsor($ida){

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();

        $ads = Ad::all();
        $apartment = Apartment::findOrFail($ida);
        return view('pages.users.apartments.apartmentSponsor', compact('apartment','ads','token'));
    }

    public function checkout(Request $request, $ida){
        
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
            $apartment = Apartment::findOrFail($ida);
            foreach ($ads as $ad) {
                if($ad->price==$amount){
                    if($amount==2.99){
                        $start = new DateTime();
                        $end = date("Y-m-d H:i:s", time() + 86400);
                        $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end]);
                    } elseif ($amount==5.99) {
                        $start = new DateTime();
                        $end = date("Y-m-d H:i:s", time() + 259200);
                        $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end]);
                    }elseif ($amount==9.99) {
                        $start = new DateTime();
                        $end = date("Y-m-d H:i:s", time() + 518400);
                        $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end]);
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
    }

    // public function apartmentSponsorPayment($ida, Request $request){

    //     $data = $request->validate([
    //         'price' => 'required',
    //     ]);
    //     $price=$data['price'];
    //     return view('pages.users.apartments.apartmentSponsorPayment', compact('price'));
    // }
}
