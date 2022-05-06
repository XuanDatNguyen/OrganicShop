<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Khachhang;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Auth;
use DB;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'email' =>'required|unique:users,email|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^',
            'password' => 'required|min:3',
            'txtname' =>'required',
            'txtphone' =>'required',
            'txtaddress' =>'required',
        ];

        $messages = [
            'required'=> 'Vui lòng không để trống trường này!',
            'email.unique'  =>'Dữ liệu này đã tồn tại!',
            'email.regex'  =>'Email không đúng định dạng!',
        ];

        return Validator::make($data,$rules,$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'name' => $data['txtname'],
            'password' => bcrypt($data['password']),
            'loainguoidung_id' => 2,
        ]);
        // $id = DB::table('users')->select('id')->where('email',$data['email'])->first();
        // print_r($id);
        // $filename=$data->file('fImage')->getClientOriginalName();
        // $data->file('fImage')->move(
        //     'images/avatar', $filename
        // );
        Khachhang::create([
            'khachhang_ten' => $data['txtname'],
            'khachhang_email' => $data['email'],
            'khachhang_sdt' => $data['txtphone'],
            // 'khachhang_anh' => $data['txtadr'],
            'user_id' => $user->id,
        ]);
        return $user;
    }

    public function getLogin()
    {
        return view('backend.login');
    }

    public function postLogin(LoginRequest $request)
    {
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'loainguoidung_id'=>1])) {
            // Authentication passed...
            return redirect()->route('admin.index');
        }
        else {
            return redirect()->back();
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}