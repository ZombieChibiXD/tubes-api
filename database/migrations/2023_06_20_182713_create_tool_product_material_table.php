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
        Schema::create('tool_product_material', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_material_id')
                    ->constrained('tool_materials')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tool_product_id')
                    ->constrained('tool_products')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_product_material');
    }
};
