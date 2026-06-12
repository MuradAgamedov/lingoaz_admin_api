<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apk_releases', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->string('filename');
            $table->string('path');
            $table->unsignedInteger('size_kb')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apk_releases');
    }
};
