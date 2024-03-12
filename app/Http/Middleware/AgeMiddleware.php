<?php

namespace App\Http\Middleware;

use Closure;

class AgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$age)
    {
        //make some thing before go
            print ('helllo from middle ware . age equal to '.$age);
            return $next($request);
        //make some thing after  go
            /*$response = $next($request);
            print ('helllo from middle ware');
            return $response;*/

    }
}
