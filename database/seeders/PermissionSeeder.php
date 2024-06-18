<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'index admin',
            'create admin',
            'show admin',
            'update admin',
            'delete admin',
            'index brand',
            'create brand',
            'show brand',
            'update brand',
            'delete brand',
            'index role',
            'create role',
            'show role',
            'update role',
            'delete role',
            'index permission',
            'create permission',
            'show permission',
            'update permission',
            'delete permission',
            'index category',
            'create category',
            'show category',
            'update category',
            'delete category',
             'index languages',
            'create languages',
            'show languages',
            'update languages',
            'delete languages'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
