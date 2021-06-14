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
        
        $restaurantsFind = collect();
        // aggiungiamo il campo categories ad ogni ristorante nel file json
        foreach ($restaurants as $restaurant)
        {
            // $restaurant['categories'] = $restaurant->categories;
            
            if ($restaurant->categories->contains('id', $request->category)) {
                
                $restaurantsFind->add($restaurant);
            }
            
        }
        
        // $restaurants->categories->contains($request->category);
        //Response in Json
        
        return response()->json($restaurantsFind);
    }
}
