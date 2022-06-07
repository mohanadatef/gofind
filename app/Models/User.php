<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Acl\Entities\Favourite;
use Modules\Acl\Entities\Role;
use Modules\Basic\Entities\Log;
use Modules\Basic\Entities\Media;
use Modules\CoreData\Entities\City;
use Modules\CoreData\Entities\Country;
use Modules\CoreData\Entities\State;
use Modules\Property\Entities\Property;
use Modules\Setting\Entities\ContactUs;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'mobile', 'status','city_id', 'state_id', 'token',
        'info','role_id','country_id','facebook_id','order'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['role'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */

    public $searchConfig = [
    ];
    public $searchRelationShip = [

    ];
    protected $dates = ['deleted_at'];
//TODO add :dns to email
    public static $rules = [
        'first_name' => 'required|min:2|max:50|string',
        'last_name' => 'required|min:2|max:50|string',
        'role_id' => 'required|exists:roles,id',
        'email' => 'required|regex:/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]/|min:2|max:50|email|unique:users',
        'mobile' => 'required|numeric|unique:users',
        'order' => 'numeric|unique:users',
        'city_id' => 'required|exists:cities,id',
        'country_id' => 'exists:countries,id',
        'state_id' => 'required|exists:states,id',
        'info' => 'string|min:3|max:150',
        'avatar' => 'image|mimes:jpg,jpeg,png,gif',
    ];


    protected static $PasswordRules = ['password' => 'required|min:8|confirmed'];

    public static function getValidationRules()
    {
        return array_merge(self::$rules, self::$PasswordRules);
    }

    public static function getValidationRulesUpdate()
    {
        return self::$rules;
    }

    public function getValidationRulesPassword()
    {
        return self::$PasswordRules;
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'category')->withTrashed();
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'category')->withTrashed();
    }

    public function avatar()
    {
        return $this->media()->whereType(mediaType()['am'])->whereNull('deleted_at');
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

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'category')->withTrashed();
    }

    public function role()
    {
        return $this->belongsTo(Role::Class, 'role_id')->withTrashed();
    }

    public function property()
    {
        return $this->hasMany(Property::class);
    }

    public function contact_us()
    {
        return $this->hasMany(ContactUs::Class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->medias()->delete();
            $user->favourite()->delete();
        });

        static::restoring(function ($user) {
            $user->medias()->withTrashed()->restore();
            $user->favourite()->withTrashed()->restore();
        });
    }
}
