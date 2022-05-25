<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\Country\CountryListResource;
use Modules\CoreData\Http\Resources\Country\CountryResource;
use Modules\CoreData\Repositories\CountryRepository;

class CountryService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(CountryRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$trash = false,$pagination = false , $perPage = 10)
    {
        return $this->repo->findBy($request,$trash,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'country');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'country');
        return new CountryResource($data);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'country');
        return CountryListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

}
