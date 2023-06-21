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
        Schema::create('machining_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_material_id')
                    ->constrained('tool_materials')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tool_product_id')
                    ->constrained('tool_products')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tool_item_id')
                    ->constrained('tool_items')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('workpiece_material');
            $table->string('machining_process');
            $table->decimal('cutting_speed', 8, 2, true);
            $table->decimal('depth_of_cut', 8, 2, true);
            $table->decimal('feeding', 8, 2, true);
            $table->unsignedInteger('early_tool_life');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machining_projects');
    }
};
