<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\User;
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
            'password' => 'required|min:3|confirmed',
            'password_confirmation' =>'required|same:password',
            'txtname' =>'required',
            'txtphone' =>'required',
        ];

        $messages = [
            'required'=> 'Vui lòng không để trống trường này!',
            'email.unique'  =>'Dữ liệu này đã tồn tại!',
            'email.regex'  =>'Email không đúng định dạng!',
            'password_confirmation.same' =>'Mật khẩu không trùng khớp!'
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
            'role_id' => 2,
        ]);
       
        Customer::create([
            'name' => $data['txtname'],
            'email' => $data['email'],
            'phone' => $data['txtphone'],
            'address' => $data['txtAddress'],
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
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id'=>1])) {
            // Authentication passed...
            return redirect()->route('admin.index');
        }
        else {
            return redirect()->back()->with(['flash_level'=>'warning','flash_message'=>'Sai thông tin đăng nhập!!!']);
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}