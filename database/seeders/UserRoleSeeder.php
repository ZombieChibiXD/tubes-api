<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = [
            [
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'role_id' => 2,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ],
        ];

        UserRole::insert($userRoles);
    }
}
