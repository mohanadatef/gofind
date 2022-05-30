<?php

namespace Modules\Acl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Acl\Http\Requests\User\Api\changePasswordRequest;
use Modules\Acl\Http\Requests\User\Api\CreateRequest;
use Modules\Acl\Http\Requests\User\Api\UpdateRequest;
use Modules\Acl\Http\Resources\User\UserProfileResource;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;

class UserController extends BasicController
{
    protected $service;

    public function __construct(UserService $Service)
    {
        $this->middleware('auth:api')->only(['update','changePassword']);
        $this->service = $Service;
    }

    public function store(CreateRequest $request)
    {
        $data = $this->service->store($request);
        if ($data) {
            return $this->createResponse($data, getCustomTranslation('Register_message'));
        }
        return $this->unKnowError();
    }

    public function profile(Request $request)
    {
        $data = $this->service->profile($request);
        if ($data) {
            return $this->apiResponse(new UserProfileResource($data), getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }

    public function update(UpdateRequest $request, $id)
    {
        if (user()->id == $id) {
            $data = $this->service->update($request);
            if ($data) {
                return $this->updateResponse(new UserProfileResource($data), getCustomTranslation('Done'));
            }
        }
        return $this->unKnowError();
    }

    public function changePassword(changePasswordRequest $request)
    {
        $data = $this->service->update($request);
        if ($data) {
            return $this->updateResponse([], getCustomTranslation('Done'));
        }
        return $this->unKnowError();
    }
}
