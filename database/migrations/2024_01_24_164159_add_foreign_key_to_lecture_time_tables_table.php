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
        Schema::table('lecture_time_tables', function (Blueprint $table) {
            $table->foreignId('university_id')->constrained('universities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('scientific_group_id')->constrained('scientific_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lecture_id')->constrained('lectures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lecture_time_tables', function (Blueprint $table) {
            $table->dropForeign('lecture_time_tables_university_id_foreign');
            $table->dropForeign('lecture_time_tables_faculty_id_foreign');
            $table->dropForeign('lecture_time_tables_scientific_group_id_foreign');
            $table->dropForeign('lecture_time_tables_semester_id_foreign');
            $table->dropForeign('lecture_time_tables_lecture_id_foreign');
            $table->dropForeign('lecture_time_tables_admin_id_foreign');
            $table->dropColumn('university_id');
            $table->dropColumn('faculty_id');
            $table->dropColumn('scientific_group_id');
            $table->dropColumn('semester_id');
            $table->dropColumn('lecture_id');
            $table->dropColumn('admin_id');
        });
    }
};
