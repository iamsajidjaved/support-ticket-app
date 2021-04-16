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
        $rules;
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'email' => 'required|email|ends_with_tld|unique:users|max:255',
                    'password' => 'required|case_diff|numbers|letters|symbols|max:255|min:8',
                    'role' => 'required|in:admin,user',
                ];
                break;
            case 'PUT':
                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                ];
                break;
            default:
                # code...
                break;
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return
            [
            'first_name.required' => 'Enter First Name',
            'first_name.max' => 'Maximum 255 Characters',
            'last_name.required' => 'Enter Last Name',
            'last_name.max' => 'Maximum 255 Characters',
            'email.required' => 'Enter Email Address',
            'email.email' => 'Invalid Email Address',
            'email.ends_with_tld' => 'Invalid Email Address',
            'email.unique' => 'Email Already Exists',
            'email.max' => 'Maximum 255 Characters',
            'password.required' => 'Enter New Password',
            'password.min' => 'Use 8 characters or more',
            'password.max' => 'Maximum 255 Characters',
            'password.case_diff' => 'Password will must have atleast 1 uppercase and 1 lower case character',
            'password.numbers' => 'Password will must have atleast 1 number',
            'password.letters' => 'Password will must have atleast 1 letter',
            'password.symbols' => 'Password will must have atleast 1 special character',
            'role.required' => 'Enter Role',
            'role.in' => 'Role must be admin or user',
        ];
    }
}
