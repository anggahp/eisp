<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!(Auth::user()->user_grp == 'cust' || Auth::user()->user_type == 'admin')) {
            // user value cannot be found in session
            return redirect()->back();
        }

        return $next($request);
    }
}
