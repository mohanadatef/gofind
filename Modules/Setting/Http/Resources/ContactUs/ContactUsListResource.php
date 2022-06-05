<?php

namespace Modules\Setting\Http\Resources\ContactUs;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Property\Http\Resources\Property\PropertyListResource;

class ContactUsListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'property_id' => new PropertyListResource($this->property),
            ];
    }
}
