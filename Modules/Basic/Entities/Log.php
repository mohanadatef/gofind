<?php

namespace Modules\Basic\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    protected $fillable = ['comment', 'action', 'done_by', 'url','affected_id','affected_type'];

    protected $table = 'logs';

    public $timestamps = true;
    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['done_by_user'];
    public function affected()
    {
        return $this->morphTo();
    }

    public function done_by_user()
    {
        return $this->belongsTo(User::class, 'done_by')->withTrashed();
    }

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

}
