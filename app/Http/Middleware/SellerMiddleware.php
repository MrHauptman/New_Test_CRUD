<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; // Ensure you're using the correct Request class here
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
 
        if (Auth::check() && Auth::user()->role_id == 3) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
