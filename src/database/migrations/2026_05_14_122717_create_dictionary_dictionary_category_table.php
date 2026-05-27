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
        Schema::create('dictionary_dictionary_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dictionary_id')->constrained()->cascadeOnDelete();
            $table->foreignId('dictionary_category_id')->constrained('dictionary_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionary_dictionary_category');
    }
};
