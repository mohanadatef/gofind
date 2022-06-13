<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Basic\Entities\Media;
use Modules\Basic\Entities\Translation;

class Setting extends Model
{
    protected $fillable = [
        'key','value'
    ];
    protected $table = 'settings';
    public $timestamps = true;

    use SoftDeletes;
    public $searchRelationShip  = [];
    protected $dates = ['deleted_at'];

    public static $rules = [
        'logos' => 'image|mimes:jpg,jpeg,png,gif',
    ];
    /**
     * [columns that needs to has customed search such as like or where in]
     *
     * @var string[]
     */
    public $searchConfig = ['key'=>'like'];
    public function translation()
    {
        return $this->morphMany(Translation::class, 'category');
    }
    public static function translationKey(){
        return ['home_section_1_title'];
    }
    public function home_section_1_title()
    {
        return $this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_1_title')
            ->where('language_id' ,languageId());
    }

    public function home_section_1_titleValue()
    {
        $home_section_1_titles=$this->morphone(Translation::class, 'category')
            ->where('key' ,'home_section_1_title')->get();
        return $home_section_1_titles->pluck('value','language.code')->toArray();
    }
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

    public function logo()
    {
        return $this->media()->whereType(mediaType()['lo'])->whereNull('deleted_at');
    }
    public function image()
    {
        return $this->media()->whereType(mediaType()['im'])->whereNull('deleted_at');
    }
    public function images()
    {
        return $this->medias()->whereType(mediaType()['im'])->whereNull('deleted_at');
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->media()->delete();
        });

        static::restoring(function ($user) {
            $user->media()->withTrashed()->restore();
        });
    }
}
