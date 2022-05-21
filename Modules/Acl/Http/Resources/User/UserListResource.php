<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\State\StateListResource;

class UserListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'info' => $this->info,
            'avatar' => getImag($this->avatar,'user',$this->id),
            'city' => new CityListResource($this->city),
            'state' => new StateListResource($this->state),
        ];
    }
}
