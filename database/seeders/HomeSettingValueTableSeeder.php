<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\SettingService;

class HomeSettingValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $setting = [
            ['key' => 'home_section_1_title','value'=>''],
            ['key' => 'home_section_1_image','value'=>""],
            ['key' => 'home_section_1_description','value'=>""],
            ['key' => 'home_section_1_link','value'=>""],
            ['key' => 'home_section_2_title','value'=>""],
            ['key' => 'home_section_2_description','value'=>""],
            ['key' => 'home_section_2_video_link','value'=>""],
            ['key' => 'home_section_3_title','value'=>""],
            ['key' => 'home_section_3_image','value'=>""],
            ['key' => 'home_section_4_title','value'=>""],
            ['key' => 'home_section_4_url','value'=>""],
            ['key' => 'home_section_5_title','value'=>""],
            ['key' => 'home_section_5_image','value'=>""],
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
