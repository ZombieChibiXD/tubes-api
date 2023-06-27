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
        for ($t=1; $t <= 2; $t++)  {
            for ($i=1; $i <= 10; $i++) {
                $items[] = [
                    'tool_product_toolbox_id' => $t,
                    'tool_color_code_id' => $i,
                    'created_at' => DatabaseSeeder::SEED_DATE_DEFAULT,
                    'updated_at' => DatabaseSeeder::SEED_DATE_DEFAULT
                ];
            }
        }
        ToolItem::insert($items);
    }
}
