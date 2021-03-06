<?php

namespace Modules\Acl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Acl\Service\LeadService;
use Modules\Basic\Http\Controllers\BasicController;

class LeadController extends BasicController
{
    protected $service;

    public function __construct(LeadService $Service)
    {
        $this->service = $Service;
    }

    public function store(Request $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }
}
