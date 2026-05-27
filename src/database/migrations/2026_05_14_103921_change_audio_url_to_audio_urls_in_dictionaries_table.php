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
        /*
        |--------------------------------------------------------------------------
        | Remove Old Fields
        |--------------------------------------------------------------------------
        */

        Schema::table('dictionaries', function (Blueprint $table) {

            if (Schema::hasColumn('dictionaries', 'audio_url')) {
                $table->dropColumn('audio_url');
            }

            if (Schema::hasColumn('dictionaries', 'license')) {
                $table->dropColumn('license');
            }

            if (Schema::hasColumn('dictionaries', 'source_urls')) {
                $table->dropColumn('source_urls');
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Add New Fields
        |--------------------------------------------------------------------------
        */

        Schema::table('dictionaries', function (Blueprint $table) {

            if (!Schema::hasColumn('dictionaries', 'audio_urls')) {
                $table->json('audio_urls')->nullable();
            }

            if (!Schema::hasColumn('dictionaries', 'phonetic')) {
                $table->string('phonetic')->nullable();
            }

            if (!Schema::hasColumn('dictionaries', 'part_of_speech')) {
                $table->string('part_of_speech')->nullable();
            }

            if (!Schema::hasColumn('dictionaries', 'definition')) {
                $table->longText('definition')->nullable();
            }

            if (!Schema::hasColumn('dictionaries', 'example')) {
                $table->longText('example')->nullable();
            }

            if (!Schema::hasColumn('dictionaries', 'phonetics')) {
                $table->json('phonetics')->nullable();
            }

            if (!Schema::hasColumn('dictionaries', 'meanings')) {
                $table->json('meanings')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {

            if (Schema::hasColumn('dictionaries', 'audio_urls')) {
                $table->dropColumn('audio_urls');
            }

            if (Schema::hasColumn('dictionaries', 'phonetic')) {
                $table->dropColumn('phonetic');
            }

            if (Schema::hasColumn('dictionaries', 'part_of_speech')) {
                $table->dropColumn('part_of_speech');
            }

            if (Schema::hasColumn('dictionaries', 'definition')) {
                $table->dropColumn('definition');
            }

            if (Schema::hasColumn('dictionaries', 'example')) {
                $table->dropColumn('example');
            }

            if (Schema::hasColumn('dictionaries', 'phonetics')) {
                $table->dropColumn('phonetics');
            }

            if (Schema::hasColumn('dictionaries', 'meanings')) {
                $table->dropColumn('meanings');
            }
        });
    }
};