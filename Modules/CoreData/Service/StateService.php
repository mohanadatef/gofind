<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\CoreData\Http\Resources\State\StateListResource;
use Modules\CoreData\Http\Resources\State\StateResource;
use Modules\CoreData\Repositories\StateRepository;

class StateService extends BasicService
{
    protected $repo,$countryService;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(StateRepository $repository,CountryService $countryService)
    {
        $this->repo = $repository;
        $this->countryService = $countryService;
    }

    public function findBy(Request $request,$trash = false,$pagination = false , $perPage = 10)
    {
        return $this->repo->findBy($request,$trash,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data,actionType()['ca'],'state');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data,actionType()['ua'],'state');
        return new StateResource($data);
    }

    public function list (Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null,actionType()['va'],'state');
        return StateListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

    public function getListCountry(Request $request){
        return $this->countryService->list($request);
    }
}
