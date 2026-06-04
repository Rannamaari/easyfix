<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $columns = array_filter([
                    Schema::hasColumn('users', 'micronet_customer_id') ? 'micronet_customer_id' : null,
                    Schema::hasColumn('users', 'micronet_last_synced_at') ? 'micronet_last_synced_at' : null,
                    Schema::hasColumn('users', 'micronet_sync_error') ? 'micronet_sync_error' : null,
                ]);

                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }

        if (Schema::hasTable('job_requests')) {
            Schema::table('job_requests', function (Blueprint $table) {
                $columns = array_filter([
                    Schema::hasColumn('job_requests', 'micronet_job_id') ? 'micronet_job_id' : null,
                    Schema::hasColumn('job_requests', 'micronet_last_synced_at') ? 'micronet_last_synced_at' : null,
                    Schema::hasColumn('job_requests', 'micronet_status_synced_at') ? 'micronet_status_synced_at' : null,
                    Schema::hasColumn('job_requests', 'micronet_sync_error') ? 'micronet_sync_error' : null,
                ]);

                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }

        if (Schema::hasTable('job_quotes')) {
            Schema::table('job_quotes', function (Blueprint $table) {
                $columns = array_filter([
                    Schema::hasColumn('job_quotes', 'micronet_items_synced_at') ? 'micronet_items_synced_at' : null,
                    Schema::hasColumn('job_quotes', 'micronet_invoice_synced_at') ? 'micronet_invoice_synced_at' : null,
                    Schema::hasColumn('job_quotes', 'micronet_invoice_number') ? 'micronet_invoice_number' : null,
                    Schema::hasColumn('job_quotes', 'micronet_sync_error') ? 'micronet_sync_error' : null,
                ]);

                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }

        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                $columns = array_filter([
                    Schema::hasColumn('payments', 'micronet_payment_id') ? 'micronet_payment_id' : null,
                    Schema::hasColumn('payments', 'micronet_payment_synced_at') ? 'micronet_payment_synced_at' : null,
                    Schema::hasColumn('payments', 'micronet_sync_error') ? 'micronet_sync_error' : null,
                ]);

                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }
    }

    public function down(): void
    {
        // Intentionally left empty. We do not want to recreate the Micronet fields automatically.
    }
};
