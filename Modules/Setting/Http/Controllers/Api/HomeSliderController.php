<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\HomeSliderService;

class HomeSliderController extends BasicController
{
    private $service;

    public function __construct(HomeSliderService $Service)
    {
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }

}
