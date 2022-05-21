<?php

namespace Modules\Acl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Acl\Service\FavouriteService;
use Modules\Basic\Http\Controllers\BasicController;

class FavouriteController extends BasicController
{
    protected $service;

    public function __construct(FavouriteService $Service)
    {
        $this->middleware('auth:api');
        $this->service = $Service;
    }

    public function store(Request $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('done'));
        }
        return $this->unKnowError();
    }

    public function list(Request $request)
    {
        return $this->apiResponse($this->service->list($request, $this->pagination(), $this->perPage()), getCustomTranslation('Done'));
    }
}
