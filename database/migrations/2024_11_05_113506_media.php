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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->integer('added_user_id');
            $table->integer('category_id');
            $table->string('media_title');
            $table->text('media_image')->nullable();
            $table->text('media_description')->nullable();
            $table->string('media_author')->nullable();
            $table->integer('media_status')->default(1);
            $table->string('media_type');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
