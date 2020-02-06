<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/login', function () {
//     $auth = new Auth();
//     return $auth->login();
// });


Route::get('/shop', function () {
    return view("shop");
});

Route::get('/recurent/{authCode}/{email}/{price}', function ( $authCode , $email, $price) {
    /**
    * Todo Bill user with saved auth_code
    * paystack api 
    */
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.paystack.co/transaction/charge_authorization');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"authorization_code\": \"AUTH_4sx5ri1xf1\", \"email\": \"customer@email.com\", \"amount\": 500000}");

    $headers = array();
    $headers[] = 'Authorization: Bearer '.env('PAYSTACK_SK');
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        return response()->json(['status' => 'Error', 'message' => 'unable to bill card'], 400);
    }
    curl_close($ch);

    // return json_decode($result)

    
    if(json_decode($result)->status==false)
    {
        return response()->json(['status' => 'Error', 'message' => 'unable to bill card'], 400);

    }
    return $result;


    return response()->json(['status' => 'Success', 'message' => 'Perfect you billed the nigga again!!!!'], 200);


});


Route::get('/buyme/{ref}', function ($ref) {
   /**
    * Todo Verify transaction as sucessfull,  * done
    * Verify transaction amount is for the item (security - ish) *done
    * Add recurrent payment
    * Return response
    */
    $users = [];

    $demoPrice = 1000 * 100;
    $demoUserId = 1;

    $curl = curl_init();
     if(!$ref){
        return response()->json(['status' => 'error', 'message' => 'Faulty  transaction, contanct us'], 400);
    }

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer ".env('PAYSTACK_SK')  ,
        "cache-control: no-cache"
    ],
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if($err){
        // there was an error contacting the Paystack API
        return response()->json(['status' => 'error', 'message' => 'Faulty  transaction, contanct us'], 400);
    }

    $tranx = json_decode($response);

    if(!$tranx->status){
    // there was an error from the API
    return response()->json(['status' => 'error', 'message' => 'Faulty  transaction, contanct us'], 400);
}

    if('success' == $tranx->data->status){
    // transaction was successful...
        
    if( $demoPrice === $tranx->data->amount ){
        //add the authorization code to db with static user
        $authCode = $tranx->data->authorization->authorization_code;
        $userDetails =  new \stdClass();
        $userDetails->user = $demoUserId;
        $userDetails->authCode = $authCode;
        array_push( $users,$userDetails );

        return response()->json(['status' => 'Success', 'message' => 'Perfect you just purchased a Health insurance from us!!'], 200);
    }

    else{
        return response()->json(['status' => 'error', 'message' => 'Faulty  transaction, contanct us'], 400);
    }

    }

    else{
        //transaction failed transacrion
        return response()->json(['status' => 'error', 'message' => 'Failed transaction'], 400);
    }
    });


