<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class HomeSliderPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'home slider index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider index',
                'description' => 'view home slider index'
            ],
            [
                'name' => 'home slider create',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider create',
                'description' => 'home slider create'
            ],
            [
                'name' => 'home slider filter',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider filter',
                'description' => 'home slider filter'
            ],
            [
                'name' => 'home slider edit',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider edit',
                'description' => 'home slider edit'
            ],
            [
                'name' => 'home slider delete',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider delete',
                'description' => 'home slider delete'
            ],
            [
                'name' => 'home slider restore',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider restore',
                'description' => 'home slider restore'
            ],
            [
                'name' => 'home slider remove',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider remove',
                'description' => 'home slider remove'
            ],
            [
                'name' => 'home slider trash index',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider trash index',
                'description' => 'view home slider trash index'
            ],
            [
                'name' => 'home slider change status',
                'permission_group' => permissionGroup()['cp'],
                'display_name' => 'home slider change status',
                'description' => 'home slider change status'
            ],
        ];
        foreach ($permissions as $value) {
            $data = app()->make(PermissionService::class)->findBy(new Request(['name' => strtolower(str_replace([" " ,'_'],"-",$value['name']))]), 'count');
            if ($data == 0) {
                $permission = Permission::create(['name' => str_replace([" " ,'_'],"-",$value['name']), 'permission_group' => $value['permission_group']]);
                foreach (language() as $lang) {
                    $permission->translation()->create(['key' => 'display_name', 'value' => $value['display_name'], 'language_id' => $lang->id]);
                    $permission->translation()->create(['key' => 'description', 'value' => $value['description'], 'language_id' => $lang->id]);
                }
            }
        }
    }
}
