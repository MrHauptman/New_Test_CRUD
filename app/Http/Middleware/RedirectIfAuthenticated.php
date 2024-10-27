<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // if (Auth::guard($guards)->check() && Auth::user()->role_id == 1) {
        //     return redirect()->route("moderator.dashboard.{slug}");
        // } elseif (Auth::guard($guards)->check() && Auth::user()->role_id == 2) {
        //     return redirect()->route("user.dashboard");
        // } elseif(Auth::guard($guards)->check() && Auth::user()->role_id == 3) {
        //     return redirect()->route("seller.dashboard");
        // } else {
        //     return $next($request);
        // }
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // return redirect(RouteServiceProvider::HOME);
                $user = Auth::user();
                if ($user->role_id === 1) { // Moderator
                    return redirect()->route('moderator.dashboard', ['slug' => $user->slug]);
                } elseif ($user->role_id === 3) { // Seller
                    return redirect()->route('seller.dashboard', ['slug' => $user->slug]);
                } else { // Default to User
                    return redirect()->route('user.dashboard', ['slug' => $user->slug]);
                }
            }
        }

        return $next($request);
    }

        
}
