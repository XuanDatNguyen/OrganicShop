<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConsignmentAddRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'txtLHShelf' => 'required|integer',
            'txtLHQuant'  => 'required|integer',
            'txtLHBuyPrice'  => 'required',
            'txtLHSalePrice' => 'required',
            'txtLHVendor' => 'required',
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'unique'     => '<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'integer'   => '<div><strong  style="color: red;">Kiểu dữ liệu không phù hợp!</strong></div>'
        ];
    }
}
