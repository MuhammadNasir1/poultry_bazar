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
        Schema::create('ecom_product', function (Blueprint $table) {
            $table->id('ecom_product_id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->string('ecom_product_name');
            $table->string('ecom_product_category');
            $table->string('ecom_product_brand')->nullable();
            $table->integer('ecom_product_price');
            $table->string('ecom_product_unit')->nullable();
            $table->text('ecom_product_description')->nullable();
            $table->longText('ecom_product_media')->nullable();
            $table->boolean('ecom_product_boosted')->default(false);
            $table->integer('ecom_product_count')->default(0);
            $table->integer('product_whatsapp_count')->default(0);
            $table->integer('ecom_product_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecom_product');
    }
};
