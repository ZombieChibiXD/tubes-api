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
                'name' => 'ADMINISTRATOR'
            ],
            [
                'id' => 2,
                'name' => 'MEMBER'
            ]
        ];

        Role::insert($roles);
    }
}
