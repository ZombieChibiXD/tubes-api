<?php

namespace Database\Seeders;

use App\Models\ToolProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $products = [
            [
                'id' => 1,
                'code' => 'WNGM 080408 NM LT 1000',
                'prefix' => 'LRW00',
                'min_cutting_speed' => 180,
                'max_cutting_speed' => 245,
                'tool_material_id' => 1,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ],
            [
                'id' => 2,
                'code' => 'WNGM 080408 NM LT 1025',
                'prefix' => 'LRW25',
                'min_cutting_speed' => 165,
                'max_cutting_speed' => 280,
                'tool_material_id' => 1,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ]
        ];

        ToolProduct::insert($products);
    }
}
