<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\ItemFormRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CoordinatorController
 *
 * @package App\Http\Controllers\Inventory
 */
class CoordinatorController extends Controller
{
    /**
     * CoordinatorController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', 'location']);
    }

    /**
     * Method for displaying the location his inventory.
     *
     * @param  Item $items The database model for the inventory items.
     * @return Renderable
     */
    public function index(Item $items): Renderable
    {
        $items = $items->userLocation()->paginate();
        return view('inventory.coordinator.index', compact('items'));
    }

    /**
     * Method for searching items in the application.
     *
     * @param  Request  $request The request instance that holds all the request information.
     * @param  Item     $items   Database model class for the items.
     * @return Renderable
     */
    public function search(Request $request, Item $items): Renderable
    {
        $items = $items->userLocation()->where('item_code', 'LIKE', "%{$term}%")
            ->orWhere('name', 'LIKE', "%{$term}%");

        return view('inventory.index', compact('items'));
    }

    /**
     * Method for displaying the create view of new item.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        $categories = Category::pluck('name', 'id');
        return view('inventory.coordinator.create', compact('categories'));
    }

    /**
     * Method for  storing the new item in the application.
     *
     * @throws \Exception <- Occurs when no item code can generated
     *
     * @param  ItemFormRequest $request The form request class that handles all the validation logic.
     * @param  Item $item The database resource model for the items in the application.
     * @return RedirectResponse
     */
    public function store(ItemFormRequest $request, Item $item): RedirectResponse
    {
        $request->merge(['item_code' => $item->generateItemCode()]);

        DB::transaction(static function () use ($request, $item): void {
            $location = auth()->user()->location->id;
            $item = $item->create($request->except(['location', 'category']));

            $item->location()->associate($location)->save();
            $item->category()->associate($request->category)->save();

            flash(ucfirst($item->name) . ' is toegevoegd in de applicatie');
        });

        return redirect()->route('coordinator.home');
    }
}
