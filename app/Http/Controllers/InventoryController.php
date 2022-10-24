<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Services\InventoryService;
use Illuminate\Database\Eloquent\Collection;

class InventoryController extends Controller
{
    private InventoryService $inventory;

    /**
     * @param InventoryService $inventory
     */
    public function __construct(InventoryService $inventory)
    {
        $this->inventory = $inventory;
    }

    public function index()
    {
        $total = $this->inventory->getTotal();

        return view('inventory.index', compact('total'));
    }

    public function update(InventoryRequest $request)
    {
        return response()->json($this->inventory->process($request->all()));
    }
}
