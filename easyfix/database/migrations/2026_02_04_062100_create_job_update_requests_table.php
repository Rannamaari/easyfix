<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_update_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('requested_by_role', 20);
            $table->text('message')->nullable();
            $table->enum('status', ['open', 'responded', 'closed'])->default('open');
            $table->text('response')->nullable();
            $table->foreignId('responded_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('responded_at')->nullable();
            $table->timestamps();

            $table->index(['job_request_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_update_requests');
    }
};
