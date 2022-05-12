<?php

namespace App\Http\Controllers;

use DB;


class AdminController extends Controller
{
    public function index()
    {
    	$newOrders   = DB::table('orders')->where('order_status_id',1)->count();
    	$newComments = DB::table('comments')->where('status',0)->count();
    	$customers   = DB::table('customers')->count();
    	$products    = DB::table('products')->count();
    	// $comments    = DB::table('comments')->where('status',0)->get();

    	
    	return view('backend.dashboard',compact('newOrders','newComments','customers','products'));
    }
}
