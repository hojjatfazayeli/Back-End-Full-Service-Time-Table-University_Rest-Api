<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'year',
            'semester_number',
            'number_week',
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            'university_id',
            'faculty_id',
            'admin_id',
        ];

    public function university()
    {
        return $this->belongsTo(University::class , 'university_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class , 'faculty_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function lecture_course()
    {
        return $this->hasMany(LectureCourse::class , 'university_id');
    }

    public function lecture_time_table()
    {
        return $this->hasMany(LectureTimeTable::class , 'semester_id');
    }

    public function faculty_time_table_semester()
    {
        return $this->hasMany(FacultyTimeTableSemester::class , 'semester_id');
    }

    public function class_room_time_table_semester()
    {
        return $this->hasMany(ClassRoomTimeTableSemester::class , 'semester_id');
    }


}
