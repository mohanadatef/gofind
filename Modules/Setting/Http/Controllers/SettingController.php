<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Http\Requests\Setting\EditRequest;
use Modules\Setting\Service\SettingService;

class SettingController extends BasicController
{
    protected $service;

    public function __construct(SettingService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:setting-edit')->only('edit');
        $this->service = $Service;
    }

    public function edit(Request $request)
    {
        $datas = $this->service->findBy($request,'',['value','key']);
        return view('setting::setting.edit',compact('datas'));
    }
    public function home(Request $request)
    {
        $datas = $this->service->findBy($request,'',['value','key']);
    return view('setting::setting.home',compact('datas'));
    }


    public function update(EditRequest $request)
    {
        $data= $this->service->update($request);
        if($data)
        {
            return redirect(route('setting.edit'))->with(getCustomTranslation('Done'));
        }
        return redirect()->back()->with(getCustomTranslation('problem'));
    }


}
