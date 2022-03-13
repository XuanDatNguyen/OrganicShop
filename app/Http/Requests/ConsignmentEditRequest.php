<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConsignmentEditRequest extends Request
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
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            
            'integer'   => '<div><strong  style="color: red;">Kiểu dữ liệu không phù hợp!</strong></div>'
        ];
    }
}
