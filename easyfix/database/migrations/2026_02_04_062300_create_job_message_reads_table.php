<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_message_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->dateTime('last_read_at')->nullable();
            $table->timestamps();

            $table->unique(['job_request_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_message_reads');
    }
};
