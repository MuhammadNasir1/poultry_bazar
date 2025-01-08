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
        Schema::connection('mysql2')->create('markets_history', function (Blueprint $table) {
            $table->id('market_history_id');
            $table->integer('market_id');
            $table->integer('user_id');
            $table->double('market_rate')->default(0);
            $table->double('market_openrate')->default(0);
            $table->double('market_closerate')->default(0);
            $table->double('market_doc')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql2')->dropIfExists('markets_history');
    }
};
