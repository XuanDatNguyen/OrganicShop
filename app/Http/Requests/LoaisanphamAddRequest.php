<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoaisanphamAddRequest extends Request
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
            'txtLSPName'    => 'required|unique:loaisanpham,loaisanpham_ten',
            'txtLSPParent'  => 'required',
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtLSPName.unique'     => '<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'txtLSPParent.required'   => '<div><strong  style="color: red;">Vui lòng chọn dữ liệu!</strong></div>',
        ];
    }
}
