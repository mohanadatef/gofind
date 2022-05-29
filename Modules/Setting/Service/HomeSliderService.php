<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\HomeSlider\HomeSliderListResource;
use Modules\Setting\Repositories\HomeSliderRepository;

class HomeSliderService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(HomeSliderRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$trash = false,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'home_slider');
        return $this->repo->findBy($request,$trash,$pagination,$perPage);
    }

    public function store(Request $request)
    {
        $data=$this->repo->save($request);
        ActiveLog(null, actionType()['va'], 'home_slider');
        return $data;
    }

    public function update(Request $request, $id)
    {
        $data = $this->repo->save($request, $id);
        ActiveLog($data, actionType()['va'], 'home_slider');
        return $data;
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'home_slider');
        return HomeSliderListResource::collection($this->repo->list($request,$pagination, $perPage));
    }

}
