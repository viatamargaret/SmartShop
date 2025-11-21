<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (!Schema::hasColumn('orders', 'delivery_fee')) {
                    $table->decimal('delivery_fee', 10, 2)->default(0)->after('payment_method');
                }

                if (!Schema::hasColumn('orders', 'cod_fee')) {
                    $table->decimal('cod_fee', 10, 2)->default(0)->after('delivery_fee');
                }

                if (!Schema::hasColumn('orders', 'address')) {
                    $table->text('address')->nullable()->after('cod_fee');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                if (Schema::hasColumn('orders', 'delivery_fee')) {
                    $table->dropColumn('delivery_fee');
                }

                if (Schema::hasColumn('orders', 'cod_fee')) {
                    $table->dropColumn('cod_fee');
                }

                if (Schema::hasColumn('orders', 'address')) {
                    $table->dropColumn('address');
                }
            });
        }
    }
};

