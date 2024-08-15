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
        Schema::create('lecture_time_tables', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('day')->nullable();
            $table->string('code')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture_time_tables');
    }
};
