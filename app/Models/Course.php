<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'code',
            'unit',
            'name',
            'faculty_id',
            'admin_id',
            'scientific_group_id'
        ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class , 'faculty_id');
    }

    public function scientific_group()
    {
        return $this->belongsTo(ScientificGroup::class , 'scientific_group_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function lecture_course()
    {
        return $this->hasMany(LectureCourse::class , 'course_id');
    }


}
