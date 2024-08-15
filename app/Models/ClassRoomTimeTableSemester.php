<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoomTimeTableSemester extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'week',
            'day',
            'code',
            'start_time',
            'end_time',
            'university_id',
            'faculty_id',
            'semester_id',
            'class_room_id',
            'lecture_course_id',
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

    public function semester()
    {
        return $this->belongsTo(Semester::class , 'semester_id');
    }
    public function class_room()
    {
        return $this->belongsTo(ClassRoom::class , 'class_room_id');
    }

    public function lecture_course()
    {
        return $this->belongsTo(LectureCourse::class , 'lecture_course_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

}
