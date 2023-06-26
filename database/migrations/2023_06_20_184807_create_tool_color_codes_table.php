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
        Schema::create('tool_color_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')
                    ->unique()
                    ->comment('Tool color code');
            $table->string('color')
                    ->unique()
                    ->comment('Tool item color');
            $table->string('text_color')
                    ->comment('Tool text item color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_color_codes');
    }
};
