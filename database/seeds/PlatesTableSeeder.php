<?php

use App\Plate;
use Illuminate\Database\Seeder;

class PlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $plates = [
            [   
                'name'=>'Acqua Minerale 0.5 l',
                'price'=>2,
                'available'=>1,
                'description'=>'Bottiglietta di Acqua Minerale',
                'plate_img'=>'https://dzpybaqldk5xx.cloudfront.net/prod/spree/758/products/325/product/0_5L_naturale.jpg?1587541380',
            ],
            [   
                'name'=>'Coca Cola 0 33cl',
                'price'=>2.5,
                'available'=>'0',
                'description'=>'Lattina di Coca Cola 0',
                'plate_img'=>'https://cdn.craispesaonline.it/apps/images/catalog/eg-0006562/eg-0006562_1_big.jpg',
            ]
        ];

        foreach ($plates as $plate) {
            $newPlate = new Plate();
            $newPlate->user_id = rand(1, 2);
            $newPlate->name = $plate['name'];
            $newPlate->price = $plate['price'];
            $newPlate->available = $plate['available'];
            $newPlate->description = $plate['description'];
            $newPlate->plate_img = $plate['plate_img'];

            $newPlate->save();
        }

    
    }
}
