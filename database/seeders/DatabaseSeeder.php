<?php

namespace Database\Seeders;

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
            UserBasicSeeder::class,
            ToolMaterialSeeder::class,
            ToolProductSeeder::class,
            ToolProductToolboxSeeder::class,
            ToolColorCodeSeeder::class,
            ToolItemSeeder::class,
            ToolProductToolboxSequenceSeeder::class,
        ]);
    }
}
