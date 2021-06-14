<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkrole
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
        foreach ($request->user()->roles as $role) 
        {
            if ($role->id != 1) 
            {
                return abort(404);
            }
        }
        return $next($request);
    }
}
