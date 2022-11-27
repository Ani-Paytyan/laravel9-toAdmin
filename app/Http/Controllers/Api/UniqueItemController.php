<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UniqueItemResource;
use App\Models\UniqueItem;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UniqueItemController extends Controller
{
    const PAGE = 10;

    public function getUniqueItems(): AnonymousResourceCollection
    {
        return UniqueItemResource::collection(UniqueItem::whereNotNull('mac')->get());
    }

    public function setItemOnline($mac, $online) {
        $item = UniqueItem::where('mac', $mac)->firstOrFail();
        $item->is_online = $online == 1;
        $item->save();
    }

    public function setItemInside($mac, $inside) {
        $item = UniqueItem::where('mac', $mac)->firstOrFail();
        $item->is_inside = $inside == 1;
        $item->save();
    }

}
