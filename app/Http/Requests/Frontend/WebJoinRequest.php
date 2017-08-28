<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request as Request;

class WebJoinRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation messages.
     *
     * @return array
     */
//    public function messages()
//    {
//        return [
//            'email.unique'    => 'Email already found in our system, please try another one.',
//            'first_name'    => 'Email already found in our system, please try another one.',
//            'password'    => 'aasas.',
//        ];
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'confirm_email' => 'same:email',
            'password' => 'required|string|min:6|max:30',
            'confirm_password' => 'same:password',
            'gender' => 'required',
            'phone_number' => 'required|string|min:12|max:16',
            'dob' => 'required|date_format:Y-m-d',
        ];
        return $rules;
    }

}
