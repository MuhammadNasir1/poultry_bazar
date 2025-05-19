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
        Schema::create('request_accesses', function (Blueprint $table) {
            $table->id("access_id");
            $table->string("user_id");
            $table->string("user_name");
            $table->string("user_email");
            $table->string("user_phone")->nullable();
            $table->string("access_module");
            $table->date("access_start_date")->nullable();
            $table->date("access_end_date")->nullable();
            $table->integer("access_status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_accesses');
    }
};
