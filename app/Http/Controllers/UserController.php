<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\TestRequest;
use App\Role;
use App\User;
use DB;

class UserController extends Controller
{
    public function index() {
        $data = DB::table('users')->get();
    	return view('backend.user.index',compact('data'));
    }

    public function create() {
        $roles = Role::all();
        return view('backend.user.create', compact('roles'));
    }

    public function store(TestRequest $request) {

        $user = new User();

        $user->name = $request->input('txtname');
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        if ($request->hasFile('image')) {
            $imageName = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(
                'images/avatar', $imageName
            );
            $user->avatar = $imageName;
        }

        $user->save();
        return redirect()->route('admin.user.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);
    }
}
