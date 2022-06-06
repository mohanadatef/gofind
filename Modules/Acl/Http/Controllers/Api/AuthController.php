<?php

namespace Modules\Acl\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Acl\Http\Requests\Login\Api\LoginRequest;
use Modules\Acl\Http\Resources\User\UserLoginResource;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;

/**
 * @extends BasicController
 * controller auth for login and auth function
 */
class AuthController extends BasicController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * can login by mobile or email
     * @must by status => active 1,make confirm email
     */
    public function login(LoginRequest $request)
    {
        $moreConditionForFirstLevel = [
            'whereCustom' => [
                'where' => [['email' => $request->email], ['mobile' => $request->email], ['facebook_id' => $request->email]],
            ]
        ];
        $user = $this->userService->findBy(new Request(), false, $moreConditionForFirstLevel, 'first');
        if ($user) {
            if (isset($request->password) && !Hash::check($request->password, $user->password)) {
                ActiveLog($user, actionType()['la'], 'failed_password');
                return $this->unauthorizedResponse(getCustomTranslation('failed_password'));
            }
            if ($user->status == activeType()['us']) {
                ActiveLog($user, actionType()['la'], 'support');
                return $this->unauthorizedResponse(getCustomTranslation('support'));
            }
            Auth::loginUsingId($user->id);
            $token = user()->createToken('goFind Personal Access Client')->accessToken;
            $user->update(['token' => $token]);
            ActiveLog($user, actionType()['la'], 'login');
            return $this->apiResponse(new UserLoginResource($user), getCustomTranslation('login'));
        } else {
            ActiveLog(null, actionType()['la'], 'failed');
            return $this->unauthorizedResponse(getCustomTranslation('failed'));
        }
    }

    public function logout(Request $request)
    {
        user()->token()->revoke();
        ActiveLog([], actionType()['loa'], 'logout');
        return $this->apiResponse([], getCustomTranslation('logout_done'));
    }

    /**
     * check if header have token so send data for user login
     */
    public function getUserByToken()
    {
        if (user()) {
            return $this->apiResponse(new UserLoginResource(user()), getCustomTranslation('done'), 200);
        }
        return $this->unauthorizedResponse(getCustomTranslation('failed'));
    }
}
