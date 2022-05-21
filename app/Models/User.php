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
use Modules\CoreData\Entities\State;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'mobile', 'status',
        'city_id', 'state_id', 'token',  'description', 'tax_number', 'available', 'commercial_number',
        'info', 'role_id'
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
    protected $with = ['avatar', 'city', 'state', 'role'];
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
        'fullname' => 'required|min:2|max:50|string',
        'role_id' => 'required|exists:roles,id',
        'email' => 'regex:/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]/|min:2|max:50|email|unique:users',
        'mobile' => 'required|numeric|digits:12|unique:users',
        'city_id' => 'exists:cities,id',
        'state_id' => 'exists:states,id',
    ];

    public static $rulesUpdate = [
        'avatar' => 'image|mimes:jpg,jpeg,png,gif',
        'description' => 'string|min:3|max:150',
        'info' => 'string|min:3|max:150',
    ];

    protected static $PasswordRules = ['password' => 'required|min:8'];

    //todo role
    public static function getValidationRules()
    {
        $rules = self::$rules;
        $rules['email'] .= "|required_if:role_id,2";
        $rules['city_id'] .= "|required_if:role_id,2";
        $rules['category'] .= '|required_if:role_id,3,4';
        $rules = array_merge($rules, self::$PasswordRules);
        return $rules;
    }

    public static function getValidationRulesLogin()
    {
        return self::$PasswordRules;
    }

    public static function getValidationRulesUpdate()
    {
        $rulesCreate = self::$rules;
        unset($rulesCreate['username'], $rulesCreate['mobile'], $rulesCreate['email'], $rulesCreate['role_id']);
        $rulesUpdate = array_merge($rulesCreate, self::$rulesUpdate);
        return $rulesUpdate;
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
