<?php

namespace Modules\Setting\Http\Resources\HomeSlider;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSliderListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name->value ?? "",
            'description' => $this->description->value ?? "",
            'url' => $this->url,
            ];
    }
}
