<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class OtpSettingValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'otp_authorization','value'=>""],
            ['key' => 'otp_app_id','value'=>""],
        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),'count');
            if ($data == 0) {
                Setting::create($value);
            }
        }
    }
}
