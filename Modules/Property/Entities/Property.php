<?php

namespace Modules\Property\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Acl\Entities\Favourite;
use Modules\Basic\Entities\Media;
use Modules\CoreData\Entities\City;
use Modules\CoreData\Entities\Country;
use Modules\CoreData\Entities\State;
use Modules\CoreData\Entities\Tag;

class Property extends Model
{
    protected $fillable = [
        'name','info','country_id','city_id','state_id','user_id','status','order','count_view','category_id'
    ];

    protected $table = 'properties';

    public $timestamps = true;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [];

    public $searchRelationShip = [
        'tag_id'=>'tag->id'
    ];

    use SoftDeletes;

    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [];

    protected $dates = ['deleted_at'];

    public static $rules = [
        'name' => 'required|min:2|max:50|string',
        'order' => 'numeric|nullable',
        'city_id' => 'required|exists:cities,id',
        'user_id' => 'required|exists:users,id',
        'country_id' => 'required|exists:countries,id',
        'category_id' => 'required|exists:categories,id',
        'state_id' => 'required|exists:states,id',
        'info' => 'required|string|min:3|max:150',
        'image' => 'image|mimes:jpg,jpeg,png,gif',
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category')->withTrashed();
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'category')->withTrashed();
    }

    public function image()
    {
        return $this->media()->whereType(mediaType()['im'])->whereNull('deleted_at');
    }

    public function country()
    {
        return $this->belongsTo(Country::Class, 'country_id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::Class, 'city_id')->withTrashed();
    }

    public function state()
    {
        return $this->belongsTo(State::Class, 'state_id')->withTrashed();
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'category')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id')->withTrashed();
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::Class, 'property_tags');
    }

    public function property_tag()
    {
        return $this->hasManyThrough(Tag::Class, PropertyTag::Class, 'property_id', 'id', 'id', 'tag_id');
    }

    public function price()
    {
        return $this->hasMany(PropertyPrice::Class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($property) {
            $property->medias()->delete();
            $property->favourite()->delete();
            $property->property_tag()->delete();
        });

        static::restoring(function ($property) {
            $property->medias()->withTrashed()->restore();
            $property->favourite()->withTrashed()->restore();
            $property->property_tag()->withTrashed()->restore();
        });
    }
}
