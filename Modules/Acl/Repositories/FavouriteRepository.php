<?php

namespace Modules\Acl\Repositories;

use Illuminate\Http\Request;
use Modules\Acl\Entities\Favourite;
use Modules\Basic\Repositories\BasicRepository;

class FavouriteRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Favourite::class;
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

    public function findBy(Request $request, $moreConditionForFirstLevel = [],$pagination = false , $perPage = 10,$pluck=[])
    {
        return $this->all($request->all(), ['*'], [], [], $moreConditionForFirstLevel, false, $pluck, [], '',null,null,$pagination,$perPage);
    }

}
