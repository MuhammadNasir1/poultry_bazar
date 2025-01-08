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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id('product_variation_id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('variation_name');
            $table->float('variation_sale_rate')->default(0);
            $table->float('variation_consumed')->default(0);
            $table->float('variation_wastage')->default(0);
            $table->integer('variation_status')->default(1);
            $table->string('variation_image')->nullable();
            $table->integer('is_fav')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
