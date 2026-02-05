<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_request_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->text('notes')->nullable();
            $table->enum('status', ['sent', 'approved', 'rejected'])->default('sent');
            $table->datetime('approved_at')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('job_request_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_quotes');
    }
};
