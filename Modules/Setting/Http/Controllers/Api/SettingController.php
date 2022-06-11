<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Resources\Setting\HomeSettingListResource;
use Modules\Setting\Service\SettingService;

class SettingController extends BasicController
{
    private $service;

    public function __construct(SettingService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        if($request->home == 1){
            $request->merge(['key'=>'home_section']);
            return $this->apiResponse(HomeSettingListResource::collection($this->service->list($request,$this->pagination(),$this->perPage())),getCustomTranslation('Done'));
        }
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }

}
