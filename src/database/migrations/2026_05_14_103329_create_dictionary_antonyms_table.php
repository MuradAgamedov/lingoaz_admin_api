<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryAntonymsTable extends Migration
{
    public function up(): void
    {
        Schema::create('dictionary_antonyms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dictionary_id')
                ->constrained('dictionaries')
                ->cascadeOnDelete();

            $table->foreignId('antonym_id')
                ->constrained('dictionaries')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['dictionary_id', 'antonym_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionary_antonyms');
    }
}