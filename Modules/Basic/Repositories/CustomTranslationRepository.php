<?php

namespace Modules\Basic\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Basic\Entities\CustomTranslation;

class CustomTranslationRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'status','key'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CustomTranslation::class;
    }
    public function getFieldsRelationShipSearchable()
    {
        return $this->model->searchRelationShip;
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
        return $this->model->translationKey();
    }

    public function findBy(Request $request, $trash = false,$pagination = false , $perPage = 10,$get='')
    {
        return $this->all($request->all(), ['*'], [], [], [], $trash,[],[],$get,null,null,$pagination,$perPage);
    }

    public function findOne($id)
    {
        return $this->find($id, ['*'], ['translation']);
    }

    public function save(Request $request, $id = null)
    {
        cache()->delete('custom');
        return DB::transaction(function () use ($request, $id) {
            $request->merge(['key'=>strtolower($request->key)]);
            if ($id) {
                $data = $this->findOne($id);
            } else {
                $data = $this->create($request->all());
            }
            $this->updateOrCreateLanguage($data, $request, $this->translationKey());
            return $data;
        });
    }

    public function updateValue($id, $key)
    {
        cache()->delete('custom');
        return $this->change($this->find($id), $key);
    }

    public function delete($id)
    {
        cache()->delete('custom');
        return $this->find($id)->delete();
    }

    public function restore($id)
    {
        cache()->delete('custom');
        return $this->find($id, ['*'], [], true)->restore();
    }

    public function list(Request $request,$pagination = false , $perPage = 10)
    {
        $request->merge(['status' => activeType()['as']]);
        return $this->all($request->all(), ['*'], [], [], [], false, [], ['column' => 'id', 'order' => 'asc'],'',null,null,$pagination,$perPage);
    }
}
