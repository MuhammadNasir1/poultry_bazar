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
        Schema::create('pos_purchase', function(Blueprint $table){
            $table->id('purchase_id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->string('supplier_name')->nullable();
            $table->date('purchase_date')->useCurrent();
            $table->double('purchase_weight_quantity')->default(0);
            $table->double('purchase_rate')->default(0);
            $table->double('purchase_amount')->default(0);
            $table->text('purchase_comments')->nullable();
            $table->integer('purchase_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_purchase');
    }
};
