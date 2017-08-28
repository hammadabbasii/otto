<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request as Request;

class ItineraryRequest extends Request {

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
            'itinerary_name.unique' => 'Duplicate Itinerary Name'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'itinerary_name' => 'required|string',
        ];

        switch (self::getMethod()) {
            case 'PUT': // Edit/Update
                $rules['itinerary_name'] = 'string|min:3';
                break;
            case 'POST': // New
                $rules['itinerary_name'] = 'required|string|min:3';
                break;
        }

        return $rules;
    }

}
