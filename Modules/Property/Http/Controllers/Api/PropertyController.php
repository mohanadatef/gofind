<?php

namespace Modules\Property\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Property\Service\PropertyService;
use Modules\Basic\Http\Controllers\BasicController;

class PropertyController extends BasicController
{
    protected $service;

    public function __construct(PropertyService $Service)
    {
        $this->middleware('auth:api')->only(['list']);
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }
}
