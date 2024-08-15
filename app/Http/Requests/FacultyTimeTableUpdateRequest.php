<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyTimeTableUpdateRequest extends FormRequest
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
            'university_id' => ['required'],
            'faculty_id' => ['required'],
            'semester_ids' => ['required'],
            'admin_id' => ['required'],
        ];
    }
}
