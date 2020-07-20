<?php

namespace App\Http\Middleware;

use Closure;
use auth;

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
        if (isset(auth()->user()->id_level)) {
            if (auth()->user()->id_level == 1) {
                return $next($request);        
            }
        }
        return redirect('/access/denied');
    }
}
