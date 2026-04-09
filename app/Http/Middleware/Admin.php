<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if (!(Auth::user()->user_type == 'admin')) {
            // user value cannot be found in session
            // return redirect('/home');
            return redirect()->back();
        }

        return $next($request);
    }
}
