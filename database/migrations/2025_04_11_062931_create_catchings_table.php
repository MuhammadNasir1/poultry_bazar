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
        Schema::create('catching', function (Blueprint $table) {
            $table->id('cat_id');
            $table->integer('user_id');
            $table->integer('flock_id');
            $table->date('cat_date')->nullable();
            $table->string('cat_receipt')->nullable();
            $table->json('cat_driver_info')->nullable();
            $table->json('cat_broker_info')->nullable();
            $table->float('cat_cp_rate')->nullable();
            $table->float('cat_healthy_rate')->nullable();
            $table->float('cat_weight_booked')->nullable();
            $table->float('cat_net_weight')->nullable();
            $table->float('cat_total')->nullable();
            $table->float('cat_grand_total')->nullable();
            $table->float('cat_f_online')->nullable();
            $table->float('cat_f_cash')->nullable();
            $table->json('cat_f_cash_notes')->nullable();
            $table->string('cat_f_receipt')->nullable();
            $table->float('cat_advance')->nullable();
            $table->float('cat_remaining')->nullable();
            $table->float('cat_empty_weight')->nullable();
            $table->float('cat_load_weight')->nullable();
            $table->float('cat_mound_type')->nullable();
            $table->float('cat_second_payment')->nullable();
            $table->float('cat_second_cash')->nullable();
            $table->float('cat_second_online')->nullable();
            $table->string('cat_second_receipt')->nullable();
            $table->json('cat_second_cash_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catching');
    }
};
