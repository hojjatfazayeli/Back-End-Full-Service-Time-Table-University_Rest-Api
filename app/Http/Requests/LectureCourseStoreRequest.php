<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureCourseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'university_id' => ['required' ,'exists:universities,id'],
            'faculty_id' => ['required' ,'exists:faculties,id'],
            'scientific_group_id' => ['required' ,'exists:scientific_groups,id'],
            'semester_id' => ['required' ,'exists:semesters,id'],
            'lecture_id' => ['required' ,'exists:lectures,id'],
            'course_id' => ['required' ,'exists:courses,id'],
        ];
    }
}
