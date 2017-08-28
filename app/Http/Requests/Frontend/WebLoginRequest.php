<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request as Request;

class WebLoginRequest extends Request {

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
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:30',
        ];
        return $rules;
    }

}
