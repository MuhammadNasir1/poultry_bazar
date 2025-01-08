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
        Schema::create('flock_details', function(Blueprint $table) {
            $table->id('fd__id');
            $table->integer('flock_id');
            $table->longText('fd_bedding')->nullable;
            $table->longText('fd_brooder_fuel')->nullable();
            $table->longText('fd_doc')->nullable();
            $table->longText('fd_electricity')->nullable();
            $table->longText('fd_feed')->nullable();
            $table->longText('fd_generator_fuel')->nullable();
            $table->longText('fd_mess')->nullable();
            $table->longText('fd_medicine')->nullable();
            $table->longText('fd_shed_preparation')->nullable();
            $table->longText('fd_salary')->nullable();
            $table->longText('fd_vaccine')->nullable();
            $table->longText('fd_washing')->nullable();
            $table->longText('fd_other')->nullable();
            $table->longText('fd_feed_consumed')->nullable();
            $table->longText('fd_water')->nullable();
            $table->longText('fd_mortality')->nullable();
            $table->longText('fd_medicine_consumed')->nullable();
            $table->longText('fd_vaccine_consumed')->nullable();
            $table->longText('fd_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fd_details');
    }
};
