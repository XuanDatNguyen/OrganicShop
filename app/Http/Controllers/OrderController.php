<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function getList()
    {
    	$data = DB::table('orders')->get();
    	return view('backend.order.index',compact('data'));
    }

    public function getEdit($id)
    {
    	$data = DB::table('order_statuses')->get();
		foreach ($data as $key => $val) {
			$order_statuses[] = ['id' => $val->id, 'name'=> $val->name];
		}
    	$order = DB::table('orders')->where('id',$id)->first();
    	$customer = DB::table('customers')->where('id',$order->customer_id)->first();
    	$order_detail = DB::table('order_details')->where('order_id',$order->id)->get();

    	return view('backend.order.sua',compact('order','order_statuses','customer','order_detail'));
    }

    public function postEdit(Request $request,$id)
    {
    	$order = DB::table('orders')->where('id',$id)->first();
    	$status1 = $order->order_status_id;
    	$status2 = $request->selStatus;
		// die($request);
    	// $idSP = DB::table('order_details')->select('product_id','qty')->where('order_id',$id)->get();
    	// // print_r($idSP);
    	// foreach ($idSP as $key => $val) {
    	// 	$new_consignment_id = Db::table('consignments')->where('product_id',$val->product_id)->max('id');
    	// 	$consignment = DB::table('consignments')->where('id',$new_consignment_id)->first();
    	// 	print_r($consignment);
    	// }

    	if ($status1 != $status2 && $status2 == 2) {
    		DB::table('orders')->where('id',$id)
    						   ->update(['order_status_id' => $status2]);
							   
    		$idSP = DB::table('order_details')->select('product_id','qty')
    									->where('order_id',$id)->get();

	    	foreach ($idSP as $key => $val) {

	    		$new_consignment_id  = DB::table('consignments')->where('product_id',$val->product_id)->max('id');
	    		$consignment = DB::table('consignments')->where('id',$new_consignment_id)->first();
	    		DB::table('consignments')->where('id',$new_consignment_id)
										 ->update([
											 'sold_qty' => $consignment->sold_qty + $val->qty,
											 'current_qty' => $consignment->current_qty - $val->qty,
										 ]);
	    	}
    	}elseif ($status1 != $status2 && $status2 == 3) {
					DB::table('orders')->where('id',$id)
									   ->update(['order_status_id' => $status2]);

    		$idSP = DB::table('order_details')->select('product_id','qty')
    									->where('order_id',$id)->get();

	    	foreach ($idSP as $key => $val) {
	    		$new_consignment_id = Db::table('consignments')->where('product_id',$val->product_id)->max('id');
	    		$consignment = DB::table('consignments')->where('id',$new_consignment_id)->first();
	    		DB::table('consignments')->where('id',$new_consignment_id)
										 ->update([
										 	 'change_qty' => $consignment->change_qty + $val->qty,
										 	 'current_qty' => $consignment->current_qty - $val->qty,
										 ]);
	    	}
    	}elseif ($status1 != $status2 && $status2 == 4) {

					DB::table('orders')->where('id',$id)
									->update(['order_status_id' => $status2]);

    		$idSP = DB::table('order_details')->select('product_id','qty')
    									->where('order_id',$id)->get();
	    	foreach ($idSP as $key => $val) {

	    		$new_consignment_id = DB::table('consignments')->where('product_id',$val->product_id)->max('id');
	    		$consignment 		= DB::table('consignments')->where('id',$new_consignment_id)->first();
									  DB::table('consignments')->where('id',$new_consignment_id)
															  ->update([
																  'sold_qty' => $consignment->sold_qty + $val->qty,
																  'current_qty' => $consignment->current_qty - $val->qty,
															  ]);
	    	}
    	}
    	else {
    		DB::table('orders')->where('id',$id)
    			->update(['order_status_id' => $status2]);
    	}
    	
    	return redirect()->route('admin.order.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
    	
    }
    public function getEdit1($id)
    {
    	$data = DB::table('order_statuses')->get();
		foreach ($data as $key => $val) {
			$order_statuses[] = ['id' => $val->id, 'name'=> $val->name];
		}
    	$order = DB::table('orders')->where('id',$id)->first();
    	$customer = DB::table('customers')->where('id',$order->customer_id)->first();
    	$order_detail = DB::table('order_details')->where('order_id',$order->id)->get();
    	return view('backend.order.suagiaohang',compact('order','order_statuses','customer','order_detail'));
    }

    public function postEdit1(OrderRequest $request,$id)
    {
    	DB::table('orders')->where('id',$id)
						   ->update([
								'recipient'=> $request->txtName,
								'recipient_phone'=> $request->txtPhone,
								'recipient_email'=> $request->txtEmail,
								'recipient_address'=> $request->txtAddress,
								'order_note'=> $request->txtNote,
						   ]);

    	return redirect()->route('admin.order.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
    }

    public function getEdit2($id)
    {
    	$data = DB::table('order_statuses')->get();
		foreach ($data as $key => $val) {
			$order_statuses[] = ['id' => $val->id, 'name'=> $val->name];
		}
    	$order = DB::table('orders')->where('id',$id)->first();
    	$customer = DB::table('customers')->where('id',$order->customer_id)->first();
    	$order_detail = DB::table('order_details')->where('order_id',$order->id)->get();

    	return view('backend.order.suathanhtoan',compact('order','order_statuses','customer','order_detail'));
    }

    public function postEdit2(Request $request,$id)
    {
    	$sp= DB::select('select product_id,qty,total_amount,(total_amount/qty) as gia from order_details where order_id = ?', [$id]);
    	$data = $request->input('products',[]);

    	for ($i=0; $i < count($sp); $i++) { 
    		$a = $sp[$i]->product_id;
    		DB::table('order_details')->where([['product_id',$a],['order_id',$id] ])
								->update([
									'qty'=>$request->txtQuant[$i],
									'total_amount'=>($request->txtQuant[$i]*$sp[$i]->gia),
								]);
						}
    	foreach ($data as  $val) {
    		DB::table('order_details')->where([['product_id',$val],['order_id',$id]])->delete();
    	}


    	$tong = DB::select('select sum(total_amount) as tong from order_statuses where order_id = ?', [$id]);

    	$p = DB::table('orders')->where('id',$id)
    							->update(['donhang_tong_tien' =>$tong[0]->tong]);

    	return redirect()->route('admin.order.index')->with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!!!']);
    }

}
