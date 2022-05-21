<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Acl\Http\Requests\User\CreateRequest;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;
/**
 * @extends BasicController
 * controller user about web function
 */
class UserController extends BasicController
{
    protected $service;
    /**
     * @extends BasicController
     * controller user about web function
     * @required user login
     */
    public function __construct(UserService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:user-index')->only('index');
        $this->middleware('permission:user-create')->only('store');
        $this->middleware('permission:user-trash-index')->only('trash');
        $this->middleware('permission:user-change-status')->only('changeStatus');
        $this->middleware('permission:user-delete')->only('delete');
        $this->middleware('permission:user-restore')->only('restore');
        $this->middleware('permission:user-remove')->only('remove');
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * @return View
     * get all user to manage it
     */
    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'user');
        $datas = $this->service->findBy($request,false,[],'',['*'],true,$this->perPage());
        return view(checkView('acl::user.index'), compact('datas'));
    }

    /**
     * @param Request $request
     * @return View
     * get all user to manage it delete before
     */
    public function trash(Request $request)
    {
        ActiveLog(null,actionType()['va'],'user');
        $datas = $this->service->findBy($request,'withTrashed',[],'',['*'],true,$this->perPage());
        return view(checkView('acl::user.destroy'), compact('datas'));
    }


    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }
}
