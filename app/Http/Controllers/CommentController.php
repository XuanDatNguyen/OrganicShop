<?php

namespace App\Http\Controllers;

use DB;

class CommentController extends Controller
{
    public function getList()
    {
    	$data = DB::table('comments')->orderBy('id','DESC')->get();
        $data1 = DB::table('comments')->where('status',1)->orderBy('id','DESC')->get();
        $data2 = DB::table('comments')->where('status',0)->orderBy('id','DESC')->get();

    	return view('backend.comment.index',compact('data','data1','data2'));
    }

    public function getDelete($id)
    {
    	DB::table('comments')->where('id',$id)->delete();

        return redirect()->route('admin.comment.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
    }

    public function getEdit($id)
    {
    	DB::table('comments')->where('id',$id)
    		                 ->update(['status'=>1]);

    	return redirect()->route('admin.comment.index')->with(['flash_level'=>'success','flash_message'=>'Bình luận đã được chấp nhận!!!']);
    }

    public function getEdit1($id)
    {
        DB::table('comments')->where('id',$id)
                             ->update(['status'=>0]);
        return redirect()->route('admin.comment.index')->with(['flash_level'=>'success','flash_message'=>'Bình luận không được chấp nhận!!!']);
    }
}
