<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HTMXRedirect {
    public function handle(Request $request, Closure $next): Response {
        $response = $next($request);
        if ($request->header('HX-Request', 'false') == 'true') {
            $response->header('HX-Refresh', 'true');
        }

        return $response;
    }
}
