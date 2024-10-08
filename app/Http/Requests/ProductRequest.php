<?php

namespace NttpsApp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;
use NttpsApp\Models\Product\ModelProduct;
class ProductRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $model_product = ModelProduct::find($this->product);

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'slug' => 'required|max:255|unique:model_products,slug',
                    'name_th' => 'required',
                    'regular_price' => "required_if:product_type,==,single_product",
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'slug' => 'required|max:255|unique:model_products,slug,'.$model_product->id,
                    'name_th' => 'required',
                    'regular_price' => "required_if:product_type,==,single_product",
                ];
            }
            default:break;
        }
    }
}
