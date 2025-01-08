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
        Schema::create('markets', function(Blueprint $table){
            $table->id('market_id');
            $table->integer('added_user_id');
            $table->integer('city_id');
            $table->string('market_name');
            $table->text('market_image')->nullable();
            $table->float('market_rate')->default(0);
            $table->float('market_openrate')->default(0);
            $table->float('market_closerate')->default(0);
            $table->float('market_doc')->default(0);
            $table->integer('market_status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
