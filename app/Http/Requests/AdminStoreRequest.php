<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
        return
            [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'nationalcode' => ['required' , 'min:10' , 'max:10'],
            'birth_certificate_id' => ['required'],
            'status_marital' => ['required'],
            'fathername' => ['required'],
            'place_birth' => ['required'],
            'place_issuance_birth_certificate' => ['required'],
            'birth_date' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'office_address' => ['required'],
            'home_address' => ['required'],
            'postalcode' => ['required'],
            'phone' => ['required'],
            'mobile' => ['required'],
            'avatar' => ['required'],
            'status' => ['required'],
        ];
    }
}
