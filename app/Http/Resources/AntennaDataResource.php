<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AntennaDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $uniqueItem = $this->getUniqueItem();

        return [
            'mac' => $this->getMac(),
            'rssi' => $this->getRssi(),
            'unique_item' => $uniqueItem ? [
                'id' => $uniqueItem->id,
                'article' => $uniqueItem->article,
                'item' => $uniqueItem->item ? [
                    'id' => $uniqueItem->item->id,
                    'name' => $uniqueItem->item->name,
                ] : null
            ] : null
        ];
    }
}
