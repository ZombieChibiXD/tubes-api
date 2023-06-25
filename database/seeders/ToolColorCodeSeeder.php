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
        $colors = [
            [
                'id' => 1,
                'code' => 'R1', // Red
                'color' => '#FF0000'
            ],
            [
                'id' => 2,
                'code' => 'B2', // Blue
                'color' => '#0000FF'
            ],
            [
                'id' => 3,
                'code' => 'Y3', // Yellow
                'color' => '#FFFF00'
            ],
            [
                'id' => 4,
                'code' => 'G4', // Green
                'color' => '#00FF00'

            ],
            [
                'id' => 5, // Brown
                'code' => 'C5',
                'color' => '#A52A2A'
            ],
            [
                'id' => 6,
                'code' => 'P6', // Purple
                'color' => '#800080'
            ],
            [
                'id' => 7,
                'code' => 'O7', // Orange
                'color' => '#FFA500'
            ],
            [
                'id' => 8,
                'code' => 'W8', // White
                'color' => '#FFFFFF'
            ],
            [
                'id' => 9,
                'code' => 'K9', // Black
                'color' => '#000000'
            ],
            [
                'id' => 10,
                'code' => 'G0', // Gray
                'color' => '#808080'
            ]
        ];

        ToolColorCode::withoutEvents(function () use ($colors) {
            ToolColorCode::insert($colors);
        });
    }
}
