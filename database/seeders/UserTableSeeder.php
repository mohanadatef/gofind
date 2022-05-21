<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            //admin default data
            [
                'id'=>1,
                'fullname' => 'admin',
                'email' => 'admin@gofind.com',
                'password' => Hash::make('admin@gofind.com'),
                'mobile' => '00000000000',
                'role_id' =>1,
                'status' => 1,
                'city_id' =>1,
                'state_id' =>1,
            ]);
    }
}
