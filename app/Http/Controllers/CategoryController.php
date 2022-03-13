<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\CategoryEditRequest;
use Illuminate\Support\Str;
use DB;

class CategoryController extends Controller
{
    public function getList()
	{
		$data =  DB::table('categories')->orderBy('id','DESC')->get();
		return view('backend.category.index',compact('data'));
	}

	public function getAdd() {
		$data = DB::table('groups')->get();
		foreach ($data as $key => $val) {
			$group[] = ['id' => $val->id, 'name'=> $val->name];
		}
		return view('backend.category.add',compact('group'));
	}

	public function postAdd(CategoryAddRequest $request) {
		$category = new Category();

		$category->name	= $request->txtLSPName;
		$category->group_id			= $request->txtLSPParent;
		$category->description	= $request->txtLSPIntro;
		$category->slug	= Str::slug($request->txtLSPName);
		
		$category->save();
		return redirect()->route('admin.category.index')->with(['flash_level'=>'success','flash_message'=>'Thêm loại sản phẩm thành công!!!']);
	}

	public function getDelete($id)
	{
		$category = DB::table('categories')->where('id',$id)->first();
		DB::table('categories')->where('id',$id)->delete();
        return redirect()->route('admin.category.index')->with(['flash_level'=>'success','flash_message'=>'Xóa loại sản phẩm thành công!!!']);
	}

	public function getEdit($id)
	{
		$category = DB::table('categories')->where('id',$id)->first();
		$data = DB::table('groups')->get();
		foreach ($data as $key => $val) {
			$group[] = ['id' => $val->id, 'name'=> $val->name];
		}
		return view('backend.category.edit',compact('group','category','id'));
	}

	public function postEdit(CategoryEditRequest $request,$id)
	{
		DB::table('categories')->where('id',$id)
						->update([
							'name' => $request->txtLSPName,
							'slug' => Str::slug($request->txtLSPName),
							'group_id'=>$request->txtLSPParent,
							'description'=>$request->txtLSPIntro,
							// 'loaisanpham_anh' => $filename
							]);		
		return redirect()->route('admin.category.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa loại sản phẩm thành công!!!']);
	}
}
