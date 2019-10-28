<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class LocationMiddleware
 *
 * @package App\Http\Middleware
 */
class LocationMiddleware
{
    /**
     * The authentication guard variable.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * LocationMiddleware constructor.
     *
     * @param  Guard $auth The data implementation for the authentiated user.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->userHasNoLocation()) {
            return redirect()->route('errors.no-location');
        }

        return $next($request);
    }

    /**
     * Determine whether the currently authenticated coordinator has a location.
     *
     * @return bool
     */
    private function userHasNoLocation(): bool
    {
        return $this->auth->user()->location()->doesntExist();
    }
}
