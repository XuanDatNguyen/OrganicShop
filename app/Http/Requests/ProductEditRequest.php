<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductEditRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'txtSPName'  => 'required',
            'txtSPCate'  => 'required',
            'txtSPUnit'  => 'required',
            'txtSPIntro' => 'required',
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtSPSignt.size'   => '<div><strong  style="color: red;">Độ dài dữ liệu trường này là 5!</strong></div>'
        ];
    }
}
