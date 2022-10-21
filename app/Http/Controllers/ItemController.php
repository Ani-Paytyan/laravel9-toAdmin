<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
   const PAGE = 10;

    public function index()
    {
        $items = Item::withCount('uniqueItem')->paginate(self::PAGE);
        return view('item.index', compact('items'));
    }
}
