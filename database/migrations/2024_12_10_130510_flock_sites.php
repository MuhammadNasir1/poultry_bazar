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
        Schema::create('flock_sites', function(Blueprint $table) {
            $table->id('site_id');
            $table->integer('user_id');
            $table->text('site_name');
            $table->text('site_manager')->nullable();
            $table->bigInteger('site_phone')->nullable();
            $table->text('site_location')->nullable();
            $table->timestamp('site_closing_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flock_sites');
    }
};
