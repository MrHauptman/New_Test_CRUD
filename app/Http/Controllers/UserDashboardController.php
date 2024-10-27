<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Inertia\Inertia;

class UserDashboardController extends Controller
{
    public function dashboard($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return Inertia::render('User/Dashboard');
    }
}
