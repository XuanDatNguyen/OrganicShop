<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitAddRequest;
use App\Http\Requests\UnitEditRequest;
use App\Unit;
use DB;

class UnitController extends Controller
{

    public function getList()
    {
    	$data = DB::table('units')->get();
    	return view('backend.unit.index',compact('data'));
    }

    public function getAdd()
    {
    	return view('backend.unit.add');
    }

    public function postAdd(UnitAddRequest $request)
    {
    	$unit = new Unit();
    	$unit->name   = $request->txtDVTName;
    	$unit->description = $request->txtDVTIntro;
    	$unit->save();
    	return redirect()->route('admin.unit.index')->with(['flash_level'=>'success','flash_message'=>'Thêm đơn vị thành công!!!']);
    }

    public function getEdit($id)
    {
    	$unit = DB::table('units')->where('id',$id)->first();
    	return view('backend.unit.edit',compact('unit'));
    }

    public function postEdit(UnitEditRequest $request, $id)
    {
    	$unit = DB::table('units')
    				->where('id',$id)
    				->update
					    	([
					    	'name'   => $request->txtDVTName,
					    	'description' => $request->txtDVTIntro,
					    	]);
    	return redirect()->route('admin.unit.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật đơn vị thành công!!!']);
    }

    public function getDelete($id)
    {
    	DB::table('units')->where('id',$id)->delete();
        return redirect()->route('admin.unit.index')->with(['flash_level'=>'success','flash_message'=>'Xóa đơn vị thành công!!!']);
    }
}
