<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Reporter']);
        Role::create(['name' => 'Gross_doctor']);
        Role::create(['name' => 'Micro_doctor']);
        Role::create(['name' => 'User']);
    }
}
