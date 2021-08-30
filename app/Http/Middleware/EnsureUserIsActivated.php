<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role == 'Admin') return redirect('/admin/home');
        if(auth()->user()->is_activated == 'Pending') return redirect('/signup-pending');
        if(auth()->user()->is_activated == 'Declined') return redirect('/signup-declined');

        return $next($request); //Activated
    }
}
