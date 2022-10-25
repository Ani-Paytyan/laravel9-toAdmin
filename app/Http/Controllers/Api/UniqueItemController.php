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
        return UniqueItemResource::collection(UniqueItem::whereNotNull('mac')->paginate(self::PAGE));
    }
}
