<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Acl\Http\Requests\Permission\EditRequest;
use Modules\Acl\Service\PermissionService;

class PermissionController extends BasicController
{
    protected $service;

    public function __construct(PermissionService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-index')->only('index');
        $this->middleware('permission:permission-edit')->only('update');
        $this->middleware('permission:permission-trash-index')->only('trash');
        $this->middleware('permission:permission-delete')->only('delete');
        $this->middleware('permission:permission-restore')->only('restore');
        $this->middleware('permission:permission-remove')->only('remove');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,'',[],[],false,true,$this->perPage());
        return view(checkView('acl::permission.index'), compact('datas'));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->service->update($request, $id));
    }

    public function trash(Request $request)
    {
        $datas = $this->service->findBy($request,'withTrashed',true,$this->perPage());
        return view(checkView('acl::permission.destroy'), compact('datas'));
    }

}
