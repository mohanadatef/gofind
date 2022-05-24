<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class State extends Model
{
    protected $fillable = [
        'status', 'order', 'city_id'
    ];
    protected $table = 'states';
    public $timestamps = true;
    public $searchRelationShip = [];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static $rules = [
        'order' => 'required|numeric|unique:cities',
        'city_id' => 'required|exists:cities,id',
    ];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name','city'];
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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }

    public function user()
    {
        return $this->hasMany(User::Class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($state) {
            $state->translation()->delete();
        });

        static::restoring(function ($state) {
            $state->translation()->withTrashed()->restore();
        });
    }

}
