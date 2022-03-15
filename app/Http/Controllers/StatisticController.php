<?php

namespace App\Http\Controllers;

use DB;

class StatisticController extends Controller
{
    public function getList()
    {
    	$sl = DB::table('consignments')->select(DB::raw('SUM(qty) as nhap'),
												DB::raw('SUM(sold_qty) as ban'),
												DB::raw('SUM(current_qty) as ton'),
												DB::raw('SUM(change_qty) as tra')
												)
	    							   ->get();

	    $bannhieu = DB::table('consignments')->select('product_id',
													   DB::raw('SUM(sold_qty) as ban'),
													   DB::raw('SUM(current_qty) as ton')
													  )
											 ->groupBy('product_id')
											 ->orderBy('ban', 'desc')
											 ->get();

	   	$tonnhieu = DB::table('consignments')->select('product_id',
													   DB::raw('SUM(sold_qty) as ban'),
													   DB::raw('SUM(current_qty) as ton')
	   				                                 )
											 ->groupBy('product_id')
											 ->orderBy('ton', 'desc')
											 ->get();

	   	$hethan = DB::table('consignments')->where('status',1)
											->select('product_id',
													  DB::raw('SUM(sold_qty) as ban'),
													  DB::raw('SUM(current_qty) as ton')
												    )
											->groupBy('product_id')
											->get();

	   	$conhan = DB::table('consignments')->where('status',0)
											->select('product_id',
													  DB::raw('SUM(sold_qty) as ban'),
													  DB::raw('SUM(current_qty) as ton')
													)
											->groupBy('product_id')
											->get();	

    	return view('backend.statistic.overview',compact('sl','tonnhieu','bannhieu','hethan','conhan'));
    }

    public function getNhapvao()
    {
    	$title = 'Sản phẩm nhập vào';
    	$data = DB::table('consignments')->join('products','products.id','=','consignments.product_id')
										 ->select('products.*','consignments.*')
										 ->get();
										 
	    return view('backend.statistic.sanpham',compact('data','title'));
    }

    public function getBanra()
    {
    	$title = 'Sản phẩm bán ra';
    	$data = DB::table('consignments')->where('consignments.sold_qty','>',0)
										 ->join('products','products.id','=','consignments.product_id')
										 ->select('products.*','consignments.*')
										 ->get();

	    return view('backend.statistic.sanpham',compact('data','title'));
    }

    public function getHienco()
    {
    	$title = 'Sản phẩm hiện có';
    	$data = DB::table('consignments')->where('consignments.current_qty','>',0)
										 ->join('products','products.id','=','consignments.product_id')
										 ->select('products.*','consignments.*')
										 ->get();

	    return view('backend.statistic.sanpham',compact('data','title'));
    }

    public function getDoitra()
    {
    	$title = 'Sản phẩm đổi trả';
    	$data = DB::table('consignments')->where('consignments.change_qty','>',0)
										 ->join('products','products.id','=','consignments.product_id')
										 ->select('products.*','consignments.*')
										 ->get();

	    return view('backend.statistic.sanpham',compact('data','title'));
    }

    public function getBanchay()
    {
    	$title = 'Sản phẩm bán chạy';
	    $data = DB::table('consignments')->select('product_id','sale_price','purchase_price',
												   DB::raw('SUM(qty) as nhap'),
												   DB::raw('SUM(sold_qty) as ban'),
												   DB::raw('SUM(current_qty) as ton')
												 )
										 ->groupBy('product_id')
										 ->orderBy('ban', 'desc')
										 ->get();

	    return view('backend.statistic.sanpham1',compact('data','title'));
    }

    public function getTonnhieu()
    {
    	$title = 'Sản phẩm nhập vào';
    	$data = DB::table('consignments')->select('product_id',
										           DB::raw('SUM(qty) as nhap'),
										           DB::raw('SUM(sold_qty) as ban'),
										           DB::raw('SUM(current_qty) as ton')
												 )
										 ->groupBy('product_id')
										 ->orderBy('ton', 'desc')
										 ->get();

	    return view('backend.statistic.sanpham1',compact('data','title'));
    }

    public function getHethan()
    {
    	$title = 'Sản phẩm hết hạn sử dụng';
    	$data = DB::table('consignments')->where('status',1)
										 ->select('product_id',
										 		  DB::raw('SUM(qty) as nhap'),
										 		  DB::raw('SUM(sold_qty) as ban'),
										 		  DB::raw('SUM(current_qty) as ton')
										 	    )
										 ->groupBy('product_id')
										 ->get();

	    return view('backend.statistic.sanpham1',compact('data','title'));
    }

    public function getConhan()
    {
    	$title = 'Sản phẩm còn hạn sử dụng';
    	$data = DB::table('consignments')->where('status',0)
										 ->select('product_id',
										 		  DB::raw('SUM(qty) as nhap'),
										 		  DB::raw('SUM(sold_qty) as ban'),
										 		  DB::raw('SUM(current_qty) as ton')
										 		)
										 ->groupBy('product_id')
										 ->get();
										 
	    return view('backend.statistic.sanpham1',compact('data','title'));
    }
}
