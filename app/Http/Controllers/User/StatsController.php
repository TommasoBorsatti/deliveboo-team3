<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function orders($id)
    {   
        $user = Auth::user();
        return view('admin.orders', compact('user'));
    }
}
