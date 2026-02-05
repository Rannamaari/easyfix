<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_quotes', function (Blueprint $table) {
            $table->boolean('tax_enabled')->default(false)->after('notes');
            $table->decimal('tax_rate', 5, 2)->default(8.00)->after('tax_enabled');
            $table->decimal('subtotal', 10, 2)->nullable()->after('tax_rate');
            $table->decimal('tax_amount', 10, 2)->nullable()->after('subtotal');
            $table->decimal('total', 10, 2)->nullable()->after('tax_amount');
            $table->string('invoice_number')->nullable()->after('total');
            $table->dateTime('invoiced_at')->nullable()->after('invoice_number');
        });
    }

    public function down(): void
    {
        Schema::table('job_quotes', function (Blueprint $table) {
            $table->dropColumn([
                'tax_enabled',
                'tax_rate',
                'subtotal',
                'tax_amount',
                'total',
                'invoice_number',
                'invoiced_at',
            ]);
        });
    }
};
