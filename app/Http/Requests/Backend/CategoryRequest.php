<?php
namespace App\Http\Requests\Backend;

use App\Http\Requests\Request as Request;

class CategoryRequest extends Request {

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
    public function messages()
    {
        return [
            'category_name.unique'    => 'Duplicate Category Name'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
			'category_name' => 'required|string',
			
        ];

        switch ( self::getMethod() ) {
            case 'PUT': // Edit/Update
                $rules['category_name'] = 'string|min:3';
                break;
            case 'POST': // New
                $rules['category_name'] = 'required|string|min:3';
                break;
        }

        return $rules;
    }
}