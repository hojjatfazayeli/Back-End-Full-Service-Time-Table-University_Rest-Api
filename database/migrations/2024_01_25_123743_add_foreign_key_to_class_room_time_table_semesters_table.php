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
        Schema::table('class_room_time_table_semesters', function (Blueprint $table) {
            $table->foreignId('university_id')->constrained('universities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('class_room_id')->constrained('class_rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lecture_course_id')->nullable()->constrained('lecture_courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_room_time_table_semesters', function (Blueprint $table) {
            $table->dropForeign('class_room_time_table_semesters_university_id_foreign');
            $table->dropForeign('class_room_time_table_semesters_faculty_id_foreign');
            $table->dropForeign('class_room_time_table_semesters_semester_id_foreign');
            $table->dropForeign('class_room_time_table_semesters_class_room_id_foreign');
            $table->dropForeign('class_room_time_table_semesters_lecture_course_id_foreign');
            $table->dropForeign('class_room_time_table_semesters_admin_id_foreign');
            $table->dropColumn('university_id');
            $table->dropColumn('faculty_id');
            $table->dropColumn('semester_id');
            $table->dropColumn('class_room_id');
            $table->dropColumn('lecture_course_id');
            $table->dropColumn('admin_id');
        });
    }
};
