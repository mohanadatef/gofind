<?php

namespace Modules\CoreData\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\CoreData\Http\Requests\Tag\CreateRequest;
use Modules\CoreData\Http\Requests\Tag\EditRequest;
use Modules\CoreData\Service\TagService;

class TagController extends BasicController
{
    protected $service;

    public function __construct(TagService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:tag-index')->only('index');
        $this->middleware('permission:tag-create')->only('store');
        $this->middleware('permission:tag-edit')->only('update');
        $this->middleware('permission:tag-trash-index')->only('trash');
        $this->middleware('permission:tag-change-status')->only('changeStatus');
        $this->middleware('permission:tag-delete')->only('delete');
        $this->middleware('permission:tag-restore')->only('restore');
        $this->middleware('permission:tag-remove')->only('remove');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        ActiveLog(null,actionType()['va'],'tag');
        $datas = $this->service->findBy($request,false,true , $this->perPage());
        return view(checkView('coredata::tag.index'), compact('datas'));
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
        ActiveLog(null,actionType()['va'],'tag');
        $datas = $this->service->findBy($request,'withTrashed',true , $this->perPage());
        return view(checkView('coredata::tag.destroy'), compact('datas'));
    }

}
