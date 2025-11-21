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
        Schema::table('orders', function (Blueprint $table) {

            if (!Schema::hasColumn('orders', 'processing_fee')) {
                $table->decimal('processing_fee', 10, 2)->nullable()->after('cod_fee');
            }

            if (!Schema::hasColumn('orders', 'grand_total')) {
                $table->decimal('grand_total', 10, 2)->nullable()->after('total_amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'processing_fee')) {
                $table->dropColumn('processing_fee');
            }
            if (Schema::hasColumn('orders', 'grand_total')) {
                $table->dropColumn('grand_total');
            }
        });
    }
};
