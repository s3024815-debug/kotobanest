<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration{public function up(): void{Schema::create('personal_notes', function (Blueprint $table) {$table->id();$table->foreignId('user_id')->constrained()->cascadeOnDelete();$table->string('title');$table->text('body');$table->string('type')->default('general');$table->timestamps();});} public function down(): void{Schema::dropIfExists('personal_notes');}};
