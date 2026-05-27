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
        Schema::create('user_dictionary_user_dictionary_category', function (Blueprint $table) {
            $table->unsignedBigInteger('user_dictionary_id');
            $table->unsignedBigInteger('user_dictionary_category_id');

            $table->foreign('user_dictionary_id', 'udc_pivot_dict_fk')
                ->references('id')->on('user_dictionaries')
                ->cascadeOnDelete();

            $table->foreign('user_dictionary_category_id', 'udc_pivot_cat_fk')
                ->references('id')->on('user_dictionary_categories')
                ->cascadeOnDelete();

            $table->primary([
                'user_dictionary_id',
                'user_dictionary_category_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dictionary_user_dictionary_category');
    }
};
