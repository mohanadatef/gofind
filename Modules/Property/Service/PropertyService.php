<?php

namespace Modules\Property\Service;

use Illuminate\Http\Request;
use Modules\Property\Http\Resources\Property\PropertyListResource;
use Modules\Property\Http\Resources\Property\PropertyResource;
use Modules\Property\Repositories\PropertyRepository;
use Modules\Basic\Service\BasicService;


class PropertyService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(PropertyRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $get = '', $column = ['*'], $pagination = false, $perPage = 10, $recursiveRel = [])
    {
        return $this->repo->findBy($request, $trash, $moreConditionForFirstLevel, [], $get, $column, $pagination, $perPage, $recursiveRel);
    }

    public function show($id)
    {
        $data = $this->repo->findOne($id);
        ActiveLog($data, actionType()['va'], 'property');
        return new PropertyResource($data);
    }

    public function changeStatus($id, $key)
    {
        $data = $this->repo->updateValue($id, $key);
        if ($data) {
            return true;
        }
        return false;
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'property');
        if ($data) {
            return true;
        }
        return false;
    }

    public function update(Request $request)
    {
        $data = $this->repo->save($request, $request->id);
        ActiveLog($data, actionType()['ua'], 'property');
        if ($data) {
            return $data;
        }
        return false;
    }

    public function list(Request $request, $pagination = false, $perPage = 10, $recursiveRel = [])
    {
        ActiveLog(null, actionType()['va'], 'property');
        return PropertyListResource::collection($this->repo->findBy($request, false, [], [], '', ['*'], $pagination, $perPage, $recursiveRel));
    }
}
