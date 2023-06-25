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
            // ['id', 'code', 'color'],[
            [1, 'R', '#FF0000'],
            [2, 'B', '#0000FF'],
            [3, 'Y', '#FFFF00'],
            [4, 'G', '#00FF00'],
            [5, 'T', '#A52A2A'],
            [6, 'V', '#800080'],
            [7, 'O', '#FFA500'],
            [8, 'W', '#FFFFFF'],
            [9, 'K', '#000000'],
            [10, 'X', '#808080'],
            [11, 'P', '#FFC0CB'],
            [12, 'Q', '#40E0D0'],
            [13, 'L', '#808000'],
            [14, 'S', '#C0C0C0'],
            [15, 'D', '#FFD700'],
            [16, 'M', '#FF00FF'],
            [17, 'C', '#00FFFF'],
            [18, 'E', '#F5F5DC'],
            [19, 'N', '#000080'],
            [20, 'I', '#FFFFF0']
        ];
        $colors = [];

        foreach ($arr as $key => $color) {
            $colors[$key] = [];
            $colors[$key]['id'] = $color[0];
            $colors[$key]['code'] = $color[1];
            $colors[$key]['color'] = $color[2];
            $colors[$key]['created_at'] = $colors[$key]['updated_at'] = DatabaseSeeder::SEED_DATE_DEFAULT;
        }

        ToolColorCode::withoutEvents(function () use ($colors) {
            ToolColorCode::insert($colors);
        });
    }
}
