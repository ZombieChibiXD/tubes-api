<?php

namespace Database\Seeders;

use App\Models\ToolItemSequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolItemSequenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sequences = [
            [
                'id' => 1,
                'tool_product_id' => 1,
                'next_value' => 11,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
            ],
            [
                'id' => 2,
                'tool_product_id' => 2,
                'next_value' => 11,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
            ]
        ];

        ToolItemSequence::insert($sequences);
    }
}
