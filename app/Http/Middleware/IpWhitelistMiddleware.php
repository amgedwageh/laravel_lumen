<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTraits;
class IpWhitelistMiddleware
{
    use GeneralTraits;
    public $whitelistIps = [
        '192.168.1.6','192.168.1.5','192.168.1.4','192.168.1.3','192.168.1.2','192.168.1.1','192.168.1.7'
    ];

    public function handle($request, Closure $next)
    {

        /*if (!in_array( request()->ip(), $this->whitelistIps)) {
            abort(403, "You are restricted to access the site.");
        }*/
        return $next($request);
    }
}
