<?php

namespace App\Http\Controllers;


use DB;
use App\Promotion;
use App\PromotionalProduct;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PromotionAddRequest;
use App\Http\Requests\PromotionEditRequest;

class PromotionController extends Controller
{
    public function getList()
    {
        $data  = DB::table('promotions')->orderBy('id','DESC')->get();
        $data1 = DB::table('promotions')->orderBy('id','DESC')->get();

        foreach ($data1 as  $item) {

            $today = date("Y-m-d"); // Năm/Tháng/Ngày
            $begin =  date("Y-m-d", strtotime("$item->created_at")); // Năm/Tháng/Ngày
            $end   = date("Y-m-d",strtotime($begin . "+ $item->estimate  day"));
          
            if ((strtotime($today) >= strtotime($begin)) && (strtotime($today) <= strtotime($end)))
            {      
                DB::table('promotions')->where('id',$item->id)
                                        ->update(['status' => 1]);
            } else{
                DB::table('promotions')->where('id',$item->id)
                                        ->update(['status' => 0]);
            }
        }

    	return view('backend.promotion.index',compact('data'));
    }

    public function getAdd()
    {
        $data = DB::table('products')->orderBy('id','DESC')->get();

    	return view('backend.promotion.add',compact('data'));
    }

    public function postAdd(PromotionAddRequest $request)
    {
        $promotion = new Promotion();

        $promotion->title    = $request->txtKMTittle;
        $promotion->content  = $request->txtKMContent;
        $promotion->slug     = Str::slug($request->txtKMTittle);
        $promotion->percent  = $request->txtKMPer;
        $promotion->estimate = $request->txtKMTime;
        $promotion->status   = 1;

        $promotion->save();

        $data = $request->input('products',[]);

        foreach ($data as  $item) {
            DB::table('products')->where('id',$item)
                                 ->update(['is_promotion'=> 1]);

            $promotional_product = new PromotionalProduct();

            $promotional_product->product_id = $item;
            $promotional_product->promotion_id = $promotion->id;

            $promotional_product->save();
        }
        return redirect()->route('admin.promotion.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);
    }

    public function getDelete($id)
    {
        $promotion = DB::table('promotions')->where('id',$id)->first();
    	DB::table('promotions')->where('id',$id)->delete();

        return redirect()->route('admin.promotion.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công!!!']);
    }

    public function getEdit($id)
    {
    	$promotion = DB::table('promotions')->where('id',$id)->first();
        $promotional_product = DB::table('promotional_products')->select('product_id')->where('promotion_id',$id)->get();

        foreach ($promotional_product as $key => $val) {
            $promotions[] = $val->product_id;
        }
        if (!empty($promotions)) {
        
            $product_1 = DB::table('products')->whereIn('id',$promotions)
                                              ->get();
        } else {
            $product_1 = DB::table('products')->whereIn('id',['0'])
                                              ->get();
        }

        if (empty($promotions)) {
            $product_2 = DB::table('products')->whereNotIn('id',['0'])
                                              ->get();
        } else {
            $product_2 = DB::table('products')->whereNotIn('id',$promotions)
                                              ->get();
        }
        return view('backend.promotion.edit',compact('promotion','product_1','product_2'));
    }

    public function postEdit(PromotionEditRequest $request,$id)
    {
        DB::table('promotions')->where('id',$id)
                               ->update([
                                    'title'   => $request->txtKMTittle,
                                    'content' => $request->txtKMContent,
                                    'slug'   => Str::slug($request->txtKMTittle),
                                    'percent'   => $request->txtKMPer,
                                    'estimate' => $request->txtKMTime,
                                    'status'=>1
                                ]);
   
        $ids = DB::table('promotional_products')->select('product_id')->where('promotion_id',$id)->get();

        foreach ($ids as $val) {
            $p = DB::table('products')->where('id',$val->product_id)
                                      ->update(['is_promotion'=> 0]);
        }

        DB::table('promotional_products')->where('promotion_id',$id)->delete();
        
        $data = $request->input('products',[]);
        
        foreach ($data as  $item) {
            $u = DB::table('products')->where('id',$item)
                                      ->update(['is_promotion' => 1]);

            $promotional_product = new PromotionalProduct();

            $promotional_product->product_id   = $item;
            $promotional_product->promotion_id = $id;

            $promotional_product->save(); 
            
        }
        return redirect()->route('admin.promotion.index')->with(['flash_level'=>'success','flash_message'=>'Edit thành công!!!']);
    }

    public function getAddPromotion()
    {
        $product = DB::table('products')->where('sanpham_da_xoa',1)->orderBy('id','DESC')->get();
        return view('backend.promotion.addsanphamkm',compact('product'));
    }

    public function postAddPromotion(Request $request)
    {
        $data = $request->input('products',[]);
        foreach ($data as  $item) {
            DB::table('products')->where('id',$item)
                                 ->update(['is_promotion'=> 1]);
            $promotional_product = new PromotionalProduct();

            $promotional_product->product_id   = $item;
            $promotional_product->promotion_id = $request->txtID;

            $promotional_product->save();
        }
        return redirect()->route('admin.promotion.index')->with(['flash_level'=>'success','flash_message'=>'Thêm thành công!!!']);
    }

    public function getEditPromotion($id)
    {
        $promotional_product = DB::table('promotional_products')->select('product_id')->where('promotion_id',$id)->get();
        foreach ($promotional_product as $key => $val) {
            $promotions[] = $val->product_id;
        }

        if (!empty($promotions)) {
            $product_1 = DB::table('products')->whereIn('id',$promotions)
                                              ->get();
        } else {
            $product_1 = DB::table('products')->whereIn('id',['0'])
                                              ->get();
        }

        if (empty($promotions)) {
            $product_2 = DB::table('products')->whereNotIn('id',['0'])
                                              ->get();
        } else {
            $product_2 = DB::table('products')->whereNotIn('id',$promotions)
                                              ->get();
        }
        return view('backend.promotion.suasanphamkm',compact('product_1','product_2'));
    }


public function postEditPromotion(Request $request,$id)
    {
        $ids = DB::table('promotional_products')->select('product_id')->where('promotion_id',$id)->get();
        foreach ($ids as $val) {
            $p = DB::table('products')->where('id',$val->product_id)
                                      ->update(['is_promotion'=> 0]);
        }
        DB::table('promotional_products')->where('promotion_id',$id)->delete();
        
        $data = $request->input('products',[]);
        
        foreach ($data as  $item) {
            $u = DB::table('products')->where('id',$item)
                                      ->update(['is_promotion' => 1]);

            $promotional_product = new PromotionalProduct();

            $promotional_product->product_id   = $item;
            $promotional_product->promotion_id = $id;

            $promotional_product->save(); 
        }
        return redirect()->route('admin.promotion.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
    }

}
