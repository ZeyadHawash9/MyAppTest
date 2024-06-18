<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the new admin user
        $admin = Admin::create([
            'name' => 'Admin',
            'user_name' => 'Admin',
            'phone_number' => '0569465465',
            'email' => 'test@test.test',
            'password' => Hash::make('password'),
        ]);

        $admin->assignRole('super admin');
    }
}
