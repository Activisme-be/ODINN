<?php

namespace App\Http\Controllers\Inbound;

use App\Http\Controllers\Controller;
use App\Http\Requests\InboundFormRequest;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class WebController
 *
 * @package App\Http\Controllers\Inbound
 */
class WebController extends Controller
{
    /**
     * The method for displaying the donation page.
     *
     * Here visotrs can select and send a donation request the users and coordinators in the app.
     * So the can make an arrangement for donating the actual goods.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $locations = Location::pluck('id', 'name');
        return view('inbound.web-index', compact('locations'));
    }

    public function store(InboundFormRequest $request): RedirectResponse
    {

    }
}
