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
        Schema::create('flock_products', function(Blueprint $table) {
            $table->id('fp_id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->string('fp_name');
            $table->double('fp_purchase_rate')->default(0);
            $table->double('fp_sale_rate')->default(0);
            $table->double('fp_quantity')->default(0);
            $table->text('fp_details')->nullable();
            $table->integer('fp_status')->default(1);
            $table->string('fp_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flock_products');
    }
};
