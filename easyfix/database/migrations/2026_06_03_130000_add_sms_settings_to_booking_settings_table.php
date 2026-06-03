<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            $table->string('support_hotline')->nullable()->after('urgent_surcharge_amount');
            $table->string('micronet_bank_name')->nullable()->after('support_hotline');
            $table->string('micronet_account_name')->nullable()->after('micronet_bank_name');
            $table->string('micronet_account_number')->nullable()->after('micronet_account_name');
            $table->text('sms_request_received_template')->nullable()->after('micronet_account_number');
            $table->text('sms_quote_ready_template')->nullable()->after('sms_request_received_template');
            $table->text('sms_quote_updated_template')->nullable()->after('sms_quote_ready_template');
            $table->text('sms_status_update_template')->nullable()->after('sms_quote_updated_template');
            $table->text('sms_visit_charge_required_template')->nullable()->after('sms_status_update_template');
            $table->text('sms_quote_approved_payment_template')->nullable()->after('sms_visit_charge_required_template');
        });
    }

    public function down(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            $table->dropColumn([
                'support_hotline',
                'micronet_bank_name',
                'micronet_account_name',
                'micronet_account_number',
                'sms_request_received_template',
                'sms_quote_ready_template',
                'sms_quote_updated_template',
                'sms_status_update_template',
                'sms_visit_charge_required_template',
                'sms_quote_approved_payment_template',
            ]);
        });
    }
};
