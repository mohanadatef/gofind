<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\City\CreateRequest;
use Modules\CoreData\Http\Requests\City\EditRequest;
use Modules\CoreData\Service\CityService;

class CityController extends BasicController
{
    protected $service;

    public function __construct(CityService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:city-index')->only('index');
        $this->middleware('permission:city-create')->only('store');
        $this->middleware('permission:city-edit')->only('update');
        $this->middleware('permission:city-trash-index')->only('trash');
        $this->middleware('permission:city-change-status')->only('changeStatus');
        $this->middleware('permission:city-delete')->only('delete');
        $this->middleware('permission:city-restore')->only('restore');
        $this->middleware('permission:city-remove')->only('remove');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'city');
        $datas = $this->service->findBy($request,false,true,$this->perPage());
        return view(checkView('coredata::city.index'), compact('datas'));
    }

    public function store(CreateRequest $request)
    {
        return response()->json($this->service->store($request));
    }

    public function update(EditRequest $request, $id)
    {
        return response()->json($this->service->update($request, $id));
    }

    public function trash(Request $request)
    {
        ActiveLog(null,actionType()['va'],'city');
        $datas = $this->service->findBy($request,'withTrashed',true,$this->perPage());
        return view(checkView('coredata::city.destroy'), compact('datas'));
    }

}
