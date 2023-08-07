<?php

namespace sisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
            'idcategory' => 'required',
            'code' => 'required|max:50',
            'name' => 'required|max:100',
            'stock' => 'required|numeric',
            'description' => 'max:512',
            'image' => 'mimes:jpeg,bmb,png'

        ];
    }
}
