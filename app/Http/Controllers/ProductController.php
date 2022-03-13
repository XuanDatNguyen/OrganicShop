<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductEditRequest;
use App\Product;
use DB;
use File;
class ProductController extends Controller
{
    public function getList()
    {
        $data1 = DB::table('products')->get();

        foreach ($data1 as $item) {
            $data2 = DB::table('promotional_products')->where('product_id',$item->id)->get();

            foreach ($data2 as $val1) {
                if (!is_null($val1)) {
                    $data3 = DB::table('promotions')->where('id',$val1->promotion_id)->first();
                    // print_r($data3);
                    // $data3 = DB::table('khuyenmai')->where('id',$data2->khuyenmai_id)->first();
                    if ($data3->status == 0) {
                        $u = DB::table('products')
                            ->where('id',$item->id)
                            ->update(['is_promotion' => 0 ]);
                        }
                    else{
                        $u = DB::table('products')
                            ->where('id',$item->id)
                            ->update(['is_promotion' => 1 ]);
                    }
                }
            }   
        }
        $data = DB::table('products')
            ->orderBy('id','DESC')->get();
    	return view('backend.product.index',compact('data'));
    }

    public function getAdd()
    {
        $units = DB::table('units')->get();
        foreach ($units as $key => $val) {
            $unit[] = ['id' => $val->id, 'name'=> $val->name];
        }
        $cates = DB::table('categories')->get();
        foreach ($cates as $key => $val) {
            $cate[] = ['id' => $val->id, 'name'=> $val->name];
        }
    	return view('backend.product.add',compact('cate','unit'));
    }

    public function postAdd(ProductAddRequest $request)
    {
        $filename=$request->file('txtSPImage')->getClientOriginalName();
        $request->file('txtSPImage')->move(
            'images/products', $filename
        );
    	$product = new Product();
        $product->name           = $request->txtSPName;
        $product->slug           = Str::slug($request->txtSPName);
        $product->description = $request->txtSPIntro;
        $product->image = $filename;
        $product->category_id = $request->txtSPCate;
        $product->unit_id = $request->txtSPUnit;
       
        $product->is_promotion = 0;
        $product->save();
        
        // $files =[];
        // if ($request->file('txtSPImage1')) {
        //     $files[] = $request->file('txtSPImage1');
        // }
        // if ($request->file('txtSPImage2')) {
        //     $files[] = $request->file('txtSPImage2');
        // } 
        // if ($request->file('txtSPImage3')) {
        //     $files[] = $request->file('txtSPImage3');
        // }
        // if ($request->file('txtSPImage4')) {
        //     $files[] = $request->file('txtSPImage4');
        // } 
        // if ($request->file('txtSPImage5')) {
        //     $files[] = $request->file('txtSPImage5');
        // }

        // $names =[];   

        // foreach ($files as $file) {
        //     if(!empty($file)){
        //         $filename=$file->getClientOriginalName();
        //         $file->move(
        //             'images/chitietsanpham', $filename
        //         );

        //         $hinh = new Hinhsanpham; 
        //         $hinh->hinhsanpham_ten = $filename;
        //         $hinh->sanpham_id = $product->id;
        //         $hinh->save();
        //     }
        // }

        return redirect()->route('admin.product.index')->with(['flash_level'=>'success','flash_message'=>'Thêm mới sản phẩm thành công!!!']);
    }

    public function getDelete($id)
    {   
        $binhluan = DB::table('comments')->where('product_id',$id)->get();
        foreach ($binhluan as $val) {
            
            DB::table('comments')->where('product_id',$id)->delete();
        }
        DB::table('consignments')->where('product_id',$id)->delete();
        
    	$product = DB::table('products')->where('id',$id)->first();
        $img = 'images/products/'.$product->image;
        File::delete($img);
        DB::table('products')->where('id',$id)->delete();

        return redirect()->route('admin.product.index')->with(['flash_level'=>'success','flash_message'=>'Xóa sản phẩm thành công!!!']);
    }

    public function getEdit($id)
    {
    	$units = DB::table('units')->get();
        foreach ($units as $key => $val) {
            $unit[] = ['id' => $val->id, 'name'=> $val->name];
        }
        $cates = DB::table('categories')->get();
        foreach ($cates as $key => $val) {
            $cate[] = ['id' => $val->id, 'name'=> $val->name];
        }
        $product = DB::table('products')->where('id',$id)->first();
        return view('backend.product.edit',compact('cate','unit','product','id'));
    }

    public function postEdit($id, ProductEditRequest $request)
    {
        $product = Product::find($id);
        $product->name       = $request->txtSPName;
        $product->slug       = Str::slug($request->txtSPName);
        $product->description     = $request->txtSPIntro;
        $product->category_id    = $request->txtSPCate;
        $product->unit_id      = $request->txtSPUnit;
       
        $img_current = 'images/products/'.$request->fImageCurrent;
        if (!empty($request->fImage)) {
             $filename=$request->fImage->getClientOriginalName();
             $product->image = $filename;
             $request->fImage->move('images/products/', $filename);
             File::delete($img_current);
        } else {
            echo "File empty";
        }

        // if(!empty($request->fEditImage)) {
        //     foreach ($request->fEditImage as $file) {
        //         $detail_img = new Hinhsanpham();
        //         if (isset($file)) {
        //             $detail_img->hinhsanpham_ten = $file->getClientOriginalName();
        //             $detail_img->sanpham_id = $id;
        //             $file->move('images/chitietsanpham/', $file->getClientOriginalName());
        //             $detail_img->save();
        //         } 
        //   }
        // }

        $product->save();

        return redirect()->route('admin.product.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa sản phẩm thành công!!!']);
    }

    // public function delImage($id){
    //     if (Request::ajax()) {
    //         $idHinh = (int)Request::get('idHinh');
    //         $image_detail = Hinhsanpham::find($idHinh);
    //         if(!empty($image_detail)) {
    //             $img = 'images/chitietsanpham/'.$image_detail->hinhsanpham_ten;
    //             //print_r($img);
    //             //if(File::isFile($img)) {
    //                 File::delete($img);
    //             //}
    //             $image_detail->delete();
    //         }
    //         return "Oke";
    //     }
    // }
}
