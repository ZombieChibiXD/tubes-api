<?php

namespace Database\Seeders;

use App\Models\ToolItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [];
        for ($i=1; $i <= 10; $i++) {
            $items[] = [
                'tool_product_id' => 1,
                'item_code' => $i,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ];
            $items[] = [
                'tool_product_id' => 2,
                'item_code' => $i,
                'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
            ];
        }
        ToolItem::insert($items);
    }
}
