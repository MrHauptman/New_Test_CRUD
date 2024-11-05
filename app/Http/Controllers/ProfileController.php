<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ChangeUserRoleRequest;
use App\Http\Requests\RefillBalanceRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function changeMode(ChangeUserRoleRequest $request): RedirectResponse
    {       

            $user = $request->user();
          //  dd($user);
            if($user->role_id == 2)
            {
            $user->role_id = $request->input('role_id', 3);
        
            if ($user->isDirty('role_id')) {
                $user->save();
            } else {
                Log::warning('Role ID not changed', ['user_id' => $user->id]);
            }
        
            return Redirect::route('profile.edit')->with('status', 'Role updated successfully!');
            } elseif($user->role_id == 3)
            {
            $user->role_id = $request->input('role_id', 2);
        
            if ($user->isDirty('role_id')) {
                $user->save();
            } else {
            }
        
            return Redirect::route('profile.edit')->with('status', 'Role updated successfully!');
                }            
    }
        public function refillBalance(RefillBalanceRequest $request)
        {
            $user = $request->user();
            $user->balance += $request->input('balance',20);
            $amount = $request->input('balance');
            $user->save();
            
            return response()->json(['message' =>'Balance updated'], 200);
            

        }
        public function BalanceForm(){
            return Inertia::render("Profile/Balance");
        }
        
        }
