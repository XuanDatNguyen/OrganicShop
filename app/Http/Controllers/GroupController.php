<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GroupAddRequest;
use App\Http\Requests\GroupEditRequest;
use DB;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function getList()
    {
    	$data = DB::table('groups')->get();
    	return view('backend.group.index',compact('data'));
    }

    public function getAdd()
    {
    	return view('backend.group.add');
    }

    public function postAdd(GroupAddRequest $request)
    {
    	$group = new Group();
        
    	$group->name   = $request->txtNName;
    	$group->slug   = Str::slug($request->txtNName);
    	$group->description = $request->txtNIntro;
    	$group->save();
    	return redirect()->route('admin.group.index')->with(['flash_level'=>'success','flash_message'=>'Thêm nhóm thực phẩm thành công!!!']);
    }

    public function getEdit($id) {
    	$group = DB::table('groups')->where('id',$id)->first();
    	return view('backend.group.edit',compact('group'));
    }

    public function postEdit(GroupEditRequest $request, $id)
    {
        DB::table('groups')->where('id',$id)
                            ->update([
                                'name'   => $request->txtNName,
                                'slug'   => Str::slug($request->txtNName),
                                'description' => $request->txtNIntro,
                                ]);
    	return redirect()->route('admin.group.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật nhóm thực phẩm thành công!!!']);
    }

    public function getDelete($id)
	{
        $group = DB::table('groups')->where('id',$id)->first();
		DB::table('groups')->where('id',$id)->delete();
        return redirect()->route('admin.group.index')->with(['flash_level'=>'success','flash_message'=>'Xóa loại sản phẩm thành công!!!']);
	}
}
