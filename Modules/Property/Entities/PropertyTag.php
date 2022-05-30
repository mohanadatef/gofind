<?php

namespace Modules\Property\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyTag extends Model
{
    protected $fillable = [
        'tag_id','property_id'
    ];
    protected $table = 'property_tags';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public static function boot() {
        parent::boot();
        static::deleting(function($property_tag) {
            $property_tag->delete();
        });

        static::restoring(function($property_tag) {
            $property_tag->withTrashed()->restore();
        });

        static::forceDeleted(function($property_tag) {
            $property_tag->forceDelete();
        });
    }
}
