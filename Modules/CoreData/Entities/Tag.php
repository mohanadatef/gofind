<?php

namespace Modules\CoreData\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status'
    ];
    protected $table = 'tags';

    public $timestamps = true;
    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['name','category'];
    public static $rules = [
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
    public $searchConfig = [
        'name'=>'like',
    ];
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

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($tag) {
            $tag->translation()->delete();
        });

        static::restoring(function ($tag) {
            $tag->translation()->withTrashed()->restore();
        });
    }
}
