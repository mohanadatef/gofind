<?php

namespace Modules\Basic\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Basic\Service\LogService;

class LogController extends BasicController
{
    private $service;

    public function __construct(LogService $Service)
    {
        $this->service = $Service;
    }

    public function store(Request $request)
    {
        $this->service->store($request);
        return $this->createResponse([],getCustomTranslation('Done'));
    }
}
