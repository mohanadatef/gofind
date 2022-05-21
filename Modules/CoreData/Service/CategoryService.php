<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Category\CategoryListResource;
use Modules\CoreData\Http\Resources\Category\CategoryResource;
use Modules\CoreData\Repositories\CategoryRepository;

class CategoryService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CategoryRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$trash = false,$pagination = false , $perPage = 10,$pluck = [])
    {
        return $this->repo->findBy($request,$trash,$pagination , $perPage,$pluck);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'category');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data=$this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'category');
        return new CategoryResource($data);
    }

    public function list (Request $request,$recursiveRel=[],$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'category');
        return CategoryListResource::collection($this->repo->list($request, [], $recursiveRel,$pagination,$perPage));
    }

}
