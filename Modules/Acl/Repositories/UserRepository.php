<?php

namespace Modules\Acl\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Basic\Repositories\BasicRepository;

class UserRepository extends BasicRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id', 'city_id', 'status', 'state_id', 'country_id', 'facebook_id', 'order', 'mobile', 'email',
        'fullname', 'created_at', 'role_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
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

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $withRelations = [], $get = '', $column = ['*'], $pagination = false, $perPage = 10, $recursiveRel = [],$orderBy=[])
    {
        return $this->all($request->all(), $column, $withRelations, $recursiveRel, $moreConditionForFirstLevel, $trash, [], $orderBy, $get, null, null, $pagination, $perPage);
    }

    public function findOne($id)
    {
        return $this->find($id, ['*']);
    }

    public function save(Request $request, $id = null)
    {
        return DB::transaction(function () use ($request, $id) {
            if (isset($request->password)) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            if ($id) {
                $this->update($request->all(), $id);
                $data = $this->findOne($id);
            } else {
                $data = $this->create($request->all());
            }
            if (isset($request->avater)) {
                $this->checkMediaDelete($data, $request, mediaType()['am']);
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['am']);
            }
            return $data;
        });
    }
}
