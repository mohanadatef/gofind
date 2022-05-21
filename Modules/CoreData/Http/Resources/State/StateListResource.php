<?php

namespace Modules\CoreData\Http\Resources\State;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityListResource;

class StateListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'city'=> new CityListResource($this->city)
        ];
    }
}
