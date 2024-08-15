<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LectureCourse extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'university_id',
            'faculty_id',
            'scientific_group_id',
            'semester_id',
            'lecture_id',
            'course_id',
        ];

    public function university()
    {
        return $this->belongsTo(University::class , 'university_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class , 'faculty_id');
    }

    public function scientific_group()
    {
        return $this->belongsTo(ScientificGroup::class , 'scientific_group_id');
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class , 'lecture_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class , 'semester_id');
    }

    public function class_room_time_table_semester()
    {
        return $this->hasMany(ClassRoomTimeTableSemester::class , 'semester_id');
    }

}
