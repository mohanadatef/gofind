<?php

namespace Modules\CoreData\Http\Resources\City;
use Illuminate\Http\Resources\Json\JsonResource;

class CityListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
        ];
    }
}
