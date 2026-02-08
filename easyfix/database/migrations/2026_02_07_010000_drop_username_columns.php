<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });

        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropColumn('guest_username');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->nullable()->unique()->after('name');
        });

        Schema::table('job_requests', function (Blueprint $table) {
            $table->string('guest_username', 50)->nullable()->after('guest_name');
        });
    }
};
