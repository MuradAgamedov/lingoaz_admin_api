<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sentence_dictionaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sentence_dictionary_group_category_id');
            $table->string('word');
            $table->string('translation');
            $table->json('audio_urls')->nullable();
            $table->timestamps();

            $table->foreign('user_id', 'sdict_user_id_foreign')
                ->references('id')->on('users')->cascadeOnDelete();

            $table->foreign('sentence_dictionary_group_category_id', 'sdict_cat_id_foreign')
                ->references('id')->on('sentence_dictionary_group_categories')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sentence_dictionaries');
    }
};
