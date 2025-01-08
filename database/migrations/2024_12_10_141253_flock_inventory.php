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
        Schema::create('flock_inventory', function(Blueprint $table) {
            $table->id('fi_id');
            $table->integer('flock_id');
            $table->integer('company_id');
            $table->integer('user_id');
            $table->longText('fi_detail');
            $table->string('fi_status')->default('in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flock_inventory');
    }
};
