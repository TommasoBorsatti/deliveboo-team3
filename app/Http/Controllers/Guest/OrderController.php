<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Guest;
use App\Mail\SendOrderMail;
use App\Order;
use App\Plate;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function checkout($id)
    {
        $restaurant = User::find($id)->first();

        return view('guest.checkout', compact('restaurant'));
    }

    public function checkoutStore(Request $request)
    {
        
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
        

        return view('guest.success');
    }
}
