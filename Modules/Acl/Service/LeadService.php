<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Repositories\LeadRepository;
use Modules\Basic\Service\BasicService;


class LeadService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(LeadRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $get = '', $column = ['*'], $pagination = false, $perPage = 10, $recursiveRel = [])
    {
        return $this->repo->findBy($request, $trash, $moreConditionForFirstLevel, [], $get, $column, $pagination, $perPage, $recursiveRel);
    }


    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'lead');
        if ($data) {
            return true;
        }
        return false;
    }
}
