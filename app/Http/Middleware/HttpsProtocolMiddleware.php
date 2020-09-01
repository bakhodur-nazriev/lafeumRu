<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpsProtocolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $appEnvironment = App::environment();

        if (
            !$request->secure() &&
            $appEnvironment &&
            $appEnvironment != 'local'
        ) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
