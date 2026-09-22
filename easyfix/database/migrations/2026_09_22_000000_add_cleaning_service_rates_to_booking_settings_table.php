<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            $table->json('cleaning_service_rates')->nullable()->after('ac_service_rates');
        });

        DB::table('booking_settings')
            ->whereNull('cleaning_service_rates')
            ->update([
                'cleaning_service_rates' => json_encode(\App\Models\BookingSetting::defaultCleaningServiceRates()),
            ]);
    }

    public function down(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            $table->dropColumn('cleaning_service_rates');
        });
    }
};
