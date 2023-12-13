<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'=> 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'email'     => request()->method() == 'POST' ? 'required|email:rfc,dns|unique:users,email' : 'required|email:rfc,dns|unique:users,email,'.$this->employee,
            'phone'     => request()->method() == 'POST' ? [
                    'required',
                    'regex:/^(?:\+20|0)?(1[0-2]|2\d|1[5-9])[0-9]{8}$/',
                    'unique:users,phone'
                ] : [
                    'required',
                    'regex:/^(?:\+20|0)?(1[0-2]|2\d|1[5-9])[0-9]{8}$/',
                    'unique:users,phone,'.$this->employee
                ],
            'department_id' => 'sometimes|nullable|exists:departments,id',
            'manager_id'    => 'sometimes|nullable|exists:users,id',
            'password'  => request()->method() == 'POST' ? [
                        'min:8',
                        'regex:/[A-Z]/',
                        'regex:/[a-z]/',
                        'regex:/[0-9]/',
                        'regex:/[@$!%*#?&]/'
                    ] : [
                        'sometimes',
                        'nullable',
                        'min:8',
                        'regex:/[A-Z]/',
                        'regex:/[a-z]/',
                        'regex:/[0-9]/',
                        'regex:/[@$!%*#?&]/'
                    ],
            'salary'    => 'required|numeric|min:0|max:100000', // Example salary value
            'image'     => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
