<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LectureTimeTable extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'day',
            'start_time',
            'end_time',
            'university_id',
            'faculty_id',
            'scientific_group_id',
            'semester_id',
            'lecture_id',
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

    public function scientific_group()
    {
        return $this->belongsTo(ScientificGroup::class , 'scientific_group_id');
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class , 'lecture_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class , 'semester_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

}
