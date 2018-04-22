<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App;

class Localization
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
        $availableLangs = ['ar', 'en', 'it', 'pt-BR', 'sp'];

        $locale = $request->headers->get('Accept-Language');

        if (in_array($locale, $availableLangs))
           App::setLocale($locale);
        else 
           App::setLocale(Config::get('app.locale'));
        
        return $next($request);
    }
}
