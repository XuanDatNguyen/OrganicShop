<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PromotionEditRequest extends Request
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
            'txtKMTittle'  => 'required',
            'txtKMContent'  => 'required',
            'txtKMTime' => 'required|numeric|min:0',
        ];
    }

    public function messages() {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'txtKMTime.min' => '<div><strong  style="color: red;">Vui lòng nhập số ngày lớn hơn 0!</strong></div>',
        ];
    }
}
