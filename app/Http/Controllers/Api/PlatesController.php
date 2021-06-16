<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Plate;
use Illuminate\Http\Request;

class PlatesController extends Controller
{
    public function getPlates(Request $request)
    {
        $plates = Plate::where('user_id', $request->id)->get();

        return response()->json($plates);
    }
}
