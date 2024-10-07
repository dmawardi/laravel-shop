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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('delivery_time'); // e.g. 1-2 days
            $table->decimal('base_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->decimal('price_per_kg', 10, 2)->nullable();
            $table->decimal('price_per_item', 10, 2)->nullable();
            $table->decimal('price_per_m', 10, 2)->nullable();
            $table->decimal('price_per_cm', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
