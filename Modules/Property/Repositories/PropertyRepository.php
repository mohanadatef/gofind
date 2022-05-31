<?php

namespace Modules\Property\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Repositories\BasicRepository;
use Modules\Property\Entities\Property;

class PropertyRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'name','country_id','city_id','state_id','user_id','status','order','count_view','category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Property::class;
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

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $withRelations = [], $get = '', $column = ['*'], $pagination = false, $perPage = 10, $recursiveRel = [])
    {
        return $this->all($request->all(), $column, $withRelations, $recursiveRel, $moreConditionForFirstLevel, $trash, [], [], $get, null, null, $pagination, $perPage);
    }

    public function findOne($id)
    {
        return $this->find($id, ['*']);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if ($id) {
                $this->update($request->all(), $id);
                $data = $this->findOne($id);
            } else {
                $data = $this->create($request->all());
            }
            if(isset($request->tag_id))
            {
                $data->tag()->sync((array)$request->tag_id);
            }
            if (isset($request->image)) {
                $this->checkMediaDelete($data, $request, mediaType()['im']);
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['im']);
            }
            return $data;
        });
    }
}
