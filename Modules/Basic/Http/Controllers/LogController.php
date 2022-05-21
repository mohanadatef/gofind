<?php

namespace Modules\Basic\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Basic\Service\LogService;

class LogController extends BasicController
{
    protected $service;

    public function __construct(LogService $Service)
    {
        $this->middleware('auth');
        $this->middleware('permission:log-index')->only('index');
        $this->service = $Service;
    }

    public function index(Request $request)
    {
        $datas = $this->service->findBy($request,false,true,$this->perPage());
        return view('basic::log.index', compact('datas'));
    }

}
