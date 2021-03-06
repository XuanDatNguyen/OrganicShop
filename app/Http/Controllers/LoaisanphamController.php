<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;

use App\Http\Requests\LoaisanphamAddRequest;
use App\Http\Requests\LoaisanphamEditRequest;

use App\Loaisanpham;
use DB;

use Input,File;

class LoaisanphamController extends Controller
{
    public function getList()
	{
		$data =  DB::table('loaisanpham')->orderBy('id','DESC')->get();
		return view('backend.loaisanpham.danhsach',compact('data'));
	}

	public function getAdd() {
		$data = DB::table('nhom')->get();
		foreach ($data as $key => $val) {
			$nhom[] = ['id' => $val->id, 'name'=> $val->nhom_ten];
		}
		return view('backend.loaisanpham.them',compact('nhom'));
	}

	public function postAdd(LoaisanphamAddRequest $request) {
		$loaisanpham = new Loaisanpham;

		$loaisanpham->loaisanpham_ten	= $request->txtLSPName;
		$loaisanpham->nhom_id			= $request->txtLSPParent;
		$loaisanpham->loaisanpham_mo_ta	= $request->txtLSPIntro;
		$loaisanpham->loaisanpham_url	= Replace_TiengViet($request->txtLSPName);
		
		$loaisanpham->save();
		return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Thêm loại sản phẩm thành công!!!']);
	}

	public function getDelete($id)
	{
		$loaisanpham = DB::table('loaisanpham')->where('id',$id)->first();
		DB::table('loaisanpham')->where('id',$id)->delete();
        return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Xóa loại sản phẩm thành công!!!']);
	}

	public function getEdit($id)
	{
		$loaisp = DB::table('loaisanpham')->where('id',$id)->first();
		$data = DB::table('nhom')->get();
		foreach ($data as $key => $val) {
			$nhom[] = ['id' => $val->id, 'name'=> $val->nhom_ten];
		}
		return view('backend.loaisanpham.sua',compact('nhom','loaisp','id'));
	}

	public function postEdit(LoaisanphamEditRequest $request,$id)
	{
		DB::table('loaisanpham')->where('id',$id)
						->update([
							'loaisanpham_ten' => $request->txtLSPName,
							'loaisanpham_url' => Replace_TiengViet($request->txtLSPName),
							'nhom_id'=>$request->txtLSPParent,
							'loaisanpham_mo_ta'=>$request->txtLSPIntro,
							// 'loaisanpham_anh' => $filename
							]);		
		return redirect()->route('admin.loaisanpham.list')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa loại sản phẩm thành công!!!']);
	}
}
