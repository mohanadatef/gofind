<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Category\CreateRequest;
use Modules\CoreData\Http\Requests\Category\EditRequest;
use Modules\CoreData\Service\CategoryService;

class CategoryController extends BasicController
{
    protected $service;

    public function __construct(CategoryService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:category-index')->only('index');
        $this->middleware('permission:category-create')->only('store');
        $this->middleware('permission:category-edit')->only('update');
        $this->middleware('permission:category-trash-index')->only('trash');
        $this->middleware('permission:category-change-status')->only('changeStatus');
        $this->middleware('permission:category-delete')->only('delete');
        $this->middleware('permission:category-restore')->only('restore');
        $this->middleware('permission:category-remove')->only('remove');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'category');
        $datas = $this->service->findBy($request,false,true , $this->perPage());
        return view(checkView('coredata::category.index'), compact('datas'));
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
        ActiveLog(null,actionType()['va'],'category');
        $datas = $this->service->findBy($request,'withTrashed',true , $this->perPage());
        return view(checkView('coredata::category.destroy'), compact('datas'));
    }

    public function parent(Request $request)
    {
        return $this->service->parent($request);
    }

}
