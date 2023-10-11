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
        Schema::create('news_publications', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('category', 15)->nullable();
            $table->string('short_description', 100)->nullable();
            $table->string('content_type', 10)->nullable();
            $table->string('image_path', 100)->nullable();
            $table->longText('content');
            $table->string('slug', 250)->nullable();
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
        Schema::dropIfExists('news_publications');
    }
};
