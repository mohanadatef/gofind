<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Basic\Entities\CustomTranslation;
use Modules\Basic\Service\CustomTranslationService;

class HomeSliderCustomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $custom = [
            ['key' => 'home_slider', 'value' => 'home slider'],
            ['key' => 'homeslider', 'value' => 'home slider'],
            ['key' => 'url', 'value' => 'url'],
        ];
        foreach ($custom as $value) {
            $data = app()->make(CustomTranslationService::class)->findBy(new Request(['key'=> strtolower($value['key'])]),false,false,10,'count');
            if ($data == 0) {
                $data = CustomTranslation::create(['key' => strtolower($value['key'])]);
                foreach (language() as $lang) {
                    $data->translation()->create(['key' => 'value', 'value' => $value['value'], 'language_id' => $lang->id]);
                }
            }
        }
    }
}
