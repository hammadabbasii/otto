<?php
namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request as Request;

class WebContactRequest extends Request {

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
    public function rules()
    {

        $rules = [
            'enquiry_type' => 'required',
            'name' => 'required|string|max:50',
            'phone' => 'required|string|min:12|max:16',
            'address' => 'required|string|max:50',
            'product_name' => 'required|string|max:50',
            'store_locations' => 'required|string|max:50',
            'message' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ];
        return $rules;
    }
}