<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('micronet_customer_id')->nullable()->after('role');
            $table->timestamp('micronet_last_synced_at')->nullable()->after('micronet_customer_id');
            $table->text('micronet_sync_error')->nullable()->after('micronet_last_synced_at');
        });

        Schema::table('job_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('micronet_job_id')->nullable()->after('provider_id');
            $table->timestamp('micronet_last_synced_at')->nullable()->after('micronet_job_id');
            $table->timestamp('micronet_status_synced_at')->nullable()->after('micronet_last_synced_at');
            $table->text('micronet_sync_error')->nullable()->after('micronet_status_synced_at');
        });

        Schema::table('job_quotes', function (Blueprint $table) {
            $table->timestamp('micronet_items_synced_at')->nullable()->after('invoiced_at');
            $table->timestamp('micronet_invoice_synced_at')->nullable()->after('micronet_items_synced_at');
            $table->string('micronet_invoice_number')->nullable()->after('micronet_invoice_synced_at');
            $table->text('micronet_sync_error')->nullable()->after('micronet_invoice_number');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('micronet_payment_id')->nullable()->after('confirmed_by');
            $table->timestamp('micronet_payment_synced_at')->nullable()->after('micronet_payment_id');
            $table->text('micronet_sync_error')->nullable()->after('micronet_payment_synced_at');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'micronet_payment_id',
                'micronet_payment_synced_at',
                'micronet_sync_error',
            ]);
        });

        Schema::table('job_quotes', function (Blueprint $table) {
            $table->dropColumn([
                'micronet_items_synced_at',
                'micronet_invoice_synced_at',
                'micronet_invoice_number',
                'micronet_sync_error',
            ]);
        });

        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropColumn([
                'micronet_job_id',
                'micronet_last_synced_at',
                'micronet_status_synced_at',
                'micronet_sync_error',
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'micronet_customer_id',
                'micronet_last_synced_at',
                'micronet_sync_error',
            ]);
        });
    }
};
