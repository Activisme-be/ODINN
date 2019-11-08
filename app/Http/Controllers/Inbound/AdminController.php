<?php

namespace App\Http\Controllers\Inbound;

use App\Http\Controllers\Controller;
use App\Models\Inbound;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Inbound
 */
class AdminController extends Controller
{
    /**
     * AdminController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin', 'forbid-banned-user']);
        $this->authorizeResource(Inbound::class);
    }

    /**
     * Method for getting the overview of all the inbound material donations.
     *
     * @param  Inbound $donations The database model class for all the inbound material donations.
     * @return Renderable
     */
    public function index(Inbound $donations): Renderable
    {
        $donations = $donations->paginate();
        return view('inbound.admin.overview', compact('donations'));
    }
}
