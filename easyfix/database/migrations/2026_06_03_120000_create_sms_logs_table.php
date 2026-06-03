<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('job_request_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('job_quote_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->nullable()->index();
            $table->string('status')->index();
            $table->string('destination', 20)->index();
            $table->string('source')->nullable();
            $table->string('provider_transaction_id')->nullable()->index();
            $table->text('content');
            $table->text('error_message')->nullable();
            $table->json('provider_response')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};
