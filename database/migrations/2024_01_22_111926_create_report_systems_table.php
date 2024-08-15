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
        Schema::create('report_systems', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('type')->nullable();
            $table->string('receiver_report_id')->nullable();
            $table->string('role')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('row')->nullable();
            $table->enum('status',['ok','discard'])->default('ok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_systems');
    }
};
