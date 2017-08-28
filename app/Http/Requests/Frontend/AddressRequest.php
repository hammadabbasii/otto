<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Jsonify as Request;

class AddressRequest extends Request {

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
            'country' => 'required|string|max:35',
            'city' => 'required|string|max:35',
            'street_name' => 'required|string|max:35',
            'building_name' => 'required|string|max:35',
            'floor' => 'string|max:35',
            'appartment' => 'string|max:35',
            'nearest_landmark' => 'string||max:35',
            'phone' => 'required|string|max:35',
            'location_type' => 'required|string|max:35',
            'check' => 'required|string|max:35',
        ];
    }

}
