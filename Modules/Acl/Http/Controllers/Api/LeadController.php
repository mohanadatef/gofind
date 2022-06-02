<?php

namespace Modules\Acl\Http\Controllers\Api;

use Modules\Acl\Http\Requests\Lead\Api\CreateRequest;
use Modules\Acl\Service\LeadService;
use Modules\Basic\Http\Controllers\BasicController;

class LeadController extends BasicController
{
    protected $service;

    public function __construct(LeadService $Service)
    {
        $this->service = $Service;
    }

    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }
}
