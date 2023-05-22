<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->hasHeader('X-App-Locale') &&
            in_array($request->header('X-App-Locale'), config('app.available_locales'))
        ) {
            App::setLocale($request->header('X-App-Locale'));
        }

        return $next($request);
    }
}
