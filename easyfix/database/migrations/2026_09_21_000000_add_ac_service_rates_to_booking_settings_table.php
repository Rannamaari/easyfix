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
            $table->json('ac_service_rates')->nullable()->after('urgent_surcharge_amount');
        });

        DB::table('booking_settings')
            ->whereNull('ac_service_rates')
            ->update([
                'ac_service_rates' => json_encode([
                    ['name' => 'AC Installation', 'price' => 1000, 'detail' => 'Installation support for your air conditioner.'],
                    ['name' => 'AC Relocation', 'price' => 1250, 'detail' => 'Moving your AC to a new position or location.'],
                    ['name' => 'Full Service (On-Site)', 'price' => 800, 'detail' => 'Full servicing at your home or workplace.'],
                    ['name' => 'Full Service (Workshop)', 'price' => 1350, 'detail' => 'Workshop servicing when your unit needs more attention.'],
                    ['name' => 'Gas Refill - Half', 'price' => 550, 'detail' => 'Refrigerant refill following assessment.'],
                    ['name' => 'Gas Refill - Full', 'price' => 950, 'detail' => 'Full refill requirements confirmed during assessment.'],
                    ['name' => 'Water Leak Fix', 'price' => 550, 'detail' => 'Troubleshooting and repair for a leaking AC.'],
                    ['name' => 'Indoor Service', 'price' => 550, 'detail' => 'Service focused on the indoor unit.'],
                    ['name' => 'AC Diagnosis', 'price' => 500, 'detail' => 'Find the fault before deciding on repair work.'],
                ]),
            ]);
    }

    public function down(): void
    {
        Schema::table('booking_settings', function (Blueprint $table) {
            $table->dropColumn('ac_service_rates');
        });
    }
};
