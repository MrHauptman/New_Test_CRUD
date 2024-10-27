<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestConontroller extends Controller
{
    public function dashboard($slug){
        $user = User::where('slug', $slug)->firstOrFail();
        return view('test.dashboard', compact('user'));

    }
}
