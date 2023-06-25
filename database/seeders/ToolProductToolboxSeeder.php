<?php

namespace Database\Seeders;

use App\Models\ToolProductMaterial;
use App\Models\ToolProductToolbox;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolProductToolboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toolToolbox = [];

        for ($p = 1; $p <= 2; $p++) {
            for ($t = 1; $t <= 2; $t++) {
                $toolToolbox[] = [
                    'tool_product_id' => $p,
                    'code' => $t,
                    'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                    'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
                ];
            }
        }

        ToolProductToolbox::insert($toolToolbox);
    }
}
