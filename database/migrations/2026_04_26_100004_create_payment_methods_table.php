<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // e.g. "ক্যাশ অন ডেলিভারি"
            $table->string('key')->unique(); // e.g. "cod", "bkash", "nagad"
            $table->text('description')->nullable();
            $table->boolean('requires_transaction')->default(false); // true for bKash/Nagad
            $table->string('payment_number')->nullable();            // number to send money to
            $table->string('icon')->nullable();                      // icon name/key
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
