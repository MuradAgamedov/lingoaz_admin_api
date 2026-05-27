<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('note_group_id');
            $table->string('title');
            $table->longText('content');
            $table->timestamps();

            $table->foreign('user_id', 'notes_user_id_foreign')
                ->references('id')->on('users')->cascadeOnDelete();

            $table->foreign('note_group_id', 'notes_group_id_foreign')
                ->references('id')->on('note_groups')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
