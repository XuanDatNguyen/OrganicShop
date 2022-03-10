<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\BaivietEditRequest;
use App\Http\Requests\BaivietAddRequest;
use App\Baiviet;
use App\Sanpham;
use App\Nguyenlieu;
use DB;
use Input,File;

class BaivietController extends Controller
{
    public function getList()
    {
        $data =  DB::table('monngon')->orderBy('id','DESC')->get();
    	return view('backend.baiviet.danhsach',compact('data'));
    }

    public function getAdd()
    {
        $data = DB::table('sanpham')->orderBy('id','DESC')->get();
    	return view('backend.baiviet.them',compact('data'));
    }

    public function postAdd(BaivietAddRequest $request)
    {
        // $request->file('fImage')->getClientOriginalName();
        $filename=$request->file('fImage')->getClientOriginalName();
        $request->file('fImage')->move(
            'images/monngon', $filename
        );
    	$bai_viet = new Baiviet;
        $bai_viet->monngon_tieu_de   = $request->txtMNTittle;
        $bai_viet->monngon_tom_tat           = $request->txtMNResum;
        $bai_viet->monngon_noi_dung = $request->txtMNContent;
        $bai_viet->monngon_url   = Replace_TiengViet($request->txtMNTittle);
        $bai_viet->monngon_luot_xem= 1;
        $bai_viet->monngon_anh= $filename;
        $bai_viet->monngon_da_xoa= 1;
        $bai_viet->save();

        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            //print_r($item);
            $nguyen_lieu = new Nguyenlieu;
            $nguyen_lieu->sanpham_id = $item;
            $nguyen_lieu->monngon_id = $bai_viet->id;
            $nguyen_lieu->save();
        }
        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Đăng tin thành công!!!']);
    }

    public function getDelete($id)
    {
        $bai_viet = DB::table('monngon')->where('id',$id)->first();
        $img = 'images/monngon'.$bai_viet->monngon_anh;
        File::delete($img);
    	DB::table('monngon')->where('id',$id)->delete();
        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
    }

    public function getEdit($id)
    {
    	$bai_viet = DB::table('monngon')->where('id',$id)->first();
        $nguyen_lieu = DB::table('nguyenlieu')->select('sanpham_id')->where('monngon_id',$id)->get();
        foreach ($nguyen_lieu as $key => $val) {
            $nglieu[] = $val->sanpham_id;
        }
        if (!empty($nglieu)) {
        
            $san_pham1 = DB::table('sanpham')
                    ->whereIn('id',$nglieu)
                    ->get();
        } else {
            $san_pham1 = DB::table('sanpham')
                    ->whereIn('id',['0'])
                    ->get();
        }

        if (empty($nglieu)) {
            $san_pham2 = DB::table('sanpham')
                    ->whereNotIn('id',['0'])
                    ->get();
        } else {
            $san_pham2 = DB::table('sanpham')
                    ->whereNotIn('id',$nglieu)
                    ->get();
        }
        return view('backend.baiviet.sua',compact('bai_viet','san_pham1','san_pham2'));
    }

    public function postEdit(BaivietEditRequest $request,$id)
    {
    	$fImage = $request->fImage;
        $img_current = 'images/monngon'.$request->fImageCurrent;
        if (!empty($fImage )) {
             $filename=$fImage ->getClientOriginalName();
             DB::table('monngon')->where('id',$id)
                            ->update([
                                'monngon_tieu_de'   => $request->txtMNTittle,
                                'monngon_tom_tat'           => $request->txtMNResum,
                                'monngon_noi_dung' => $request->txtMNContent,
                                'monngon_url'   => Replace_TiengViet($request->txtMNTittle),
                                'monngon_anh'=> $filename
                                ]);
             $fImage ->move(base_path() . 'images/monngon/', $filename);
             File::delete($img_current);
        } else {
            DB::table('monngon')->where('id',$id)
                            ->update([
                                'monngon_tieu_de'   => $request->txtMNTittle,
                                'monngon_tom_tat'           => $request->txtMNResum,
                                'monngon_noi_dung' => $request->txtMNContent,
                                'monngon_url'   => Replace_TiengViet($request->txtMNTittle)
                                ]);
        }
        
        DB::table('nguyenlieu')->where('monngon_id',$id)->delete();
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            $nguyen_lieu = new Nguyenlieu;
            $nguyen_lieu->sanpham_id = $item;
            $nguyen_lieu->monngon_id = $id;
            $nguyen_lieu->save();
        }
        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Edit thành công!!!']);
    }

    public function getEditMaterial($id)
    {
        $nguyen_lieu = DB::table('nguyenlieu')->select('sanpham_id')->where('monngon_id',$id)->get();
        foreach ($nguyen_lieu as $key => $val) {
            $nglieu[] = $val->sanpham_id;
        }
        if (!empty($nglieu)) {
        
            $san_pham1 = DB::table('sanpham')
                    ->whereIn('id',$nglieu)
                    ->get();
        } else {
            $san_pham1 = DB::table('sanpham')
                    ->whereIn('id',['0'])
                    ->get();
        }

        if (empty($nglieu)) {
            $san_pham2 = DB::table('sanpham')
                    ->whereNotIn('id',['0'])
                    ->get();
        } else {
            $san_pham2 = DB::table('sanpham')
                    ->whereNotIn('id',$nglieu)
                    ->get();
        }
        return view('backend.baiviet.suanguyenlieu',compact('san_pham1','san_pham2'));
    }

    public function postEditMaterial(Request $request,$id)
    {
        DB::table('nguyenlieu')->where('monngon_id',$id)->delete();
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            $nguyen_lieu = new Nguyenlieu;
            $nguyen_lieu->sanpham_id = $item;
            $nguyen_lieu->monngon_id = $id;
            $nguyen_lieu->save();
        }
        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Sửa thành công!!!']);
    }

    public function getAddMaterial()
    {
        $san_pham = DB::table('sanpham')->orderBy('id','DESC')->get();
        return view('backend.baiviet.themnguyenlieu',compact('sanpham'));
    }

    public function postAddMaterial(Request $request)
    {
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            //print_r($item);
            $nguyen_lieu = new Nguyenlieu;
            $nguyen_lieu->sanpham_id = $item;
            $nguyen_lieu->monngon_id = $request->txtID;
            $nguyen_lieu->save();
        }
        return redirect()->route('admin.baiviet.list')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);
    }

    public function listMat($id)
    {
        $data =  DB::table('nguyenlieu')->where('monngon_id',$id)->orderBy('id','DESC')->get();
        return view('backend.baiviet.danhsachnglieu',compact('data'));
    }
}
