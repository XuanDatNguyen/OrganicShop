<?php

namespace App\Http\Controllers;


use App\Consignment;
use App\Http\Requests\ConsignmentAddRequest;
use App\Http\Requests\ConsignmentEditRequest;
use App\Product;
use DB;

class ConsignmentController extends Controller
{
    public function getList()
    {
    	$data = DB::table('consignments')->orderBy('id','DESC')->get();
    	return view('backend.consignment.index',compact('data'));
    }

    public function getAdd()
    {
        $products = DB::table('products')->get();
        foreach ($products as $key => $val) {
            $product[] = ['id' => $val->id, 'name'=> $val->name];
        }
        $vendors = DB::table('vendors')->get();
        foreach ($vendors as $key => $val) {
            $vendor[] = ['id' => $val->id, 'name'=> $val->name];
        }
    	return view('backend.consignment.add',compact('product','vendor'));
    }

    public function postAdd(ConsignmentAddRequest $request)
    {
    	$consignment = new Consignment();
        $consignment->estimate = $request->txtLHShelf;
        $consignment->purchase_price = $request->txtLHBuyPrice;
        $consignment->sale_price = $request->txtLHSalePrice;
        $consignment->qty = $request->txtLHQuant;
        $consignment->sold_qty = 0;
        $consignment->change_qty = 0;
        $consignment->current_qty = $request->txtLHQuant;
        $consignment->product_id = $request->txtLHProduct;
        $consignment->vendor_id = $request->txtLHVendor;
        $consignment->save();
        return redirect()->route('admin.consignment.index')->with(['flash_level'=>'success','flash_message'=>'Thêm lô hàng thành công!!!']);
    }

    public function getEdit($id)
    {
        $products = DB::table('products')->get();
        foreach ($products as $key => $val) {
            $product[] = ['id' => $val->id, 'name'=> $val->name];
        }
        $vendors = DB::table('vendors')->get();
        foreach ($vendors as $key => $val) {
            $vendor[] = ['id' => $val->id, 'name'=> $val->name];
        }
        $consignment = DB::table('consignments')->where('id',$id)->first();

    	return view('backend.consignment.edit',compact('product','vendor','consignment','id'));
    }

    public function postEdit(ConsignmentEditRequest $request, $id)
    {
        $consignment = DB::table('consignments')->where('id',$id)->first();
    	DB::table('consignments')->where('id',$id)
                           ->update([
                'estimate' => $request->txtLHShelf,
                'purchase_price' => $request->txtLHBuyPrice,
                'sale_price' => $request->txtLHSalePrice,
                'qty' => $request->txtLHQuant,
                'current_qty' => ($request->txtLHQuant - $consignment->sold_qty + $consignment->change_qty),
                'product_id' => $request->txtLHProduct,
                'vendor_id' => $request->txtLHVendor                
            ]);
    	return redirect()->route('admin.consignment.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật lô hàng thành công!!!']);
    }

    public function getDelete($id)
    {
    	DB::table('consignments')->where('id',$id)->delete();
        return redirect()->route('admin.consignment.index')->with(['flash_level'=>'success','flash_message'=>'Xóa lô hàng thành công!!!']);
    }

    public function getNhaphang($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $vendors = DB::table('vendors')->get();
        foreach ($vendors as $key => $val) {
            $vendor[] = ['id' => $val->id, 'name'=> $val->name];
        }
        return view('backend.consignment.nhaphang',compact('product','vendor'));
    }

    public function postNhaphang(ConsignmentAddRequest $request,$id)
    {
        $consignment = new Consignment();
        $consignment->estimate = $request->txtLHShelf;
        $consignment->purchase_price = $request->txtLHBuyPrice;
        $consignment->sale_price = $request->txtLHSalePrice;
        $consignment->qty = $request->txtLHQuant;
        $consignment->sold_qty = 0;
        $consignment->change_qty = 0;
        $consignment->current_qty = $request->txtLHQuant;
        $consignment->product_id = $id;
        $consignment->vendor_id = $request->txtLHVendor;
        $consignment->save();
        return redirect()->route('admin.consignment.index')->with(['flash_level'=>'success','flash_message'=>'Thêm lô hàng thành công!!!']);
    }
}
 