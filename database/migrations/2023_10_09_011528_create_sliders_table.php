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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->text('url')->nullable();
            $table->text('youtube_url')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_caption')->default(false);
            $table->string('slider_path', 100)->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->bigInteger('update_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
