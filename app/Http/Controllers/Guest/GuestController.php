<?php

namespace App\Http\Controllers\Guest;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function searchCat()
    {
        $users = User::all();
        $categories = Category::all();
        return view('guest.index', compact('users', 'categories'));
    }

    public function show($id)
    {

        $restaurant = User::find($id);
        return view('guest.show', compact('restaurant'));
    }
    
}
