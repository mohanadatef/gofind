<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\City;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = [
            [
                "order" => 1,
                "country_id" => 1,
                "name" => "الرياض",
            ],
        ];

        foreach ($city as $value) {
            $data = City::create(['order' => $value['order'],'country_id' => $value['country_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
