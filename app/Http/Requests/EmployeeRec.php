<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRec extends FormRequest
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
            'name' => 'required|string|min:3|max:64',
            'position' => 'required|string|min:3|max:64',
            'email' => 'required|email|unique:employees,email',
            'pin_code' => 'required|min:4',
            'password' => 'nullable|min:6',
            'schedule' => 'nullable|exists:schedules,slug',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }
}
