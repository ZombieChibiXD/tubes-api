<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'ADMINISTRATOR',
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
                
            ],
            [
                'id' => 2,
                'name' => 'MEMBER',
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ]
        ];

        Role::insert($roles);
    }
}
