<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;


class ModeratorController extends Controller
{
    public function dashboard($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $users = User::where('role_id', 2)->get();
        $sellers = User::where('role_id', 3)->get();

        return Inertia::render('Moderator/Dashboard',['users'=>$users, 'sellers'=>$sellers]);
        
    }
}
