<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'access hospital']);
        Permission::create(['name' => 'write hospital']);
        Permission::create(['name' => 'edit hospital']);
        Permission::create(['name' => 'delete hospital']);

        Permission::create(['name' => 'access specimen']);
        Permission::create(['name' => 'write specimen']);
        Permission::create(['name' => 'edit specimen']);
        Permission::create(['name' => 'delete specimen']);

        Permission::create(['name' => 'access aspirate']);
        Permission::create(['name' => 'write aspirate']);
        Permission::create(['name' => 'edit aspirate']);
        Permission::create(['name' => 'delete aspirate']);

        Permission::create(['name' => 'access trephine']);
        Permission::create(['name' => 'write trephine']);
        Permission::create(['name' => 'edit trephine']);
        Permission::create(['name' => 'delete trephine']);

        Permission::create(['name' => 'access histo']);
        Permission::create(['name' => 'write histo']);
        Permission::create(['name' => 'edit histo']);
        Permission::create(['name' => 'delete histo']);

        Permission::create(['name' => 'access cyto']);
        Permission::create(['name' => 'write cyto']);
        Permission::create(['name' => 'edit cyto']);
        Permission::create(['name' => 'delete cyto']);

        Permission::create(['name' => 'access approve report']);
        Permission::create(['name' => 'write approve report']);
        Permission::create(['name' => 'edit approve report']);
        Permission::create(['name' => 'delete approve report']);

        Permission::create(['name' => 'access role']);
        Permission::create(['name' => 'write role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'job created notification']);
        Permission::create(['name' => 'result add notification']);
        Permission::create(['name' => 'approve result notification']);
    }
}
