<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Modules\Acl\Entities\RolePermission;
use Modules\Acl\Service\PermissionService;
use Modules\Acl\Service\RoleService;

class AddAdminRoleTableSeeder extends Seeder
{
    protected $permissionService, $roleService;

    public function __construct(PermissionService $permissionService, RoleService $roleService)
    {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = $this->roleService->findBy(new Request(['name' => 'admin']), false,'first');
        RolePermission::where('role_id',$role->id)->forceDelete();
        foreach ($this->permissionService->findBy(new Request()) as $value) {
            RolePermission::create(['role_id' => $role->id, 'permission_id' => $value->id]);
        }
    }
}
