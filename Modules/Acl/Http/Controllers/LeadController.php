<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Acl\Service\LeadService;
use Modules\Basic\Http\Controllers\BasicController;
/**
 * @extends BasicController
 * controller lead about web function
 */
class LeadController extends BasicController
{
    protected $service;
    /**
     * @extends BasicController
     * controller lead about web function
     * @required lead login
     */
    public function __construct(LeadService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:lead-index')->only('index');
        $this->middleware('permission:lead-trash-index')->only('trash');
        $this->middleware('permission:lead-delete')->only('delete');
        $this->middleware('permission:lead-restore')->only('restore');
        $this->middleware('permission:lead-remove')->only('remove');
        $this->service = $Service;
    }

    /**
     * @param Request $request
     * get all lead to manage it
     */
    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'lead');
        $datas = $this->service->findBy($request,false,[],'',['*'],true,$this->perPage());
        return view(checkView('acl::lead.index'), compact('datas'));
    }

    /**
     * @param Request $request
     * get all lead to manage it delete before
     */
    public function trash(Request $request)
    {
        ActiveLog(null,actionType()['va'],'lead');
        $datas = $this->service->findBy($request,'withTrashed',[],'',['*'],true,$this->perPage());
        return view(checkView('acl::lead.destroy'), compact('datas'));
    }
}
