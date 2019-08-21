<?php

namespace App\Http\Controllers\API;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ItemsFilter;

class ItemController extends Controller
{
    public function index(ItemsFilter $filters)
    {
        $items = Item::filter($filters)->paginate(20);

        return response()->json($items);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
