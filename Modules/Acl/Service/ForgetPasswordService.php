<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Repositories\ForgetPasswordRepository;
use Modules\Basic\Service\BasicService;

class ForgetPasswordService extends BasicService
{
    protected $userService, $repo;

    public function __construct(ForgetPasswordRepository $repository, UserService $userService)
    {
        $this->userService = $userService;
        $this->repo = $repository;
    }

    public function store(Request $request)
    {
        $user = $this->getUser($request);
        if ($user) {
            $code = $this->repo->findBy(new Request(['user_id' => $user->id, 'status' => activeType()['us']]), false, [], [], 'first', ['code']);
            ActiveLog($user, actionType()['gca'], 'code_send');
            if (!$code) {
                // $code = rand(1000, 9999);
                $code = 1111;
                $this->repo->save(new Request(['code' => $code, 'user_id' => $user->id]));
            } else {
                $code = $code->code;
            }
            $this->sendOTP(null,$code);
            return true;
        }
        ActiveLog(null, actionType()['gca'], 'problem');
        return false;
    }

    public function check(Request $request)
    {
        $request->merge([ 'status' => activeType()['us']]);
        $code = $this->repo->findBy($request, false, [], [], 'first');
        if ($code) {
            if ($code->status == activeType()['as']) {
                ActiveLog(null, actionType()['gca'], 'code_used');
                return ['result' => false, 'message' => getCustomTranslation('code_used')];
            }
            $this->repo->save(new Request(['status' => activeType()['as']]), $code->id);
            $user = $this->userService->show($code->user_id);
            ActiveLog($user, actionType()['gca'], 'done');
            return ['result' => true, 'data' => $user];
        }
        ActiveLog(null, actionType()['gca'], 'problem');
        return false;
    }

    public function changePassword(Request $request)
    {
        $newRequest = new Request($request->except(['user_id','status']));
        $newRequest->merge(['id' => $request->user_id]);
        $data = $this->userService->update($newRequest);
        if ($data) {
            ActiveLog($data, actionType()['gca'], 'password_change');
            return true;
        }
        ActiveLog($data, actionType()['gca'], 'problem');
        return false;
    }

    public function getUser(Request $request)
    {
        return $this->userService->findBy($request, false, [], 'first', ['id', 'mobile']);
    }
}
