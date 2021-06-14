<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SearchCatController extends Controller
{
    public function getAll(Request $request)
    {   
        $restaurants = User::all();

        // aggiungiamo il campo categories ad ogni ristorante nel file json
        foreach ($restaurants as $restaurant)
        {
            $restaurant['categories'] = $restaurant->categories;
        }
        //Response in Json
        
        return response()->json($restaurants);
    }
}
