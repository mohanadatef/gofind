<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\HomeSlider\CreateRequest;
use Modules\Setting\Http\Requests\HomeSlider\EditRequest;
use Modules\Setting\Service\HomeSliderService;

class HomeSliderController extends BasicController
{
    protected $service;

    public function __construct(HomeSliderService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:home-slider-index')->only('index');
        $this->middleware('permission:home-slider-create')->only(['create','store']);
        $this->middleware('permission:home-slider-edit')->only(['edit','update']);
        $this->middleware('permission:home-slider-trash-index')->only('trash');
        $this->middleware('permission:home-slider-change-status')->only('changeStatus');
        $this->middleware('permission:home-slider-delete')->only('delete');
        $this->middleware('permission:home-slider-restore')->only('restore');
        $this->middleware('permission:home-slider-remove')->only('remove');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,false,true,$this->perPage());
        return view(checkView('setting::home_slider.index'), compact('datas'));
    }

    public function create()
    {
        return view(checkView('setting::home_slider.create'));
    }

    public function store(CreateRequest $request)
    {
        $data= $this->service->store($request);
        if($data)
        {
            return redirect(route('home_slider.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('home_slider.create'))->with(getCustomTranslation('problem'));
    }

    public function edit($id)
    {
        $data = $this->service->show($id);
        ActiveLog($data, actionType()['va'], 'home_slider');
        return view(checkView('setting::home_slider.edit'),compact('data'));
    }

    public function update(EditRequest $request, $id)
    {
        $data= $this->service->update($request,$id);
        if($data)
        {
            return redirect(route('home_slider.index'))->with(getCustomTranslation('Done'));
        }
        return redirect(route('home_slider.edit'))->with(getCustomTranslation('problem'));
    }

    public function trash(Request $request)
    {
        $datas = $this->service->findBy($request,'withTrashed',true,$this->perPage());
        return view(checkView('setting::home_slider.destroy'), compact('datas'));
    }

}
