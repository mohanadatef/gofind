<?php

namespace Modules\Setting\Http\Resources\HomeSlider;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Basic\Http\Resources\Media\mediaResource;

class HomeSliderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'description' => $this->description->value ?? "",
            'url' => $this->url,
            'order' => $this->order,
            'status' => $this->status,
            'image'=>new mediaResource($this->image)
        ];
    }
}
