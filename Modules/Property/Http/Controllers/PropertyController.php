<?php

namespace Modules\Property\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Acl\Service\UserService;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Property\Http\Requests\Property\CreateRequest;
use Modules\Property\Http\Requests\Property\EditRequest;
use Modules\Property\Service\PropertyService;

class PropertyController extends BasicController
{
    protected $service,$userService;
    /**
     * @extends BasicController
     * controller property about web function
     * @required property login
     */
    public function __construct(PropertyService $Service,UserService $userService)
    {
        $this->middleware('auth');
        $this->middleware('permission:property-index')->only('index');
        $this->middleware('permission:property-create')->only(['create','store']);
        $this->middleware('permission:property-trash-index')->only('trash');
        $this->middleware('permission:property-change-status')->only('changeStatus');
        $this->middleware('permission:property-delete')->only('delete');
        $this->middleware('permission:property-restore')->only('restore');
        $this->middleware('permission:property-remove')->only('remove');
        $this->service = $Service;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * get all property to manage it
     */
    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'property');
        $datas = $this->service->findBy($request,false,[],'',['*'],true,$this->perPage());
        return view(checkView('property::property.index'), compact('datas'));
    }

    /**
     * @param Request $request
     * get all property to manage it delete before
     */
    public function trash(Request $request)
    {
        ActiveLog(null,actionType()['va'],'property');
        $datas = $this->service->findBy($request,'withTrashed',[],'',['*'],true,$this->perPage());
        return view(checkView('property::property.destroy'), compact('datas'));
    }

    public function create()
    {
        $recursiveRel = [
            'role' => [
                'type' => 'whereHas',
                'recursive' => [
                    'permission' => [
                        'type' => 'whereHas',
                        'where' => ['name' => 'property-create']
                    ]
                ]
            ]
        ];
        $users = $this->userService->findBy(new Request(),false,[],'',['*'],false,10,$recursiveRel);
        return view(checkView('property::property.create'),compact('users'));
    }

    public function store(CreateRequest $request)
    {
        $data= $this->service->store($request);
        if($data)
        {
            return redirect(route('property.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('property.create'))->with(getCustomTranslation('problem'));
    }

    public function edit($id)
    {
        $data = $this->service->show($id);
        $recursiveRel = [
            'role' => [
                'type' => 'whereHas',
                'recursive' => [
                    'permission' => [
                        'type' => 'whereHas',
                        'where' => ['name' => 'property-create']
                    ]
                ]
            ]
        ];
        $users = $this->userService->findBy(new Request(),false,[],'',['*'],false,10,$recursiveRel);
        ActiveLog($data, actionType()['va'], 'property');
        return view(checkView('property::property.edit'),compact('data','users'));
    }

    public function update(EditRequest $request, $id)
    {
        $data= $this->service->update($request);
        if($data)
        {
            return redirect(route('property.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('property.edit'))->with(getCustomTranslation('problem'));
    }
}
