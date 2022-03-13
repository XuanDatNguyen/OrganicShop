<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductAddRequest extends Request
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'txtSPName'  => 'required|unique:products,name',
            'txtSPCate'  => 'required',
            'txtSPUnit'  => 'required',
            'txtSPIntro' => 'required',
            'txtSPImage' => 'required|mimes:jpeg,bmp,png|max:4000',
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'unique'     => '<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'mimes' => '<div><strong  style="color: red;">Vui lòng chọn đúng file ảnh</strong></div>',
            'max' => '<div><strong  style="color: red;">Vui lòng chọn file ảnh có kích thước không quá 2MB</strong></div>'
        ];
    }
}
