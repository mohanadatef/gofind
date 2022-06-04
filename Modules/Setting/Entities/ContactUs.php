<?php

namespace Modules\Setting\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Property\Entities\Property;

class ContactUs extends Model
{
    protected $fillable = [
        'status', 'subject', 'name', 'email', 'mobile', 'description','user_id','property_id'
    ];
    protected $table = 'contactus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $searchRelationShip = [];
    public static $rules = [
        'name' => 'required|string|min:2|max:50',
        'subject' => 'required|string|min:2|max:50',
        'email' => 'required|email|min:2|max:50',
        'description' => 'required|string|min:2|max:150',
        'mobile' => 'required|numeric|digits:12',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = [
        'subject' => 'like',
        'name' => 'like',
        'email' => 'like',
        'mobile' => 'like'
    ];

    public static function getValidationRules()
    {
        return self::$rules;
    }

    public function user()
    {
        return $this->belongsTo(User::Class, 'user_id')->withTrashed();
    }

    public function property()
    {
        return $this->belongsTo(Property::Class, 'property_id')->withTrashed();
    }
}
