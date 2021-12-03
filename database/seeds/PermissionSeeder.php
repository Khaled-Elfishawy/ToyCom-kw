<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'add_age',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'delete_age',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_age',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'edit_age',
            'guard_name' => 'admin',
        ]);

        Permission::create([
            'name' => 'add_wrapping',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'delete_wrapping',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_wrapping',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'edit_wrapping',
            'guard_name' => 'admin',
        ]);

        Permission::create([
            'name' => 'add_cardColors',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'delete_cardColors',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_cardColors',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'edit_cardColors',
            'guard_name' => 'admin',
        ]);
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
            'name' => 'view_reports',
            'guard_name' => 'admin',
        ]);
    }
}
