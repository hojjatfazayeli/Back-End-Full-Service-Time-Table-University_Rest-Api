<?php

namespace App\Http\Controllers\AdminPanel\Assign_System;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\LectureCourse;
use Illuminate\Http\Request;

class AssignSystemController extends Controller
{
    protected $university_id = null;
    protected $faculty_id = null;
    protected $scientic_group_id = null;
    protected $semester_id = null;
    protected $lecture_id = null;
    public $query = null;


    public function __construct($university_id ,$faculty_id , $scientic_group_id ,$semester_id , $lecture_id)
    {
        $this->university_id = $university_id;
        $this->faculty_id = $faculty_id;
        $this->scientic_group_id = $scientic_group_id;
        $this->semester_id = $semester_id;
        $this->lecture_id = $lecture_id;
    }

    public function buildQuery($query)
    {
        if ($this->university_id != null) {
            $query->where('university_id', $this->university_id);
        }
        if ($this->faculty_id != null) {
            $query->where('faculty_id', $this->faculty_id);
        }
        if ($this->scientic_group_id != null) {
            $query->where('scientic_group_id', $this->scientic_group_id);
        }
        if ($this->semester_id != null) {
            $query->where('semester_id', $this->semester_id);
        }
        if ($this->lecture_id != null) {
            $query->where('lecture_id', $this->lecture_id);
        }

        return $query->get();
    }

    public function calculate()
    {
        $get_free_lecture_course = $this->getResultQuery(LectureCourse::query());
    }


    private function getResultQuery($queryModel)
    {
        $query = $this->buildQuery($queryModel);
        return $query;
    }
}
