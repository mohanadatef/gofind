<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status', 'order'
    ];
    protected $table = 'cities';

    public $timestamps = true;
    public $searchRelationShip = [];
    protected $dates = ['deleted_at'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    public static $rules = [
        'order' => 'required|numeric|unique:cities',
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public static function translationKey(){
        return ['name'];
    }

    public function translation()
    {
        return $this->morphMany(Translation::class, 'category')->withTrashed();
    }

    public function name()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'name')
            ->where('language_id' ,languageId())->withTrashed();
    }

    public function state()
    {
        return $this->hasMany(state::class);
    }

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($city) {
            $city->translation()->delete();
        });

        static::restoring(function ($city) {
            $city->translation()->withTrashed()->restore();
        });
    }
}
