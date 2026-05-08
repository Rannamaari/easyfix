<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            $table->boolean('requires_site_visit')->default(false)->after('status');
            $table->decimal('visit_charge_amount', 10, 2)->nullable()->after('requires_site_visit');
            $table->boolean('urgent_requested')->default(false)->after('visit_charge_amount');
            $table->decimal('urgent_surcharge_amount', 10, 2)->default(0)->after('urgent_requested');
            $table->timestamp('customer_last_seen_at')->nullable()->after('urgent_surcharge_amount');
            $table->timestamp('latest_customer_update_at')->nullable()->after('customer_last_seen_at');
        });
    }

    public function down(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            $table->dropColumn([
                'requires_site_visit',
                'visit_charge_amount',
                'urgent_requested',
                'urgent_surcharge_amount',
                'customer_last_seen_at',
                'latest_customer_update_at',
            ]);
        });
    }
};
