<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use DebugBar\DataCollector\Renderable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Method for redirecting the authenticated user to the right dashboard page.
     *
     * @param  Request $request The request instance that holds all the request information.
     * @param  User    $user    The resource entity from the authenticated user.
     * @return RedirectResponse
     */
    protected function authenticated(Request $request, User $user): RedirectResponse
    {
        if ($user->hasAnyRole(['admin', 'webmaster'])) {
            return redirect()->route('home');
        }

        if ($user->hasRole('vrijwilliger') && $user->location()->exists()) {
            return redirect()->route('coordinator.home');
        }

        return redirect()->route('errors.no-location');
    }
}
