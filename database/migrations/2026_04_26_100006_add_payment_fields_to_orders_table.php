<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add payment transaction details to orders (for bKash/Nagad)
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_number')->nullable()->after('payment_method');  // sender number
            $table->string('transaction_id')->nullable()->after('payment_number'); // trx ID
        });

        // Add product_id (FK) to order_items so we can trace the actual product
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->after('order_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_number', 'transaction_id']);
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
