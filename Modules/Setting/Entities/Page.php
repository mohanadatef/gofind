<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class Page extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'pages';
    public $timestamps = true;

    use SoftDeletes;
    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name','description'];
    public static $rules = [
        'order' => 'required|numeric|unique:pages',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public static function getValidationRules()
    {
        return self::$rules;
    }

    public static function translationKey(){
        return ['name','description'];
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

    public function nameValue()
    {
         $names=$this->morphone(Translation::class, 'category')
            ->where('key' ,'name')->withTrashed()->get();
        return $names->pluck('value','language.code')->toArray();
    }

    public function descriptionValue()
    {
        $descriptions=$this->morphone(Translation::class, 'category')
            ->where('key' ,'description')->withTrashed()->get();
        return $descriptions->pluck('value','language.code')->toArray();
    }

    public function description()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'description')
            ->where('language_id' ,languageId())->withTrashed();
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($gender) {
            $gender->translation()->delete();
        });

        static::restoring(function($gender) {
            $gender->translation()->withTrashed()->restore();
        });
    }
}
