<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $stopOnFirstFailure = true;
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
            "name" => 'required',
            "email" => 'required|email|unique:patients,email,'.$this->id,
            "password" => 'required|sometimes',
            "Phone" => 'required|numeric|unique:patients,Phone,'.$this->id,
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            "gender_id" => 'required|integer|in:1,2',
            "Blood_Group" => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.sometimes' => trans('validation.sometimes'),
            'Phone.required' => trans('validation.required'),
            'Phone.unique' => trans('validation.unique'),
            'Phone.numeric' => trans('validation.numeric'),
            'Date_Birth.required' => trans('validation.required'),
            'Date_Birth.date' => trans('validation.date'),
            'Gender.required' => trans('validation.required'),
            'Gender.integer' => trans('validation.integer'),
            'Blood_Group.required' => trans('validation.required'),
        ];
    }
}
