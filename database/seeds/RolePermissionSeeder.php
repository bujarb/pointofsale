<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(2);
        $user = Role::find(1);

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
          $admin->attachPermission($permission);
        }
    }
}
