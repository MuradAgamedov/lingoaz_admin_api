<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dictionary_definitions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dictionary_meaning_id')
                ->constrained('dictionary_meanings')
                ->cascadeOnDelete();

            $table->longText('definition')->nullable();

            $table->longText('example')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionary_definitions');
    }
};