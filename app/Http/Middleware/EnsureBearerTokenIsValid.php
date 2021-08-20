<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureBearerTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    const API_KEY="A1B2B663D4E5F6A1B8C9D0a23c4" 

    public function handle(Request $request, Closure $next)
    {
        
        if ($request->bearerToken() !== API_KEY) {
            return response('Hello World', 200);
        }

        return $next($request);
    }
}
