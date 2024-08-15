<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversityUpdateRequest extends FormRequest
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
            'type' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'phone' => ['required'],
            'fax' => ['required'],
            'website' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'address' => ['required'],
        ];
    }
}
