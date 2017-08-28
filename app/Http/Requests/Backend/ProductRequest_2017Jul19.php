<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request as Request;

class ProductRequest extends Request {

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
            'product_name.required' => 'Product Name Is Required',
            'product_description.required' => 'Product Description Is Required',
            'price.required' => 'Product price Is Required.',
            'quantity.required' => 'Product quantity Is Required.',
            'oroduct_image.required' => 'Product Image Is Required.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'product_name' => 'required|string',
            'product_description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'oroduct_image' => 'required|image| mimes:jpeg,jpg,png ',
        ];

//        switch (self::getMethod()) {
//            case 'PUT': // Edit/Update
//                $rules['email'] = 'required|email|unique:users,email,' . collect(self::segments())->last() . ',id';
//                $rules['password'] = 'string|min:6';
//                break;
//            case 'POST': // New
//                $rules['password'] = 'required|string|min:6';
//                break;
//        }

        return $rules;
    }

}
