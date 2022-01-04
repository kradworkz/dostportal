<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|max:150|unique:users,email,'.$this->id,
            'status_id' => 'required|integer',
            'department_id' => 'required|integer',
            'position_id' => 'required|integer',
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'middlename' => 'required|string|max:20',
            'extension' => 'nullable|string|max:20',
            'birthday' => 'required',
            'gender' => 'required',
            'mobile_no' => 'required|unique:user_profiles,mobile_no,'.$this->id,
            'img' => 'nullable|image64:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        $message =  [
            'email.required' => '* required',
            'email.unique' => '* existed',
            'firstname.required' => '* required',
            'lastname.required' => '* required',
            'middlename.required' => '* required',
            'birthday.required' => '* required',
            'gender.required' => '* required',
            'mobile_no.required' => '* required',
            'mobile_no.unique' => '* existed',
            'status_id.required' => '* required',
            'position_id.required' => '* required',
            'department_id.required' => '* required',

        ];

        return $message;
    }
}
