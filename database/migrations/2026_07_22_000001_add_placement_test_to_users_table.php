<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('placement_test_completed_at')->nullable()->after('current_jlpt');
            $table->string('placement_test_result')->nullable()->after('placement_test_completed_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['placement_test_completed_at', 'placement_test_result']);
        });
    }
};
