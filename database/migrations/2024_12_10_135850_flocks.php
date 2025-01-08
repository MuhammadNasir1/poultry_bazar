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
        Schema::create('flocks', function(Blueprint $table) {
            $table->id('flock_id');
            $table->integer('flock_site_id');
            $table->integer('user_id');
            $table->string('flock_name');
            $table->text('flock_image')->nullable();
            $table->string('farmer_name')->nullable();
            $table->text('flock_color')->nullable();
            $table->integer('flock_supervisor_user_id')->nullable();
            $table->integer('flock_accountant_user_id')->nullable();
            $table->integer('flock_assistant_user_id')->nullable();
            $table->integer('flock_expense')->nullable();
            $table->integer('flock_revenue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flocks');
    }
};
