<?php

namespace NttpsApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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
            'name' => 'unique:attribute_values,name'.$this->id .'|max:255',
        ];
    }
    
}
