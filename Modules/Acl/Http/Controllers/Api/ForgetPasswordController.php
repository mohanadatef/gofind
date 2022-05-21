<?php

namespace Modules\Acl\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Acl\Http\Requests\ForgetPassword\Api\changePasswordRequest;
use Modules\Acl\Service\ForgetPasswordService;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Acl\Http\Requests\ForgetPassword\Api\CheckMobileRequest;

class ForgetPasswordController extends BasicController
{
    private $service;

    public function __construct(ForgetPasswordService $Service)
    {
        $this->service = $Service;
    }

    public function store(Request $request)
    {
       $data = $this->service->store($request);
       if($data){
           return $this->createResponse(null,getCustomTranslation('code_send'));
       }
       return $this->unKnowError(getCustomTranslation('failed'));
    }

    public function check(CheckMobileRequest $request)
    {
        $data = $this->service->check($request);
        if ($data && isset($data['result'])) {
            if ($data['result'] == true) {
                return $this->apiResponse($data['data'], getCustomTranslation('Done'));
            } else {
                return $this->unKnowError($data['message']);
            }
        }
        return $this->unKnowError(getCustomTranslation('failed'));
    }

    public function changePassword(changePasswordRequest $request)
    {
        $data = $this->service->changePassword($request);
        if ($data) {
            return $this->updateResponse(null, getCustomTranslation('password_change'));
        }
        return $this->unKnowError();
    }
}
