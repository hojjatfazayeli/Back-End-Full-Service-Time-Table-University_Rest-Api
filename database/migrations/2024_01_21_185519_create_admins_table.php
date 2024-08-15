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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('nationalcode')->nullable();
            $table->string('birth_certificate_id')->nullable();
            $table->string('status_marital')->default('single');
            $table->string('personal_id')->nullable();
            $table->string('fathername')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('place_issuance_birth_certificate')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->text('office_address')->nullable();
            $table->text('home_address')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
