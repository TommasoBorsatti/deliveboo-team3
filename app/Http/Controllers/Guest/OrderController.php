<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Guest;
use App\Mail\SendOrderMail;
use App\Order;
use App\Plate;
use Braintree\Gateway;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout($id)
    {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $token = $gateway->ClientToken()->generate();

        $restaurant = User::find($id)->first();

        return view('guest.checkout', compact('restaurant', 'token'));
    }

    public function checkoutStore(Request $request)
    {
        dd($request->all());
        $data = $request->all();
        $data['total'] = 15;
        $data['plates'] = [ 3, 7];

        $newOrder = new Order();
        $newOrder->name_ui = $data['name_ui'];
        $newOrder->lastname_ui = $data['lastname_ui'];
        $newOrder->email_ui = $data['email_ui'];
        $newOrder->address_ui = $data['address_ui'];
        $newOrder->phone_ui = $data['phone_ui'];
        $newOrder->total = $data['total'];
        $newOrder->status = 'success';
        $newOrder->save();
        
        $newOrder->plates()->attach($data['plates']);

        Mail::to($newOrder->email_ui)->send(new SendOrderMail($newOrder));

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $data['total'],
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        

        return view('guest.success');
    }
}
