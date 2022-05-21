<?php

namespace Modules\Basic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CoreData\Entities\Language;

class Translation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key', 'value', 'language_id'
    ];
    protected $table = 'translations';
    public $searchRelationShip  = [];
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['language'];
    public function translation()
    {
        return $this->morphTo();
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id')->withTrashed();
    }
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
}
