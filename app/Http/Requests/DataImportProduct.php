<?php

namespace NttpDev\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataImportProduct extends FormRequest
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
            'name.unique' => 'Product name has already',
            'slug.unique' => 'Product slug has already',
        ];
    }
}
