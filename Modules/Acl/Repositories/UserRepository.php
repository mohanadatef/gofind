<?php

namespace Modules\Acl\Repositories;

use App\Models\User;
use Carbon\Carbon;
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
        'id',  'city_id',  'status', 'state_id',
         'mobile', 'email','fullname','created_at','role_id'
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

    public function findBy(Request $request, $trash = false, $moreConditionForFirstLevel = [], $withRelations = [], $get = '', $column = ['*'],$pagination = false , $perPage = 10,$recursiveRel=[])
    {
        return $this->all($request->all(), $column, $withRelations, $recursiveRel, $moreConditionForFirstLevel, $trash, [], [], $get,null,null,$pagination,$perPage);
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
                $data = $this->update($request->all(), $id);
                $this->checkMediaDelete($data,$request,mediaType()['am']);
                $this->media_upload($data, $request, createFileNameServer($this->model(), $data->id), pathType()['ip'], mediaType()['am']);
            } else {
                $data = $this->create($request->all());
            }
            return isset($id) ? $this->findOne($id) : $data;
        });
    }
}
