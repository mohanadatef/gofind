<?php

namespace Modules\Setting\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\ContactUs\Api\CreateRequest;
use Modules\Setting\Service\ContactUsService;

class ContactUsController extends BasicController
{
    private $service;

    public function __construct(ContactUsService $Service)
    {
        $this->service = $Service;
    }

    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse(null, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request,$this->pagination(),$this->perPage()),getCustomTranslation('Done'));
    }
}
