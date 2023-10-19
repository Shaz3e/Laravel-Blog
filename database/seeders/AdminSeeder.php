<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@email.com',
                'password' => 'password',
                'role_id' => '1',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => 'password',
                'role_id' => '2',
            ],
            [
                'name' => 'manager',
                'email' => 'manager@email.com',
                'password' => 'password',
                'role_id' => '3',
            ],
            [
                'name' => 'staff',
                'email' => 'staff@email.com',
                'password' => 'password',
                'role_id' => '4',
            ],
            [
                'name' => 'user',
                'email' => 'user@email.com',
                'password' => 'password',
                'role_id' => '5',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
