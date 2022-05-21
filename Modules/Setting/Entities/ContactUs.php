<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    protected $fillable = [
        'status','subject','name','email','mobile','description'
    ];
    protected $table = 'contactus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $searchRelationShip  = [];
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
        'subject'=>'like',
        'name'=>'like',
        'email'=>'like',
        'mobile'=>'like'
    ];
    public static function getValidationRules()
    {
        return self::$rules;
    }
}
