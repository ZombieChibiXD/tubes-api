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
        Schema::create('machining_project_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machining_project_id')
                    ->constrained('machining_projects')
                    ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('product_id');
            $table->decimal('initial_diameter', 8, 2, true);
            $table->decimal('final_diameter', 8, 2, true);
            $table->decimal('workpart_length');
            $table->unsignedInteger('product_quantity');
            $table->unsignedInteger('machining_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machining_project_works');
    }
};
