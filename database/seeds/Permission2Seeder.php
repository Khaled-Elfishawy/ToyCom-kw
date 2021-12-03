<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Permission2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'add_admin',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'edit_admin',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'delete_admin',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_admin',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_permissions',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_roles',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'add_roles',
            'guard_name' => 'admin',
        ]);
    }
}
