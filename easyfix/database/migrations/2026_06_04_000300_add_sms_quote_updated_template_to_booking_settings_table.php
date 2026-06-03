<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('booking_settings', 'sms_quote_updated_template')) {
                $table->text('sms_quote_updated_template')
                    ->nullable()
                    ->after('sms_quote_ready_template');
            }
        });
    }

    public function down(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            if (Schema::hasColumn('booking_settings', 'sms_quote_updated_template')) {
                $table->dropColumn('sms_quote_updated_template');
            }
        });
    }
};
