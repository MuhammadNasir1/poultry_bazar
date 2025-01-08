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
        Schema::create('companies', function(Blueprint $table){
            $table->id('company_id');
            $table->integer('user_id');
            $table->string('company_name');
            $table->text('company_address');
            $table->bigInteger('company_phone');
            $table->text('company_logo')->nullable();
            $table->integer('company_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
