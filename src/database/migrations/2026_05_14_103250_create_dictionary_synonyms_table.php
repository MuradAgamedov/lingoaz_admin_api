<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionarySynonymsTable extends Migration
{
    public function up(): void
    {
        Schema::create('dictionary_synonyms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dictionary_id')
                ->constrained('dictionaries')
                ->cascadeOnDelete();

            $table->foreignId('synonym_id')
                ->constrained('dictionaries')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['dictionary_id', 'synonym_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionary_synonyms');
    }
}