<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('kanjis', function (Blueprint $table) {
  $table->id(); $table->string('character'); $table->string('meaning'); $table->string('onyomi')->nullable(); $table->string('kunyomi')->nullable(); $table->integer('stroke_count')->nullable(); $table->string('radical')->nullable(); $table->string('level')->default('N5'); $table->text('examples')->nullable(); $table->string('status')->default('published'); $table->timestamps();
 });}
 public function down(): void { Schema::dropIfExists('kanjis');}
};
