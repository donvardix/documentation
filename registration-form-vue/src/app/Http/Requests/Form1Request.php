<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Form1Request extends FormRequest
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
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'birthdate' => 'required|date_format:Y-m-d|before:2019-12-31',
            'reportsubject' => 'required|max:50',
            'country' => 'required',
            'phone' => [
                'required',
                'regex:/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{1,3}\)[ \-]*)|([0-9]{1,4})[ \-]*)*?[0-9]{1,4}?[ \-]*[0-9]{1,4}?$/'
            ],
            'email' => 'required|email|max:50|unique:members'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'This field is required.',
            'phone.regex' => 'Please specify a valid phone number'
        ];
    }
}
