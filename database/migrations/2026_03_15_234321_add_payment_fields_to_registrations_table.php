<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->string('payment_method')->nullable()->after('issued_date');
                $table->decimal('payment_amount', 12, 2)->nullable()->after('payment_status');
                $table->string('payment_reference')->nullable()->after('payment_amount');
                $table->text('payment_notes')->nullable()->after('payment_reference');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->dropColumn([
                    'payment_method',
                    'payment_amount',
                    'payment_reference',
                    'payment_notes',
                ]);
            });
        });
    }
};
