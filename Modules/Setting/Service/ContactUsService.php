<?php

namespace Modules\Setting\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Setting\Http\Resources\ContactUs\ContactUsListResource;
use Modules\Setting\Repositories\ContactUsRepository;

class ContactUsService extends BasicService
{
    protected $repo;

    /**
     * Create a new Repository instance.
     *
     * @return void
     */

    public function __construct(ContactUsRepository $repository)
    {
        $this->repo = $repository;
    }

    public function findBy(Request $request, $trash = false, $pagination = false, $perPage = 10)
    {
        if(!isset($request->property_id))
        {
            $request->merge(['property_id'=>0]);
        }
        ActiveLog(null, actionType()['va'], 'contact_us');
        return $this->repo->findBy($request, $trash, $pagination, $perPage);
    }

    public function store(Request $request)
    {
        $data = $this->repo->save($request);
        ActiveLog($data, actionType()['ca'], 'contact_us');
        return $data;
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        ActiveLog(null, actionType()['va'], 'home_slider');
        return ContactUsListResource::collection($this->repo->list($request,$pagination, $perPage));
    }
}
