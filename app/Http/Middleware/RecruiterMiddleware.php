<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RecruiterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
       
        if (!$user) {
            return redirect()->route('login')->with('error', 'Access denied. Recruiter profile required.');
        }else if (!$user->recruiter) {
            return redirect()->route('recruiter.complete.profile')->with('error', 'Please complete your recruiter profile to access this page.');
        }


       
        return $next($request);
    }
}
