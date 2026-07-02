<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('furigana')->nullable();
            $table->string('meaning_en');
            $table->string('meaning_bn')->nullable();
            $table->text('example')->nullable();
            $table->string('level')->default('N5');
            $table->string('category')->default('Daily Life');
            $table->string('status')->default('published');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vocabularies'); }
};
