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
    	$newOrders = DB::table('orders')->where('order_status_id',1)->count();
    	$newComments = DB::table('comments')->where('status',0)->count();
    	$customers = DB::table('customers')->count();
    	$products = DB::table('products')->count();
    	$comments = DB::table('comments')->where('status',0)->get();
    	$sell_a_lots = DB::table('order_details')
        //banhnhieu
                ->where('orders.order_status_id',4)
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
                // print_r($bannhieu);
        $purchase_a_lots = DB::table('consignments')
        //nhapnhieu
                ->select(
                    'product_id',
                    DB::raw('SUM(qty) as qty'),
                    DB::raw('SUM(purchase_price*qty) as money')
                    )
                ->groupBy('product_id')
                ->orderBy('money', 'desc')
                ->take(10)
                ->get();
        //muanhieu
        $buy_a_lots = DB::table('orders')
                ->where('orders.order_status_id',4)
                ->select(
                    'customer_id',
                    DB::raw('COUNT(customer_id) as order'),
                    DB::raw('SUM(order_total) as money')
                    )
                ->groupBy('customer_id')
                ->orderBy('money', 'desc')
                ->take(10)
                ->get(); 
        // print_r($nhapnhieu);
    	// return view('backend.dashboard',compact('donhang','binhluan','khachhang','sanpham','luotbinhluan','bannhieu','nhapnhieu','muanhieu'));
    	return view('backend.dashboard',compact('newOrders','binhluan','khachhang','sanpham','luotbinhluan','bannhieu','nhapnhieu','muanhieu'));
    }
}
