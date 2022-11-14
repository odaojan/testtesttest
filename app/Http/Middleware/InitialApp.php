<?php

namespace App\Http\Middleware;

use Closure;

class InitialApp
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

        if (!file_exists(storage_path() . '/app/initial')) {
            return redirect('register')->with('message', 'Application initialization. Please register an administrator.');
        } 

        return $next($request);
    }
}
