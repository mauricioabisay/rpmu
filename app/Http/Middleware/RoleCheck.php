<?php

namespace App\Http\Middleware;

use Closure;

class RoleCheck
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
        if ( ! $request->user() ) {
            $aux_path_array = explode('/', $request->path());
            if ( sizeof($aux_path_array) > 1 ) {
                return redirect($aux_path_array[1]);
            }
            return $next($request);
        }
        return $next($request);
    }
}
