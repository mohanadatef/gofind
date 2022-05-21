<?php

namespace Modules\Setting\Http\Resources\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value ?? "",
            ];
    }
}
