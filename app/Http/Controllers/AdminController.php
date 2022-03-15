<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Chartjs;

class AdminController extends Controller
{
    public function index()
    {
    	$newOrders   = DB::table('orders')->where('order_status_id',1)->count();
    	$newComments = DB::table('comments')->where('status',0)->count();
    	$customers   = DB::table('customers')->count();
    	$products    = DB::table('products')->count();
    	$comments    = DB::table('comments')->where('status',0)->get();

    	$sell_a_lots = DB::table('order_details')->where('orders.order_status_id',4)
                                                 ->join('orders','orders.id','=','order_details.order_id')
                                                 ->select(
                                                    'order_id',
                                                    DB::raw('SUM(qty) as sell'),
                                                    DB::raw('SUM(total_amount) as total_money')
                                                 )
                                                 ->groupBy('product_id')
                                                 ->orderBy('total_money', 'DESC')
                                                 ->take(10)
                                                 ->get();
        //nhapnhieu
        $purchase_a_lots = DB::table('consignments')->select(
                                                        'product_id',
                                                        DB::raw('SUM(qty) as qty'),
                                                        DB::raw('SUM(purchase_price*qty) as money')
                                                    )
                                                    ->groupBy('product_id')
                                                    ->orderBy('money', 'desc')
                                                    ->take(10)
                                                    ->get();
        //muanhieu
        // $buy_a_lots = DB::table('orders')->where('order_status_id',4)
        //                                  ->select(
        //                                     'customer_id',
        //                                     DB::raw('COUNT(customer_id) as order'),
        //                                     DB::raw('SUM(order_total) as money')
        //                                  )
        //                                  ->groupBy('customer_id')
        //                                  ->orderBy('money', 'desc')
        //                                  ->take(10)
        //                                  ->get(); 
        $buy_a_lots = "ok";

            // $muanhieu = DB::table('donhang')
            // ->where('donhang.tinhtranghd_id',4)
            // ->select(
            //     'khachhang_id',
            //     DB::raw('COUNT(khachhang_id) as donhang'),
            //     DB::raw('SUM(donhang_tong_tien) as tien')
            //     )
            // ->groupBy('khachhang_id')
            // ->orderBy('tien', 'desc')
            // ->take(10)
            // ->get(); 

    	return view('backend.dashboard',compact('newOrders','newComments','customers','products','comments','sell_a_lots','purchase_a_lots','buy_a_lots'));
    }
}
