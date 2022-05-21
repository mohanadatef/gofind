<?php

namespace Modules\Basic\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Requests\CustomTranslation\CreateRequest;
use Modules\Basic\Http\Requests\CustomTranslation\EditRequest;
use Modules\Basic\Service\CustomTranslationService;

class CustomTranslationController extends BasicController
{
    protected $service;

    public function __construct(CustomTranslationService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:custom-translation-index')->only('index');
        $this->middleware('permission:custom-translation-create')->only('store');
        $this->middleware('permission:custom-translation-edit')->only('update');
        $this->middleware('permission:custom-translation-trash-index')->only('trash');
        $this->middleware('permission:custom-translation-change-status')->only('changeStatus');
        $this->middleware('permission:custom-translation-delete')->only('delete');
        $this->middleware('permission:custom-translation-restore')->only('restore');
        $this->middleware('permission:custom-translation-remove')->only('remove');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,false,true,$this->perPage());
        return view('basic::custom_translation.index', compact('datas'));
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
        $datas = $this->service->findBy($request,'withTrashed',true,$this->perPage());
        return view(checkView('basic::custom_translation.destroy'), compact('datas'));
    }

}
