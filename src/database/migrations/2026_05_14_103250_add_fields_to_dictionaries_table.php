<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToDictionariesTable extends Migration
{
    public function up(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {
            $table->string('phonetic')->nullable()->after('word');
            $table->string('part_of_speech')->nullable()->after('translation');
            $table->longText('definition')->nullable()->after('part_of_speech');
            $table->longText('example')->nullable()->after('definition');
            $table->json('phonetics')->nullable()->after('example');
            $table->json('meanings')->nullable()->after('phonetics');
            $table->json('source_urls')->nullable()->after('meanings');
            $table->json('license')->nullable()->after('source_urls');
        });
    }

    public function down(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {
            $table->dropColumn([
                'phonetic',
                'part_of_speech',
                'definition',
                'example',
                'phonetics',
                'meanings',
                'source_urls',
                'license',
            ]);
        });
    }
}