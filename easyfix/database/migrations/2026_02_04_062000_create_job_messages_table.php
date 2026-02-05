<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('sender_role', 20);
            $table->text('message');
            $table->timestamps();

            $table->index(['job_request_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_messages');
    }
};
