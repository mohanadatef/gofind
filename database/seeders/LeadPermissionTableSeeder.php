<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\Permission;
use Modules\Acl\Service\PermissionService;

class LeadPermissionTableSeeder extends Seeder
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
                'name' => 'lead index',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'lead index',
                'description' => 'view lead index'
            ],
            [
                'name' => 'lead filter',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'lead filter',
                'description' => 'lead filter'
            ],
            [
                'name' => 'lead delete',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'lead delete',
                'description' => 'lead delete'
            ],
            [
                'name' => 'lead restore',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'lead restore',
                'description' => 'lead restore'
            ],
            [
                'name' => 'lead remove',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'lead remove',
                'description' => 'lead remove'
            ],
            [
                'name' => 'lead trash index',
                'permission_group' => permissionGroup()['ap'],
                'display_name' => 'lead trash index',
                'description' => 'view lead trash index'
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
