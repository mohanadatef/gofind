<?php

namespace Modules\Setting\Http\Resources\ContactUs;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Property\Http\Resources\Property\PropertyListResource;

class ContactUsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'subject' => $this->subject,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'property_id' => new PropertyListResource($this->property),
        ];
    }
}
