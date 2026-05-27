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
        Schema::create('user_dictionary_definitions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_dictionary_meaning_id')
                ->constrained('user_dictionary_meanings')
                ->cascadeOnDelete();

            $table->longText('definition')->nullable();

            $table->longText('example')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dictionary_definitions');
    }
};
