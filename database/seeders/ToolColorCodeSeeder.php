<?php

namespace Database\Seeders;

use App\Models\ToolColorCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolColorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            // ['id', 'code', 'bg-color', 'text-color'],
            [1, 'R', '#FF0000', '#FFFFFF'],     // Red with white text
            [2, 'B', '#0000FF', '#FFFFFF'],     // Blue with white text
            [3, 'Y', '#FFFF00', '#000000'],     // Yellow with black text
            [4, 'G', '#00FF00', '#000000'],     // Green with black text
            [5, 'T', '#A52A2A', '#FFFFFF'],     // Brown with white text
            [6, 'V', '#800080', '#FFFFFF'],     // Purple with white text
            [7, 'O', '#FFA500', '#000000'],     // Orange with black text
            [8, 'W', '#FFFFFF', '#000000'],     // White with black text
            [9, 'K', '#000000', '#FFFFFF'],     // Black with white text
            [10, 'X', '#808080', '#000000'],    // Gray with black text
            [11, 'P', '#FFC0CB', '#000000'],    // Pink with black text
            [12, 'Q', '#40E0D0', '#000000'],    // Turquoise with black text
            [13, 'L', '#808000', '#000000'],    // Olive with black text
            [14, 'S', '#C0C0C0', '#000000'],    // Silver with black text
            [15, 'D', '#FFD700', '#000000'],    // Gold with black text
            [16, 'M', '#FF00FF', '#000000'],    // Magenta with black text
            [17, 'C', '#00FFFF', '#000000'],    // Cyan with black text
            [18, 'E', '#F5F5DC', '#000000'],    // Beige with black text
            [19, 'N', '#000080', '#FFFFFF'],    // Navy with white text
            [20, 'I', '#FFFFF0', '#000000']     // Ivory with black text
        ];
        $colors = [];

        foreach ($arr as $key => $color) {
            $colors[$key] = [];
            $colors[$key]['id'] = $color[0];
            $colors[$key]['code'] = $color[1];
            $colors[$key]['color'] = $color[2];
            $colors[$key]['text_color'] = $color[3];
            $colors[$key]['created_at'] = $colors[$key]['updated_at'] = DatabaseSeeder::SEED_DATE_DEFAULT;
        }

        ToolColorCode::withoutEvents(function () use ($colors) {
            ToolColorCode::insert($colors);
        });
    }
}
