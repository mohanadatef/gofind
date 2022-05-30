<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Http\Resources\User\UserListResource;
use Modules\Acl\Http\Resources\User\UserLoginResource;
use Modules\Acl\Repositories\UserRepository;
use Modules\Basic\Service\BasicService;


class UserService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(UserRepository $repository)
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
        ActiveLog($data, actionType()['va'], 'user');
        return new UserLoginResource($data);
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
        ActiveLog($data, actionType()['ca'], 'user');
        if ($data) {
            return true;
        }
        return false;
    }

    public function update(Request $request)
    {
        $data = $this->repo->save($request, $request->id);
        ActiveLog($data, actionType()['ua'], 'user');
        if ($data) {
            return $data;
        }
        return false;
    }

    public function list(Request $request, $pagination = false, $perPage = 10, $recursiveRel = [])
    {
        ActiveLog(null, actionType()['va'], 'user');
        return UserListResource::collection($this->repo->findBy($request, false, [], [], '', ['*'], $pagination, $perPage, $recursiveRel));
    }

    public function profile(Request $request)
    {
        $data = $this->repo->findOne($request->id);
        ActiveLog($data, actionType()['va'], 'user');
        if ($data) {
            return $data;
        }
        return false;
    }
}
