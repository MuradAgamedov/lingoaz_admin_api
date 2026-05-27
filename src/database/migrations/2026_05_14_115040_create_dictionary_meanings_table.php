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
        Schema::create('dictionary_meanings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('dictionary_id')
                ->constrained('dictionaries')
                ->cascadeOnDelete();

            $table->string('part_of_speech')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionary_meanings');
    }
};