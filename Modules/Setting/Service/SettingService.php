<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\Setting\SettingListResource;
use Modules\Setting\Repositories\SettingRepository;

class SettingService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(SettingRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request,$get='',$pluck=[])
    {
        ActiveLog(null, actionType()['va'], 'setting');
        return $this->repo->findBy($request,$get,$pluck);
    }

    public function update(Request $request)
    {
        ActiveLog(null, actionType()['ua'], 'setting');
        return $this->repo->save($request);
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'setting');
        return SettingListResource::collection($this->repo->list($request,$pagination,$perPage));
    }

}
