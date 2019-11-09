<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class NotificationController
 *
 * @package App\Http\Controllers\Profile
 */
class NotificationController extends Controller
{
    /**
     * The authentication guard implementation variable.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * NotificationController constructor.
     *
     * @param  Guard $auth The authentication guard implementation.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->auth = $auth;
    }

    /**
     * Method for displaying the authenticated user his notification settings.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('profile.notifications', [
            'user' => $this->auth->user(), 'settings' => $this->auth->user()->settings()->get()
        ]);
    }
}
