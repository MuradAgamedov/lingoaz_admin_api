<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sentence_dictionary_group_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sentence_dictionary_group_id');
            $table->foreign('sentence_dictionary_group_id', 'sdgc_group_id_foreign')
                ->references('id')
                ->on('sentence_dictionary_groups')
                ->cascadeOnDelete();
            $table->string('title');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sentence_dictionary_group_categories');
    }
};
