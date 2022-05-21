<?php

namespace Modules\Basic\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Setting\Entities\Cancellation;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'comment', 'type','done_by','comment_id','cancellation_id'
    ];

    protected $table = 'comments';

    public $timestamps = true;
    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['done_by_user'];

    public function comment()
    {
        return $this->morphTo();
    }

    public function done_by_user()
    {
        return $this->belongsTo(User::class, 'done_by')->withTrashed();
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function parents()
    {
        return $this->belongsTo(Comment::class, 'comment_id',  'id');
    }

    public function parentsTree(){
        $all = collect([]);
        $parent = $this->parents;
        if($parent)
        {
            $all->push($parent);
            $all = $all->merge($parent->parentsTree());
        }
        return $all;
    }

    public function childs()
    {
        $all = collect([]);
        $childs = $this->children;
        if(!$childs->isEmpty())
        {
            foreach($childs as $children)
            {
                $all->push($children);
                $all = $all->merge($children->childs());
            }
        }
        return $all;
    }

    public function parentAndChildrenTree()
    {
        $childs = $this->childs();
        $parents = $this->parentsTree();
        $all = $parents->merge($childs);
        return $all;
    }

    public function cancellation()
    {
        return $this->belongsTo(Cancellation::class, 'cancellation_id');
    }
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];
}
