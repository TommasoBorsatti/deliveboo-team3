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

        return response()->json($plates);
    }
}
