<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name'=>'required|unique:doctor_translations,name,'.$this->id.',doctor_id',
            'email'=>'required|unique:doctors,email,'.$this->id,
            'password'=> 'required|sometimes',
            'phone'=>'required|unique:doctors,phone,'.$this->id,
            'section_id'=>'required|numeric',
            'appointments'=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>trans('Doctors.name_required'),
            'email.required'=>trans('Doctors.email_required'),
            'email.unique'=>trans('Doctors.email_unique'),
            'password.required'=>trans('Doctors.password_required'),
            'phone.required'=>trans('Doctors.phone_required'),
            'phone.unique'=>trans('Doctors.phone_unique'),
            'section_id.required'=>trans('Doctors.section_id_required'),
            'appointments.required'=>trans('Doctors.appointments_required'),
        ];
    }
}
