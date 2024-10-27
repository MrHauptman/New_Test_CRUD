<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class SellerController extends Controller
{
    public function dashboard($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return Inertia::render('Seller/Dashboard');
    }
}
