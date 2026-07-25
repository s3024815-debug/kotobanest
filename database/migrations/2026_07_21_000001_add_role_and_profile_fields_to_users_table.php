<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
            $table->string('role')->default('student')->index()->after('password');
            $table->string('status')->default('active')->index()->after('role');
            $table->string('country')->nullable();
            $table->string('native_language')->nullable();
            $table->string('current_jlpt', 10)->default('N5');
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->unsignedInteger('xp')->default(0);
            $table->unsignedInteger('streak')->default(0);
            $table->timestamp('last_login_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn([
                'username', 'role', 'status', 'country', 'native_language',
                'current_jlpt', 'avatar', 'bio', 'xp', 'streak', 'last_login_at'
            ]);
        });
    }
};
