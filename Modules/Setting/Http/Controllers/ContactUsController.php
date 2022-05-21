<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Http\Controllers\BasicController;
use Modules\Setting\Service\ContactUsService;

class ContactUsController extends BasicController
{
    protected $service;

    public function __construct(ContactUsService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:contact-us-index')->only('index');
        $this->middleware('permission:contact-us-index-trash')->only('trash');
        $this->middleware('permission:contact-us-change-status')->only('changeStatus');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,false,true , $this->perPage());
        return view(checkView('setting::contact_us.index'), compact('datas'));
    }

    public function trash(Request $request)
    {
        $datas = $this->service->findBy($request,'withTrashed',true , $this->perPage());
        return view(checkView('setting::contact_us.destroy'), compact('datas'));
    }

}
