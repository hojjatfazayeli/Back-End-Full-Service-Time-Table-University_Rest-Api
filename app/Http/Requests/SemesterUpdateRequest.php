<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemesterUpdateRequest extends FormRequest
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
            'year' => ['required'],
            'semester_number' => ['required'],
            'number_week' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'university_id' => ['required'],
            'faculty_id' => ['required']
        ];
    }
}
