<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureTimeTableStoreRequest extends FormRequest
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
            'info.university_id' => ['required' , 'exists:universities,id'],
            'info.faculty_id' => ['required' , 'exists:faculties,id'],
            'info.scientific_group_id' => ['required' , 'exists:scientific_groups,id'],
            'info.semester_id' => ['required' , 'exists:semesters,id'],
            'info.lecture_id' => ['required' , 'exists:lectures,id'],
            'time_table*day' => ['required' , 'min:1' , 'max:7'],
            'time_table*start_time' => ['required'],
            'time_table*end_time' => ['required'],
        ];
    }
}
