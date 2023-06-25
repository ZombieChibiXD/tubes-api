<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tool_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_material_id')
                ->constrained('tool_materials')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('code')
                ->unique()
                ->comment('Tool product code');
            $table->string('prefix')
                ->unique()
                ->comment('Toolbox prefix (LRW00, LRW25, etc.)');
            $table->string('name')
                ->nullable()
                ->comment('Tool product name');
            $table->unsignedInteger('min_cutting_speed')
                ->comment('Minimum cutting speed (m/min)');
            $table->unsignedInteger('max_cutting_speed')
                ->comment('Maximum cutting speed (m/min)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_products');
    }
};
