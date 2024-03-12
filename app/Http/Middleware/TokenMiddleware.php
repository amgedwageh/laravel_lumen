<?php

namespace App\Http\Middleware;
use App\Models\User;
use App\Http\Traits\GeneralTraits;
use Closure;

class TokenMiddleware
{
    use GeneralTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $remember_token = $request->header('remember_token') ;
        $user_code = $request->user_code;
        $user = User::where('user_code', $user_code)->first();
        if($user  && $user->remember_token == $remember_token)
        {
            return $next($request);
        }
        else
        {
            return $this->returnError('387', __('messages.go To login '));
        }

    }
}
