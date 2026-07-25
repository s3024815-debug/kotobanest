<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dictionary_entries', function (Blueprint $table) {
            $table->id();
            $table->string('jmdict_id')->unique();
            $table->string('word');
            $table->string('reading')->nullable();
            $table->text('meaning_en');
            $table->string('part_of_speech')->nullable();
            $table->boolean('is_common')->default(false);
            $table->timestamps();

            $table->index('word');
            $table->index('reading');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dictionary_entries');
    }
};
