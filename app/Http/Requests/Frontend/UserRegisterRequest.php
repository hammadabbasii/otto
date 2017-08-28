<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Jsonify as Request;

class UserRegisterRequest extends Request {

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
    public function messages() {
        return [
            'email.required' => 'email is required',
            'email.unique' => 'email already found in our system, please try another one.',
            'password.required' => 'password is required.',
            'full_name.required' => 'full_name is required.',
//            'profile_picture.required' => 'profile_picture is required.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'full_name' => 'required|string',
            'device_type' => 'required|string',
            'device_token' => 'required|string',
//            'profile_picture' => 'required|image| mimes:jpeg,jpg,png',
        ];
    }

}
