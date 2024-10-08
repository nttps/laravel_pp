<?php

namespace NttpsApp\Http\Middleware;

use Closure;
use Auth;

class IsAdmin
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
        if (!Auth::guest()) {
            $user = auth()->user();
            if (isset($user->locale)) {
                app()->setLocale($user->locale);
            }

            // || $user->hasPermissionTo('admin-view') to view permision
            return $user->hasRole('ADMIN') || $user->hasRole('Super Admin')  ? $next($request) : redirect('/');
        }

        $urlLogin = route('admin.login');

        return redirect()->guest($urlLogin);
    }
}
