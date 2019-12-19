<?php

namespace App\Http\Middleware;

use Closure;

class ApiLocalizationMiddleware
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
        // Check if login user locale setting
        $local = isset(auth()->user()->locale) ? auth()->user()->locale : 'en';

        // Set localization
        app()->setLocale($local);

        return $next($request);
    }
}
