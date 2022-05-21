<?php

namespace Modules\Acl\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'permission_group'
    ];

    protected $table = 'permissions';

    public $timestamps = true;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['display_name', 'description'];

    public $searchRelationShip = [];

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

    public static function translationKey()
    {
        return ['display_name', 'description'];
    }

    public static $rules = [];

    public static function getValidationRules()
    {
        return self::$rules;
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function display_name()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key', 'display_name')
            ->where('language_id', languageId())->withTrashed();
    }

    public function description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key', 'description')
            ->where('language_id', languageId())->withTrashed();
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public function role_permission()
    {
        return $this->hasMany(RolePermission::Class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($permission) {
            $permission->translation()->delete();
            $permission->role_permission()->delete();
        });

        static::restoring(function ($permission) {
            $permission->translation()->withTrashed()->restore();
            $permission->role_permission()->withTrashed()->restore();
        });

        static::forceDeleted(function ($permission) {
            $permission->translation()->forceDelete();
            $permission->role_permission()->forceDelete();
        });
    }
}
