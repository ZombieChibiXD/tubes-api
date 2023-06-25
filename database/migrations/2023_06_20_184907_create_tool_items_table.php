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
        Schema::create('tool_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_product_toolbox_id')
                    ->constrained('tool_product_toolboxes')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tool_color_code_id')
                    ->constrained('tool_color_codes')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_items');
    }
};
