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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('membership_type', 1)->default('I')->comment('C = Company, P = Personal, I = Internal');
            $table->string('name', 100)->comment('Company / Association Name / Personal Name');
            $table->string('phone_number', 20)->unique()->comment('Company | Association / Personal Phone Number');
            $table->string('address', 250)->comment('Company | Association / Personal Address');
            $table->string('contact_person', 100)->nullable()->comment('For type company');
            $table->string('contact_person_phone_number', 20)->nullable()->comment('For type company');
            $table->string('occupation', 100)->nullable()->comment('For type personal');
            $table->boolean('is_agree')->default(false);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('photo_profile')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('user_ip', 20)->nullable();
            $table->boolean('is_logged_in')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->smallInteger('role')->comment('1 = Super Admin, 2 = Petugas, 3 = Member')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
