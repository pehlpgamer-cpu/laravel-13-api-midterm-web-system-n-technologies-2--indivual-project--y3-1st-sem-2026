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
        // aka "inventory_items"
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->integer('quantity')->default(0);

            $table->softDeletesDatetime();
            $table->timestamps();

            $table->foreignId('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
