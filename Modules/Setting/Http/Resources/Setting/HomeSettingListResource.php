<?php

namespace Modules\Setting\Http\Resources\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSettingListResource extends JsonResource
{
    public function toArray($request)
    {
        if(str_contains($this->key,'logos')){
            $value = getLogoSetting();
        }elseif(str_contains($this->key,'image')){
            if(str_contains($this->key,'home_section_3_image')){
                $value = getImageSetting($this->key);
            }else{
            $value = getImageSetting($this->key,'first');
            }
        }else{
            $value = $this->value ?? "";
        }
         return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $value,
            'section'=>explode('_',$this->key)[2]
            ];
    }
}
