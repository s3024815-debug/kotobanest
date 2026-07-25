<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dictionary_entries', function (Blueprint $table) {
            $table->text('kanji_forms')->nullable()->after('word');
            $table->text('kana_forms')->nullable()->after('kanji_forms');
        });
    }

    public function down(): void
    {
        Schema::table('dictionary_entries', function (Blueprint $table) {
            $table->dropColumn(['kanji_forms', 'kana_forms']);
        });
    }
};
