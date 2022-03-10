<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoaisanphamEditRequest extends Request
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
            'txtLSPName'    => 'required',
            'txtLSPParent'  => 'required',
        ];
    }

    public function messages() {
        return [
            'txtLSPName.required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtLSPParent.required'   => '<div><strong  style="color: red;">Vui lòng chọn dữ liệu!</strong></div>',
        ];
    }
}