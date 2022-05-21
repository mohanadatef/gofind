<?php

namespace Modules\CoreData\Http\Resources\State;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityResource;

class StateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'order' => $this->order,
            'status' => $this->status,
            'city'=> new CityResource($this->city)
        ];
    }
}
