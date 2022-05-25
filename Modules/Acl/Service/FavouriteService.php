<?php

namespace Modules\Acl\Service;

use Illuminate\Http\Request;
use Modules\Acl\Http\Resources\User\UserListResource;
use Modules\Acl\Repositories\FavouriteRepository;
use Modules\Basic\Service\BasicService;

class FavouriteService extends BasicService
{
    protected  $userService, $repository;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */
    public function __construct(UserService $userService, FavouriteRepository $repository)
    {
        $this->userService = $userService;
        $this->repo = $repository;
    }

    public function store(Request $request)
    {
        $checkModel = $this->{$request->model . 'Service'} ?? null;
        if ($checkModel) {
            $data = $this->{$request->model . 'Service'}->show($request->id);
            if ($data->favourite()->where('user_id', user()->id)->count()) {
                $data->favourite()->forceDelete();
                ActiveLog($data, actionType()['da'], $request->model);
            } else {
                $data->favourite()->create(['user_id' => user()->id]);
                ActiveLog($data, actionType()['ca'], $request->model);
            }
            return true;
        }
        return false;
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], $request->model);
        $request->merge(['user_id' => user()->id]);
        $data = $this->repo->findBy($request, ['where' => ['category_type' => [$request->model]]], $pagination, $perPage, ['category_id', 'category_id'])->toArray();
        if (!empty($data)) {
            if ($request->model == 'user') {
                return UserListResource::collection($this->userService->findBy(new Request(['id' => $data])));
            }
        }

        return [];
    }

}
