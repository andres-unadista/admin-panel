<?php

namespace sisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleFormRequest extends FormRequest
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
            'idclient' => 'required',
            'type_voucher' => 'required|max:20',
            'serie_voucher' => 'max:7',
            'num_voucher' => 'required|max:10',
            'pidarticle' => 'required',
            'pquantity' => 'required',
            'total_sale' => 'required',
            'pdiscount' => 'required',
            'pselling' => 'required',
        ];
    }
}
