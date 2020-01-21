<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = auth()->user();

            if ($user->hasAnyRole(['admin', 'webmaster'])) {
                return redirect(RouteServiceProvider::HOME);
            }

            if ($user->hasRole('vrijwilliger') && $user->location()->exists()) {
                return redirect()->route('coordinator.home');
            }

            return redirect()->route('errors.no-location');
        }

        return $next($request);
    }
}
