<?php

namespace Modules\Property\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyPriceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'info' => $this->info,
        ];
    }
}
