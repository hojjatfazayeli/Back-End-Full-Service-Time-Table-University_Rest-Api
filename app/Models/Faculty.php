<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'code',
            'type',
            'name',
            'status',
            'university_id',
        ];

    public function university()
    {
        return $this->belongsTo(University::class , 'university_id');
    }

    public function classroom()
    {
        return $this->hasMany(ClassRoom::class , 'faculty_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function scientific_group()
    {
        return $this->hasMany(ScientificGroup::class , 'faculty_id');
    }

    public function course()
    {
        return $this->hasMany(Course::class , 'faculty_id');
    }

    public function lecture()
    {
        return $this->hasMany(Lecture::class , 'faculty_id');
    }

    public function semester()
    {
        return $this->hasMany(Semester::class , 'faculty_id');
    }

    public function lecture_course()
    {
        return $this->hasMany(LectureCourse::class , 'university_id');
    }

    public function lecture_time_table()
    {
        return $this->hasMany(LectureTimeTable::class , 'faculty_id');
    }

    public function faculty_time_table_semester()
    {
        return $this->hasMany(FacultyTimeTableSemester::class , 'faculty_id');
    }

    public function class_room_time_table_semester()
    {
        return $this->hasMany(ClassRoomTimeTableSemester::class , 'faculty_id');
    }

}
