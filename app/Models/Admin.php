<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable =
        [
            'uuid',
            'firstname',
            'lastname',
            'nationalcode',
            'birth_certificate_id',
            'status_marital',
            'fathername',
            'place_birth',
            'place_issuance_birth_certificate',
            'birth_date',
            'state_id',
            'city_id',
            'office_address',
            'home_address',
            'postalcode',
            'phone',
            'mobile',
            'avatar',
            'status',
        ];

    protected $hidden = [
        'password',
        'deleted_at'
    ];

    public function universities()
    {
        return $this->hasMany(University::class , 'admin_id');
    }

    public function classroom()
    {
        return $this->hasMany(ClassRoom::class , 'admin_id');
    }

    public function scientific_group()
    {
        return $this->hasMany(ScientificGroup::class , 'admin_id');
    }

    public function course()
    {
        return $this->hasMany(Course::class , 'admin_id');
    }

    public function lecture()
    {
        return $this->hasMany(Lecture::class , 'admin_id');
    }

    public function semester()
    {
        return $this->hasMany(Semester::class , 'admin_id');
    }

    public function lecture_time_table()
    {
        return $this->hasMany(LectureTimeTable::class , 'admin_id');
    }

    public function faculty_time_table_semester()
    {
        return $this->hasMany(FacultyTimeTableSemester::class , 'admin_id');
    }

    public function class_room_time_table_semester()
    {
        return $this->hasMany(ClassRoomTimeTableSemester::class , 'admin_id');
    }

}
