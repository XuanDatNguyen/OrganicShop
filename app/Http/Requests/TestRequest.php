<?php

namespace App\Http\Requests;

// use Illuminate\Http\Requests\Request;
use Illuminate\Http\Requests\Request;

class TestRequest extends Request
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
            'txtname'  => 'required',
            'email'  => 'required|email|unique:user',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required'   => '<div><strong  style="color: red;">Vui lòng không để trống trường này!</strong></div>',
            'email.unique' => '<div><strong  style="color: red;">Dữ liệu này đã tồn tại!</strong></div>',
            'email.email' => '<div><strong  style="color: red;">Email sai định dạng!</strong></div>',
        ];
    }
}
