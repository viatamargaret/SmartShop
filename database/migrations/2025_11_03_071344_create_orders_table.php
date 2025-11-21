<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_method', 50)->nullable();
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('cod_fee', 10, 2)->default(0);
            $table->text('address')->nullable();
            $table->enum('status', ['Pending','Processing','Delivered','Cancelled'])->default('Pending');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
