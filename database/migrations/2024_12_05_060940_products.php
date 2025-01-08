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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->integer('user_id');
            $table->string('product_name');
            $table->string('product_sec_name')->nullable();
            $table->text('product_description')->nullable();
            $table->text('product_image')->nullable();
            $table->string('product_unit');
            $table->float('product_purchase_rate')->default(0);
            $table->float('product_sale_rate')->default(0);
            $table->integer('product_stock')->default(0);
            $table->integer('product_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
