<?php

use App\Models\Category;
use App\Models\Product;
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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id('product_category_id');

            $table->softDeletesDatetime();
            $table->timestamps();

            $table->foreignId('product_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('category_id')
                ->cascadeOnDelete();

            $table->index('')
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }

};
