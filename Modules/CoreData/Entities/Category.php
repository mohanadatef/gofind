<?php

namespace Modules\CoreData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class Category extends Model
{
    protected $fillable = [
        'status','order'
    ];
    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static $rules = [
        'order' => 'required|numeric|unique:categories',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public $searchRelationShip = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name'];
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

    public static function boot() {
        parent::boot();
        static::deleting(function($category) {
            $category->translation()->delete();
        });

        static::restoring(function($category) {
            $category->translation()->withTrashed()->restore();
        });
    }
}
