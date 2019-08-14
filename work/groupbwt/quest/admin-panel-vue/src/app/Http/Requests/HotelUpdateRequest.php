<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->can('checkUserHotel', $this->hotel)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'description' => 'required|max:65535',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'postcode' => 'required|string|max:15',
            'country' => 'required|max:255',
            'rating' => 'required|numeric|between:0,10',
            'image' => 'required|max:255',
            'url_hotel' => 'required|url|max:65535'
        ];
    }
}
