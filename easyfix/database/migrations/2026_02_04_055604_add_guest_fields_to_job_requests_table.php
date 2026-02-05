<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            // Make customer_id nullable for guest requests
            $table->foreignId('customer_id')->nullable()->change();

            // Guest fields
            $table->string('guest_name')->nullable()->after('customer_id');
            $table->string('guest_phone')->nullable()->after('guest_name');
            $table->string('guest_email')->nullable()->after('guest_phone');
            $table->enum('guest_contact_preference', ['phone', 'email', 'whatsapp'])->nullable()->after('guest_email');
            $table->string('guest_token', 64)->nullable()->unique()->after('guest_contact_preference');

            // Indexes
            $table->index('guest_phone');
            $table->index('guest_email');
        });
    }

    public function down(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropIndex(['guest_phone']);
            $table->dropIndex(['guest_email']);
            $table->dropUnique(['guest_token']);

            $table->dropColumn([
                'guest_name',
                'guest_phone',
                'guest_email',
                'guest_contact_preference',
                'guest_token',
            ]);

            $table->foreignId('customer_id')->nullable(false)->change();
        });
    }
};
