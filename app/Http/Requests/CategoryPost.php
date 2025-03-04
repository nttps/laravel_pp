<?php

namespace NttpsApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryPost extends FormRequest
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
            'slug' => 'required|unique:post_categories,slug'.$this->id .'|max:255',
        ];
    }
}
