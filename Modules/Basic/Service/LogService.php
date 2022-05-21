<?php

namespace Modules\Basic\Service;

use Illuminate\Http\Request;
use Modules\Basic\Repositories\LogRepository;

class LogService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     * @return void
     */

    public function __construct(LogRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$trash = false,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'log');
        return $this->repo->findBy($request,$trash,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        return $this->repo->save($request);
    }

}
