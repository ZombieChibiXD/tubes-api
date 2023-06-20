<?php

namespace Database\Seeders;

use App\Models\ToolMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'id' => 1,
                'name' => 'Karbida'
            ],
        ];

        ToolMaterial::insert($materials);
    }
}
