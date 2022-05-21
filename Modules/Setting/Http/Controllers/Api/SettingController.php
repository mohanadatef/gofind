<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
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
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }

}
