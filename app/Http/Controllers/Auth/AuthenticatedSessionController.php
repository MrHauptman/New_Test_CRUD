<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        
        // $this->validateLogin($request);
    
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
    
                if (Auth::check() && Auth::user()->role_id == 1) {
                            return redirect()->route('moderator.dashboard', ['slug'=>$user->slug]);
                        } elseif (Auth::check() && Auth::user()->role_id == 2) {
                            return redirect()->route('user.dashboard', ['slug'=>$user->slug]);
                        } elseif (Auth::check() && Auth::user()->role_id == 3) {
                            return redirect() -> route("seller.dashboard", ['slug'=>$user->slug]);
                        }
                        else {
                            return redirect()->route('user.dashboard', ['slug' => $user->slug]);
                        }
        }
        
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
        
        $this->validateLogin($request);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
 
    // public function __construct()
    // {
    //     if (Auth::check() && Auth::user()->role_id == 1) {
    //         $this->redirectTo = route("moderator.dashboard");
    //     } elseif (Auth::check() && Auth::user()->role_id == 2) {
    //         $this->redirectTo = route("user.dashboard");
    //     } elseif (Auth::check() && Auth::user()->role_id == 3) {
    //         $this->redirectTo = route("seller.dashboard");
    //     }
 
    //     $this->middleware("guest")->except("logout");
    // }
    

}