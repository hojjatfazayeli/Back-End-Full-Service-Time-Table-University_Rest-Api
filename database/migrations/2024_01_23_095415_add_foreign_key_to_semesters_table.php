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
        Schema::table('semesters', function (Blueprint $table) {
            $table->foreignId('university_id')->constrained('universities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('semesters', function (Blueprint $table) {
            $table->dropForeign('semesters_university_id_foreign');
            $table->dropForeign('semesters_faculty_id_foreign');
            $table->dropForeign('semesters_admin_id_foreign');
            $table->dropColumn('university_id');
            $table->dropColumn('faculty_id');
            $table->dropColumn('admin_id');
        });
    }
};
