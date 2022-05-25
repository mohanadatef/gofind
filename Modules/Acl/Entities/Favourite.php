<?php

namespace Modules\Acl\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favourite extends Model
{
    protected $fillable = [
        'user_id'
    ];
    protected $table = 'favourites';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
    public $searchRelationShip  = [];

    public function favourite()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
