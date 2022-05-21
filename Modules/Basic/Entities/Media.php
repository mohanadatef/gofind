<?php

namespace Modules\Basic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'file', 'type'
    ];

    protected $table = 'medias';
    public $searchRelationShip  = [];
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    public function media()
    {
        return $this->morphTo();
    }

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
}
