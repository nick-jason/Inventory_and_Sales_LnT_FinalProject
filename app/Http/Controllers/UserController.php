<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showProfile(){
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function updateUser(Request $req){
        $req->validate([
            'address' => 'nullable|string|min:10|max:100',
            'postal_code' => 'nullable|string|digits:5',
        ]);

        $user = auth()->user();
        $user->address = $req->address;
        $user->postal_code = $req->postal_code;

        $user->save();
        return redirect('/');
    }
}