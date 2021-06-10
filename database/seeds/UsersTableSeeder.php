<?php

use App\Category;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'=>'Mino',
                'email'=>'mino@gmail.it',
                'password'=>'abcdefghi',
                'p_iva'=>'12345678910',
                'restaurant'=>'Chez Lardì',
                'address'=> 'Viale Rossi 22, 50041 Calenzano (FI)'
            ],
            [
                'name'=>'Tony Starco',
                'email'=>'ciccino89@gmail.it',
                'password'=>'ihgfedcba',
                'p_iva'=>'10987654321',
                'restaurant'=>'Ristorante MariaRosa',
                'address'=> 'Viale Verdi 19, 50019 Sesto Fiorentino (FI)'
            ]

        ];

        foreach ($users as $user) {

            $categories=Category::all();
            
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->password = $user['password'];
            $newUser->p_iva = $user['p_iva'];
            $newUser->restaurant = $user['restaurant'];
            $newUser->address = $user['address'];
            
            $newUser->save();

            $newUser->categories()->attach($categories[rand(0, 5)]);
            
        }
    }
}
