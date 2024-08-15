<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomTimeTableSemesterUpdateRequest extends FormRequest
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
            'week' => ['required'],
            'day' => ['required'],
            'code' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'status' => ['required'],
            'university_id' => ['required'],
            'faculty_id' => ['required'],
            'semester_id' => ['required'],
            'class_room_id' => ['required'],
            'lecture_course_id' => ['required'],
            'admin_id' => ['required'],
        ];
    }
}
