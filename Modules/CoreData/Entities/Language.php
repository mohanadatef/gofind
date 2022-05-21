<?php

namespace Modules\CoreData\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Translation;

class Language extends Model
{
    protected $fillable = [
        'status','order','code','name'
    ];
    protected $table = 'languages';
    public $timestamps = true;
    public $searchRelationShip = [];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public static $rules = [
        'name' => 'required|string|unique:languages',
        'code' => 'required|string|unique:languages',
        'order' => 'required|numeric|unique:languages',
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

    public function scopeStatus($query,$status)
    {
        return $query->whereStatus($status);
    }

    public function scopeOrder($query,$order)
    {
        return $query->orderby('order',$order);
    }

    public function translation()
    {
        return $this->hasMany(Translation::class)->withTrashed();
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($language) {
            $language->translation()->delete();
        });

        static::restoring(function($language) {
            $language->translation()->withTrashed()->restore();
        });
    }
}
