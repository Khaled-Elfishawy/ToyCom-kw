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
            'name' => 'add_brand',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'edit_brand',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'delete_brand',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'view_brand',
            'guard_name' => 'admin',
        ]);
    }
}
