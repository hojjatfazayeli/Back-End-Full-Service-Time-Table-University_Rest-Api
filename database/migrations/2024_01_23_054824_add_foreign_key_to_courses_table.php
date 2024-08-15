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
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('faculty_id')->constrained('faculties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('scientific_group_id')->constrained('scientific_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign('courses_faculty_id_foreign');
            $table->dropForeign('courses_scientific_group_id_foreign');
            $table->dropForeign('courses_admin_id_foreign');
            $table->dropColumn('faculty_id');
            $table->dropColumn('scientific_group_id');
            $table->dropColumn('admin_id');
        });
    }
};
