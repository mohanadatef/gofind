<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class settingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'name','value'=>'shogol'],
            ['key' => 'logos'],
            ['key' => 'Version','value'=>'1.0.0.0'],
            ['key' => 'facebook','value'=>''],
            ['key' => 'youtube','value'=>''],
            ['key' => 'linkedIn','value'=>''],
            ['key' => 'ios','value'=>''],
            ['key' => 'android','value'=>''],
        ];
        foreach ($setting as $value) {
            $data = app()->make(SettingService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),'count');
            if ($data == 0) {
                $data = ['key'=>strtolower($value['key']),'value'=>$value['value']??""];
                Setting::create($data);
            }
        }
    }
}
