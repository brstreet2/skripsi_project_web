<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sentinel::getRoleRepository()->createModel()->create([
            'name'        => 'Root',
            'permissions' => ['dashboard' => true],
            'slug'        => 'root',
            'created_by'  => 'Root',
            'updated_by'  => 'Root',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name'        => 'Admin',
            'permissions' => [],
            'slug'        => 'admin',
            'created_by'  => 'Root',
            'updated_by'  => 'Root',
        ]);
    }
}
