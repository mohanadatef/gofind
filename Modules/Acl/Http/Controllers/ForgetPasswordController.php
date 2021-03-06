<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Acl\Http\Requests\ForgetPassword\changePasswordRequest;
use Modules\Acl\Http\Requests\ForgetPassword\changePasswordRequest as changeRequest;
use Modules\Acl\Service\ForgetPasswordService;
use Modules\Basic\Http\Controllers\BasicController;

class ForgetPasswordController extends BasicController
{
    private $service;

    public function __construct(ForgetPasswordService $Service)
    {
        $this->service = $Service;
    }

    public function index()
    {
        return view(checkView('auth.forgetPassword.index'));
    }

    public function code()
    {
        return view(checkView('auth.forgetPassword.code'));
    }

    public function store(Request $request)
    {
       $data = $this->service->store($request);
       if($data){
           $user=$this->service->getUser($request);
           return view(checkView('auth.forgetPassword.code'),compact('user'));
       }
       return redirect()->back()->with('message_fales',getCustomTranslation('failed'));
    }

    public function check(changePasswordRequest $request)
    {
        $user=$this->service->getUser($request);
        $request->merge(['user_id'=>$user->id]);
        $data = $this->service->check($request);
        if ($data && isset($data['result'])) {
            if ($data['result'] == true) {
                $data = $this->service->changePassword($request);
                if($data)
                {
                    return redirect(route('login'));
                }
            } else {
                return redirect()->back()->with('message_fales',$data['message']);
            }
        }
        return redirect()->back()->with('message_fales',getCustomTranslation('failed'));
    }

    public function update(changeRequest $request,$id)
    {
        $request->merge(['user_id'=>$id]);
        $data = $this->service->changePassword($request);
        if($data)
        {
            return true;
        }
        return redirect()->back()->with('message_fales',$data['message']);
    }

}
