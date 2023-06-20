<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const SEED_DATE_DEFAULT = '2021-10-01 00:00:00';
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
            ToolMaterialSeeder::class,
            ToolProductSeeder::class,
            ToolItemSeeder::class,
        ]);
    }
}
