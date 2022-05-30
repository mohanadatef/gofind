<?php

namespace Modules\Property\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyPrice extends Model
{
    protected $fillable = [
        'name','info','property_id'
    ];
    protected $table = 'property_prices';
    public $timestamps = true;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public function property()
    {
        return $this->belongsTo(Property::Class, 'property_id')->withTrashed();
    }
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
