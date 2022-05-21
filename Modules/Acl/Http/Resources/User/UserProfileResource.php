<?php

namespace Modules\Acl\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Acl\Http\Resources\Role\RoleResource;
use Modules\CoreData\Http\Resources\City\CityListResource;
use Modules\CoreData\Http\Resources\State\StateListResource;

class UserProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'role' => new RoleResource($this->role),
            'description' => $this->description,
            'info' => $this->info,
            'avatar' => getImag($this->avatar,'user',$this->id),
            'city' => new CityListResource($this->city),
            'state' => new StateListResource($this->state),
        ];
    }
}
