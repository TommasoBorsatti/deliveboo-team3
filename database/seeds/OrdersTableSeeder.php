<?php

use App\Order;
use App\Plate;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [   
                'total' => 5.50,
                'name_ui' => 'Roberto',
                'lastname_ui' => 'Morbidozzi',
                'email_ui' => 'robi88@gmail.it',
                'phone_ui' => '3333333333',
                'address_ui' => 'Viale Giacomelli 11, 50041 Calenzano (FI)',
                'status' => 'success'
            ],
            [   
                'total' => 8,
                'name_ui' => 'Gianni',
                'lastname_ui' => 'Topampa',
                'email_ui' => 'giannisuper@gmail.it',
                'phone_ui' => '22222222222',
                'address_ui' => 'Viale Mazzini 1, 50041 Calenzano (FI)',
                'status' => 'unsuccess'
            ]

        ];

        foreach ($orders as $order) {

            $plates=Plate::all();
            
            $newOrder = new Order();
            $newOrder->total = $order['total'];
            $newOrder->name_ui = $order['name_ui'];
            $newOrder->lastname_ui = $order['lastname_ui'];
            $newOrder->email_ui = $order['email_ui'];
            $newOrder->phone_ui = $order['phone_ui'];
            $newOrder->address_ui = $order['address_ui'];
            $newOrder->status = $order['status'];
            
            $newOrder->save();

            $newOrder->plates()->attach($plates[rand(0, 1)]);
        }
    }
}


