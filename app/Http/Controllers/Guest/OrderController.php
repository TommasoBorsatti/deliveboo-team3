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
    protected $validation = [
        'name_ui' => 'required|string|max:50',
        'lastname_ui' => 'required|string|max:50',
        'email_ui' => 'required', 'string', 'email', 'max:50',
        'address_ui' => 'required|string|max:125',
        'phone_ui' => 'required|numeric',
        'total' => 'required',
    ];


    public function checkout($id, Gateway $gateway)
    {       
        
        $token = $gateway->ClientToken()->generate();
        $restaurant = User::find($id)->first();

        return view('guest.checkout', compact('restaurant', 'token'));
    }

    public function checkoutStore(Request $request, Gateway $gateway)
    {   
        $validation = $this->validation;

        // validation
        $request->validate($validation);

        $data = $request->all();
        $data['total'] = floatval($request->total);
        $data['plates'] = $request->plate_id;

        // creazione nuovo ordine
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
