<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'code',
            'type',
            'name',
            'description',
            'phone',
            'fax',
            'state_id',
            'city_id',
            'address',
            'website',
            'logo',
            'admin_id',
            'status',
        ];

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function faculty()
    {
        return $this->hasMany(Faculty::class , 'university_id');
    }

    public function semester()
    {
        return $this->hasMany(Semester::class , 'university_id');
    }

    public function lecture_course()
    {
        return $this->hasMany(LectureCourse::class , 'university_id');
    }

    public function lecture_time_table()
    {
        return $this->hasMany(LectureTimeTable::class , 'university_id');
    }

    public function faculty_time_table_semester()
    {
        return $this->hasMany(FacultyTimeTableSemester::class , 'university_id');
    }

    public function class_room_time_table_semester()
    {
        return $this->hasMany(ClassRoomTimeTableSemester::class , 'university_id');
    }

}
