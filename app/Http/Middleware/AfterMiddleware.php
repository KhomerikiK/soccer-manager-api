<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        //TODO::this condition will be dynamic from config
        if (
            auth()->check()
            && $request->route()->getName() != 'logout'
        ) {
            $response->header('Authorization', 'Bearer '.auth()->user()->refreshToken());
        }

        return $response;
    }
}
