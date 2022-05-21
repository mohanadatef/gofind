<?php

namespace App\Http\Controllers;

use Modules\Basic\Http\Controllers\BasicController;

class HomeController extends BasicController
{
    protected $service;
    /**
     * @required must user be login
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','admin']);
        $this->middleware('permission:dashboard')->only('show');
    }

    /**
     * @result page main in system
     */
    public function index()
    {
        ActiveLog(null,actionType()['va'],'DashBoard');
        return view(checkView('admin.admin'));
    }

    /**
     * @result page 404
     */
    public function error_404()
    {
        ActiveLog(null,actionType()['va'],'404');
        return view(checkView('errors.404'));
    }
}
