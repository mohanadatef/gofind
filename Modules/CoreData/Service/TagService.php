<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Tag\TagListResource;
use Modules\CoreData\Http\Resources\Tag\TagResource;
use Modules\CoreData\Repositories\TagRepository;

class TagService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(TagRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request, $trash = false, $pagination = false, $perPage = 10, $pluck = [])
    {
        return $this->repo->findBy($request, $trash, $pagination, $perPage, $pluck);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'tag');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data, actionType()['ua'], 'tag');
        return new TagResource($data);
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'tag');
        return TagListResource::collection($this->repo->list($request, $pagination, $perPage));
    }
}
