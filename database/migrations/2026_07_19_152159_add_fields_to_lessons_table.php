<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('title');
            $table->string('category', 100);
            $table->string('level', 50);
            $table->longText('content');
            $table->string('status')->default('draft');
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'category',
                'level',
                'content',
                'status',
            ]);
        });
    }
};