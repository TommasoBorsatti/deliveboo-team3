<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\Plate;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getOrders(Request $request)
    {
        $plates = Plate::where('user_id', $request->id)
        ->get();
        $orders = Order::all();
        
        $ordersFind = collect();
        //Associazione degli Orders ai Plates
        foreach ($orders as $order) {
            $order['plates'] = $order->plates;
            foreach ($order['plates'] as $plate) {
                
                if ($plate->user_id == $request->id) {
                   $ordersFind->add($order);
                }
            }
        }
        
        return response()->json($ordersFind);
    }
}
