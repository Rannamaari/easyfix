<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_messages', function (Blueprint $table) {
            $table->dateTime('edited_at')->nullable()->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('job_messages', function (Blueprint $table) {
            $table->dropColumn('edited_at');
        });
    }
};
