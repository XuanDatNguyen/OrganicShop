<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class CustomerController extends Controller
{

    public function getList()
    {
        $data = DB::table('customers')->get();
    	return view('backend.customer.index',compact('data'));
    }

    public function getAdd()
    {
    	# code...
    }

    public function postAdd()
    {
    	# code...
    }

    public function getDelete($id)
    {
    	$id_user = DB::table('customers')
            ->select('user_id')
            ->where('id',$id)
            ->first();
        DB::table('customers')->where('id',$id)->delete();
        DB::table('users')->where('id',$id_user->user_id)->delete();
        return redirect()->route('admin.customer.index')->with(['flash_level'=>'success','flash_message'=>'Xóa khách hàng thành công!!!']);
    }

    public function getEdit()
    {
    	# code...
    }

    public function postEdit()
    {
    	# code...
    }

    public function getHistory($id)
    {
        $customer = DB::table('customers')->where('id',$id)->first();
        $order = DB::table('orders')->where('customer_id',$id)->get();
        return view('backend.customer.history',compact('customer','order'));
    }
}
