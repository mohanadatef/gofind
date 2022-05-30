<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class PropertyPermissionTableSeeder extends Seeder
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
                'name' => 'property index',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property index',
                'description' => 'view property index'
            ],
            [
                'name' => 'property create',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property create',
                'description' => 'property create'
            ],
            [
                'name' => 'property filter',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property filter',
                'description' => 'property filter'
            ],
            [
                'name' => 'property edit',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property edit',
                'description' => 'property edit'
            ],
            [
                'name' => 'property delete',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property delete',
                'description' => 'property delete'
            ],
            [
                'name' => 'property restore',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property restore',
                'description' => 'property restore'
            ],
            [
                'name' => 'property remove',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property remove',
                'description' => 'property remove'
            ],
            [
                'name' => 'property trash index',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property trash index',
                'description' => 'view property trash index'
            ],
            [
                'name' => 'property change status',
                'permission_group' => permissionGroup()['pp'],
                'display_name' => 'property change status',
                'description' => 'property change status'
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
