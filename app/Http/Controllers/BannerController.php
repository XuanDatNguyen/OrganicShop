<?php

namespace App\Http\Controllers;

use DB;
use File;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\BannerAddRequest;
use App\Http\Requests\BannerEditRequest;

class BannerController extends Controller
{
    public function getList()
    {
    	$data = Banner::all();
    	return view('backend.banner.index',compact('data'));
    }

    public function getAdd()
    {
    	return view('backend.banner.add');
    }

    public function postAdd(BannerAddRequest $request)
    {
    	$banner         = new Banner();
        $imageName      = $request->file('fImage')->getClientOriginalName();
    	$banner->status = $request->txtNName;
        $banner->image  = $imageName;
        $request->file('fImage')->move('images/banner', $imageName);
    	$banner->save();

    	return redirect()->route('admin.banner.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);
    }

    public function getEdit($id) {
    	$banner = DB::table('banners')->where('id',$id)->first();
    	return view('backend.banner.edit',compact('banner'));
    }

    public function postEdit(BannerEditRequest $request, $id)
    {
        $fImage = $request->fImage;
        $img_current = 'images/banner/'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('banners')->where('id',$id)
                                 ->update([
                                        'status'   => $request->txtNName,
                                        'image' => $filename
                                    ]);
             $fImage ->move('images/banner', $filename);
             File::delete($img_current);
        } else {
            DB::table('banners')->where('id',$id)
                                ->update([
                                    'status'   => $request->txtNName
                                ]);
        }

    	return redirect()->route('admin.banner.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công!!!']);
    }

    public function getDelete($id)
	{
        $banner = DB::table('banners')->where('id',$id)->first();
        $img = 'images/banner/'.$banner->image;
        File::delete($img);
		DB::table('banners')->where('id',$id)->delete();
        return redirect()->route('admin.banner.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
	}

	public function getChange(Request $request,$id,$status)
	{
		// $status = $request->txtChance;
		print_r($status);
		DB::table('banners')
			->where('id',$id)
            ->update(['status'   => $status]);
        return redirect()->route('admin.banner.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật trạng thái thành công!!!']);
	}
}
