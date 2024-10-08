<?php

namespace NttpDev\Http\Middleware;

use Closure;

class Lang
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

       

        if (session()->has('applocale') AND array_key_exists(session()->get('applocale'), config()->get('languages'))) {
          
            app()->setLocale(session()->get('applocale'));
           
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
           
            app()->setLocale(config()->get('app.locale'));
           
        }
        return $next($request);
    }
}
