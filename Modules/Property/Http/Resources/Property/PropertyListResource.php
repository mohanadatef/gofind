<?php

namespace Modules\Property\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\User\UserListResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\State\StateListResource;

class PropertyListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'info' => $this->info,
            'user' => new UserListResource($this->user),
            'avatar' => getImag($this->avatar,'user',$this->id),
            'city' => new CityListResource($this->city),
            'state' => new StateListResource($this->state),
            'country' => new CountryListResource($this->country),
        ];
    }
}
