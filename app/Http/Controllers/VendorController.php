<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorAddRequest;
use App\Http\Requests\VendorEditRequest;
use App\Vendor;
use DB;

class VendorController extends Controller
{
    public function getList()
    {
        $data = DB::table('vendors')->orderBy('id','DESC')->get();
    	return view('backend.vendor.index',compact('data'));
    }

    public function getAdd()
    {
    	return view('backend.vendor.add');
    }

    public function postAdd(VendorAddRequest $request)
    {
    	$vendor = new Vendor();
        $vendor->name = $request->txtNCCName;
        $vendor->address = $request->txtNCCAdress;
        $vendor->phone = $request->txtNCCPhone;
        $vendor->save();
        return redirect()->route('admin.vendor.index')->with(['flash_level'=>'success','flash_message'=>'Thêm nhà cung cấp thành công!!!']);
    }

    public function getDelete($id)
    {
        $vendor = DB::table('vendors')->where('id',$id)->delete();
        return redirect()->route('admin.vendor.index')->with(['flash_level'=>'success','flash_message'=>'Xóa nhà cung cấp thành công!!!']);
    }

    public function getEdit($id)
    {
    	$data = DB::table('vendors')->where('id',$id)->first();
        return view('backend.vendor.edit',compact('data'));
    }

    public function postEdit(VendorEditRequest $request, $id)
    {
        $vendor = DB::table('vendors')->where('id',$id)->update([
            'name'=> $request->txtNCCName,
            'address' => $request->txtNCCAdress,
            'phone' => $request->txtNCCPhone
            ]);
        return redirect()->route('admin.vendor.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa nhà cung cấp thành công!!!']);
    }
}
