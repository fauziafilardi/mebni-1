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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('place', 100)->nullable();
            $table->dateTime('date')->nullable();
            $table->string('description', 100)->nullable();
            $table->string('pic', 100)->nullable();
            $table->string('price', 100)->nullable();
            $table->string('slug', 250)->nullable();
            $table->string('image_path', 100)->nullable();
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
        Schema::dropIfExists('events');
    }
};
