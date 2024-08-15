<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureStoreRequest extends FormRequest
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
            'name' => ['required'],
            'gender' => ['required','in:male,female'],
            'grade' => ['required','in:bachelor,master,phd'],
            'employment_type' => ['required','in:academic_staff,normal'],
            'priority' => ['required'],
            'faculty_id' => ['required' , 'exists:faculties,id'],
            'scientific_group_id' => ['required' , 'exists:scientific_groups,id'],
        ];
    }
}
