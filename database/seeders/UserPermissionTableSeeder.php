<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class UserPermissionTableSeeder extends Seeder
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
                'name' => 'user index',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user index',
                'description' => 'view user index'
            ],
            [
                'name' => 'user create',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user create',
                'description' => 'user create'
            ],
            [
                'name' => 'user filter',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user filter',
                'description' => 'user filter'
            ],
            [
                'name' => 'user edit',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user edit',
                'description' => 'user edit'
            ],
            [
                'name' => 'user show',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user show',
                'description' => 'user show'
            ],
            [
                'name' => 'user delete',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user delete',
                'description' => 'user delete'
            ],
            [
                'name' => 'user remove',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user remove',
                'description' => 'user remove'
            ],
            [
                'name' => 'user trash index',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user trash index',
                'description' => 'view user trash index'
            ],
            [
                'name' => 'user change status',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user change status',
                'description' => 'user change status'
            ],
            [
                'name' => 'user change password',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user change password',
                'description' => 'user change password'
            ],
            [
                'name' => 'user trash',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'user trash',
                'description' => 'user trash'
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
