<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Plate;
use Illuminate\Http\Request;

class PlatesController extends Controller
{
    public function getPlates(Request $request)
    {
        $plates = Plate::where('user_id', $request->id)
        ->where('available', 1)
        ->get();

        //Associazione dei Types ai Plates
        foreach ($plates as $plate) {
           
            $plate['types'] = $plate->types;
        }

        return response()->json($plates);
    }

    public function getPlatesTypes(Request $request)
    {
        $plates = Plate::where('user_id', $request->id)
        ->where('available', 1)
        ->get();
        $platesFind = collect();
        //Associazione dei Types ai Plates
        foreach ($plates as $plate) {
           
            $plate['types'] = $plate->types;
            foreach ($plate->types as $type){
                if ( $type->name == $request->type) {
                    $platesFind->add($plate);
                }
            } 
        }

        return response()->json($platesFind);
    }
}
