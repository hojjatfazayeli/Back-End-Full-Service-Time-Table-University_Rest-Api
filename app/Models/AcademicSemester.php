<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicSemester extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable =
        [
            'uuid',
            'title',
            'start_date',
            'end_date',
            'number_week',
            'faculty_start_time',
            'faculty_end_time',
            'faculty_id',
        ];
}
