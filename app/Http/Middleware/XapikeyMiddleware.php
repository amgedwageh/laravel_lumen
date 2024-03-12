<?php

namespace App\Http\Middleware;
use Illuminate\Support\Str;
use App\Http\Traits\GeneralTraits;
use Closure;

class XapikeyMiddleware
{
    use GeneralTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next )
    {

        //
        $apiKey = env('API_KEY');
        //$apiKey = config('app.fast_api_key');
        $apiKeyIsValid = (! empty($apiKey) && $request->header('x-api-key') == $apiKey);
        if($apiKeyIsValid)
        {
            return $next($request);
        }
        else
        {
            return $this->returnError('403',__('messages.access denied'));
        }

        //

    }
}
