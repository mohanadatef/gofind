<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class Country extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'countries';
    public $timestamps = true;
    public $searchRelationShip = [];
    use SoftDeletes;
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
    protected $dates = ['deleted_at'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public static $rules = [
        'order' => 'required|numeric|unique:countries',
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }

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
        return $this->hasMany(State::class);
    }

    public function city()
    {
        return $this->hasMany(City::class)->withTrashed();
    }

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($country) {
            $country->translation()->delete();
        });

        static::restoring(function($country) {
            $country->translation()->withTrashed()->restore();
        });
    }
}
