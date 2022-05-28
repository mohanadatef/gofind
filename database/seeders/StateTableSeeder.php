<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\CoreData\Entities\State;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = [
            //state
            [
                "order" => 1,
                "name" => "منطقه الرياض",
                "city_id" => 1,
                 "country_id" => 1,
            ],
        ];
        foreach ($state as $value) {
            $data = State::create(['order'=>$value['order'],'city_id'=>$value['city_id'],'country_id' => $value['country_id']]);
            foreach (language() as $lang) {
                $data->translation()->create(['key' => 'name', 'value' => $value['name'], 'language_id' => $lang->id]);
            }
        }
    }
}
