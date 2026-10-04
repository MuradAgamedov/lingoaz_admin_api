<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->unsignedTinyInteger('box')->default(0)->after('is_starred');
            $table->unsignedInteger('correct_count')->default(0)->after('box');
            $table->unsignedInteger('wrong_count')->default(0)->after('correct_count');
            $table->timestamp('next_review_at')->nullable()->after('wrong_count');
            $table->timestamp('last_reviewed_at')->nullable()->after('next_review_at');

            $table->index(['user_id', 'next_review_at']);
        });
    }

    public function down(): void
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'next_review_at']);
            $table->dropColumn(['box', 'correct_count', 'wrong_count', 'next_review_at', 'last_reviewed_at']);
        });
    }
};
