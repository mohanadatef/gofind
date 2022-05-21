<?php

use Modules\Basic\Service\CustomTranslationService;
use Modules\Setting\Service\SettingService;
use Modules\Basic\Service\LogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @Target this file to make function to help for all system
 * @note can call it in all system
 */
/**
 * user login
 */
function user()
{
    if (Auth::guard('web')->check()) {
        return Auth::guard('web')->user();
    }elseif(Auth::guard('api')->check()){
        return Auth::guard('api')->user();
    }
}

/**
 * to execution time for web
 */
function executionTime()
{
    ini_set('max_execution_time', 120000);
    ini_set('post_max_size', 120000);
    ini_set('upload_max_filesize', 100000);
}


/**
 * @param $view @note path blade in code
 * @if mixed will send page 404
 */
function checkView($view)
{
    return view()->exists($view) ? $view : 'errors.404';
}

/**
 * @param $key string want translation it in system
 * database|trans from laravel|trans string only
 */
function getCustomTranslation($key)
{
    $custom = app()->make(CustomTranslationService::class)->findBy(new Request(['status' => activeType()['as'], 'key' => strtolower($key)]), false, false, 0, 'first');
    return $custom->value->value ?? trans('lang.' . $key);
}

/**
 * @param $key string want to know setting value in system
 */
function getValueSetting(string $key)
{
    return app()->make(SettingService::class)->findBy(new Request(['key' => strtolower($key)]), 'first')->value ?? "";
}

/**
 * @Target logo system from setting
 * @note cache this query 60*60*60
 * @throws Exception
 */
function getLogoSetting()
{
    $data = app()->make(SettingService::class)->findBy(new Request(['key' => 'logos']), 'first');
    return getFile($data->logo->file ?? null, pathType()['ip'], getFileNameServer($data->logo));
}

function getImageSetting($image,$get='')
{
    $data = app()->make(SettingService::class)->findBy(new Request(['key' =>$image]), 'first');
    if($get == '')
    {
        $files=[];
        foreach($data->images as $image)
        {
        $files[]= getFile($image->file ?? null, pathType()['ip'], getFileNameServer($image));
        }
         return $files;
        }
    return getFile($data->image->file ?? null, pathType()['ip'], getFileNameServer($data->image));

}

/**
 * @Target log all system
 */
function ActiveLog($affected, $action = '', $comment = '')
{
    $done_by = user()->id ?? 0;
    $affected = !empty($affected) ? ['id' => $affected->id ?? null, 'type' => get_class($affected) ?? null] : ['id' => null, 'type' => null];
    $newRequest = new Request(['action' => $action, 'comment' => $comment, 'affected_id' => $affected['id'], 'affected_type' => $affected['type'], 'url' => Request()->fullUrl(), 'done_by' => $done_by]);
    app()->make(LogService::class)->store($newRequest);
}


function permissionShow($name)
{
    return DB::table('permissions')
        ->join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
        ->where('role_permissions.role_id', user()->role_id ?? 0)->where('permissions.name', $name)->count();
}

