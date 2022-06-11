<?php

namespace Modules\Property\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Property\Http\Requests\Property\Api\CreateRequest;
use Modules\Property\Service\PropertyService;
use Modules\Basic\Http\Controllers\BasicController;

class PropertyController extends BasicController
{
    protected $service;

    public function __construct(PropertyService $Service)
    {
        $this->middleware('auth:api')->only(['list']);
        $this->middleware('permission:property-create')->only('store');
        $this->middleware('permission:property-edit')->only('update');
        $this->service = $Service;
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }

    /**
     * @param CreateRequest $request
     */
    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    /**
     * @param CreateRequest $request
     * @result update row in database
     */
    public function update(CreateRequest $request)
    {
        $data = $this->service->update($request);
        if ($data) {
            return $this->updateResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }
}
