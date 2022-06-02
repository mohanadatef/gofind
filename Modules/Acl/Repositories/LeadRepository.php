<?php

namespace Modules\Acl\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Acl\Entities\Lead;
use Modules\Basic\Repositories\BasicRepository;

class LeadRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'mobile', 'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Lead::class;
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

    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
    }

    public function translationKey()
    {
        return [];
    }

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $withRelations = [], $get = '', $column = ['*'], $pagination = false, $perPage = 10, $recursiveRel = [], $orderBy = [])
    {
        return $this->all($request->all(), $column, $withRelations, $recursiveRel, $moreConditionForFirstLevel, $trash, [], $orderBy, $get, null, null, $pagination, $perPage);
    }

    public function findOne($id)
    {
        return $this->find($id, ['*']);
    }

    public function save(Request $request)
    {
        return $this->create($request->all());
    }
}
