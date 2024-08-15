<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScientificGroup extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'title',
            'faculty_id',
        ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class , 'faculty_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function course()
    {
        return $this->hasMany(Course::class , 'scientific_group_id');
    }

    public function lecture()
    {
        return $this->hasMany(Lecture::class , 'scientific_group_id');
    }

    public function lecture_course()
    {
        return $this->hasMany(LectureCourse::class , 'university_id');
    }

    public function lecture_time_table()
    {
        return $this->hasMany(LectureTimeTable::class , 'scientific_group_id');
    }

}
