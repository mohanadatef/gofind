<?php

namespace Modules\Property\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserListResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\State\StateListResource;

class PropertyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'count_view' => $this->count_view,
            'info' => $this->info,
            'image' => getImag($this->image,'property',$this->id),
            'city' => new CityListResource($this->city),
            'country' => new CountryListResource($this->country),
            'state' => new StateListResource($this->state),
            'user' => new UserListResource($this->user),
        ];
    }
}
