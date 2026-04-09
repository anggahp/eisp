<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Supplier
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
        if (!(Auth::user()->user_grp == 'supp' || Auth::user()->user_type == 'admin')) {
            // user value cannot be found in session
            return redirect()->back();
        }

        return $next($request);
    }
}
