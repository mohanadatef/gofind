<?php

namespace Modules\Basic\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Entities\Log;

class LogRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id','done_by','action','device'
    ];
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Log::class;
    }
    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    public function translationKey()
    {
        return [];
    }
    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    public function findBy(Request $request, $trash = false,$pagination = false , $perPage = 10)
    {
        return $this->all($request->all(), ['*'], [], [], [], $trash,[],[],'',null,null,$pagination,$perPage);
    }

    public function save(Request $request)
    {
        return DB::transaction(function () use ($request) {
            return $this->create($request->all());
        });
    }
}
