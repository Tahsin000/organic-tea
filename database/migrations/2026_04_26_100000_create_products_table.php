<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('desc')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2);
            $table->string('badge')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->string('discount_label')->nullable()->comment('e.g. extra 20% off on first order');
            $table->unsignedInteger('review_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
