<?php

namespace Database\Seeders;

use App\Models\ToolProductMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tool_product_material = [
            [
                'id' => 1,
                'tool_product_id' => 1,
                'tool_material_id' => 1,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
            ],
            [
                'id' => 2,
                'tool_product_id' => 2,
                'tool_material_id' => 1,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
            ],
        ];
        ToolProductMaterial::insert($tool_product_material);
    }
}
