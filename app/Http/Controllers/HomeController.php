<?php

namespace App\Http\Controllers;

use DB,Mail;
use Cart;
use App\Donhang;
use App\Binhluan;
use App\Chitietdonhang;
use App\Comment;
use Illuminate\Support\Str;
use App\Http\Requests\ThanhtoanRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PayRequest;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $category = DB::table('categories')->get();
        $product  = DB::table('products')->join('consignments', 'products.id', '=', 'consignments.product_id')
                                         ->select(DB::raw('max(consignments.id) as lomoi'),'products.id',
                                                     'products.name','products.slug',
                                                     'products.is_promotion','products.image', 
                                                     'consignments.qty','consignments.current_qty',
                                                     'consignments.sale_price')
                                         ->groupBy('products.id')
                                         ->orderBy('id','DESC')
                                         ->paginate(16);

        return view ('frontend.pages.home',compact('category','product'));
    }

    public function group($url)
    {
        $id = DB::table('groups')->select('id')->where('slug',$url)->first();
        $i  = $id->id;
        $id = DB::table('categories')->select('id')->where('group_id',$i)->get();
        foreach ($id as $key => $val) {
            $ids[] = $val->id;
        }
        $group = DB::table('groups')->where('id',$i)->first();
        $product = DB::table('products')
            ->whereIn('products.category_id',$ids)
            ->join('consignments', 'products.id', '=', 'consignments.product_id')
            ->select(DB::raw('max(consignments.id) as lomoi'),'products.id','products.name','products.slug','products.is_promotion',
                     'products.image', 'consignments.qty','consignments.current_qty','consignments.sale_price')
            ->groupBy('products.id')
            ->paginate(4);
        return view('frontend.pages.group',compact('product','group'));
    }

    public function cates($url)
    {
        $idLSP       = DB::table('categories')->select('id')->where('slug',$url)->first();
        $i           = $idLSP->id;
        $category = DB::table('categories')->where('id',$i)->first();
        $group        = DB::table('groups')->where('id',$category->group_id)->first();
        $product     = DB::table('products')->where('products.category_id',$i)
                                            ->join('consignments', 'products.id', '=', 'consignments.product_id')
                                            ->select(DB::raw('max(consignments.id) as lomoi'),'products.id','products.name','products.slug','products.is_promotion',
                                                    'products.image', 'consignments.qty','consignments.current_qty','consignments.sale_price')
                                            ->groupBy('products.id')
                                            ->paginate(15);
        return view('frontend.pages.cates',compact('product','category','group'));
    }

    public function article()
    {
        $article = DB::table('articles')->paginate(9);

        return view ('frontend.pages.article',compact('article'));
    }

    public function detailArticle($url)
    {
        $article  = DB::table('articles')->where('slug',$url)->first();
        $id       = DB::table('articles')->select('id')->where('slug',$url)->first();
        $id       = $id->id;
        $resource = DB::table('resources')->where('article_id',$id)->get();

        return view ('frontend.pages.detail_article',compact('article','resource'));
    }

    public function getContact()
    {
        return view ('frontend.pages.contact');
    }

    public function postContact(Request $request)
    {
       
    }



    public function product($url)
    {
        $idLSP = DB::table('products')->select('id')->where('slug',$url)->first();
        $id = $idLSP->id;

        $product = DB::table('products')->where('products.id',$id)
                                        ->join('consignments', 'products.id', '=', 'consignments.product_id')
                                        ->join('units','products.unit_id', '=', 'units.id' )
                                        ->join('categories','products.category_id' , '=', 'categories.id')
                                        ->select(DB::raw('max(consignments.id) as lomoi'),'products.id','products.name',
                                                 'products.slug','products.is_promotion','products.image', 'consignments.qty',
                                                 'consignments.current_qty','consignments.sale_price','units.name as unit','categories.name',
                                                 'products.category_id','products.image','products.description'
                                                 )
                                        ->groupBy('products.id')
                                        ->first();
        $category = DB::table('categories')->where('id',$product->category_id)->first();
        $group = DB::table('groups')->where('id',$category->group_id)->first();
        $comment = DB::table('comments')->where([['product_id',$id],['status',1],])->get();
        return view('frontend.pages.detail_product',compact('product','category','group','comment'));
    }

    public function buyding(Request $request,$id)
    {
        // print_r($id);
        $product = DB::select('select * from products where id = ?',[$id]);
        // print_r($product);
        if ($product[0]->is_promotion == 1) {
            $muasanpham = DB::select('select sp.id,sp.name, lh.sale_price, sp.id, km.percent from products as sp, consignments as lh, vendors as ncc, promotional_products as spkm, promotions as km  where km.status = 1 and sp.id = spkm.product_id and spkm.promotion_id = km.id and ncc.id = lh.vendor_id and lh.product_id = sp.id and sp.id = ?', [$id]);
            $giakm = $muasanpham[0]->sale_price - $muasanpham[0]->sale_price*$muasanpham[0]->percent*0.01;
            print_r($giakm);
            Cart::add(array( 'id' => $muasanpham[0]->id, 'name' => $muasanpham[0]->name, 'qty' => 1, 'price' => $giakm));
        } else {
            $muasanpham = DB::select('select sp.id,sp.name, lh.sale_price from products as sp, consignments as lh, vendors as ncc  where ncc.id = lh.vendor_id and lh.product_id = sp.id and sp.id = ?',[$id]);
            $gia = $muasanpham[0]->sale_price;
            Cart::add(array( 'id' => $muasanpham[0]->id, 'name' => $muasanpham[0]->name, 'qty' => 1, 'price' => $gia));
        }
        $content = Cart::content();
        // print_r($content);
        return redirect()->route('giohang');
    }

    public function cart()
    {
        $content = Cart::content();
        //print_r($content);
        $total = Cart::total();
        return view('frontend.pages.cart',compact('content','total'));
    }

    public function deleteProduct($id)
    {
        Cart::remove($id);
        return redirect()->route('giohang');
    }

    public function updateProduct()
    {
        if(Request::ajax()) {
            $id = Request::get('id');
            $qty = Request::get('qty');
            Cart::update($id,$qty);
            echo "oke";
        }
    }

    public function getCheckin()
    {
        $content = Cart::content();
        // print_r($content);
        $total = Cart::total();
        // echo "string";
        // print_r($total);
        return view('frontend.pages.checkin',compact('content','total'));
    }

    public function postCheckin(PayRequest $request)
    {
        $content = Cart::content();
        $total = Cart::total();

        $order = new Order();
        $order->recipient = $request->txtNNName;
        $order->recipient_email = $request->txtNNEmail;
        $order->recipient_phone = $request->txtNNPhone;
        $order->recipient_address = $request->txtNNAddr;
        $order->order_note = $request->txtNNNote;
        $order->order_total = $total;
        $order->customer_id = $request->txtKHID;
        $order->order_status_id = 1;
        $order->save();

        foreach ($content as $item) {
            $detail = new OrderDetail();
            $detail->product_id = $item->id;
            $detail->order_id = $order->id;
            $detail->qty = $item->qty;
            $detail->total_amount = $item->price*$item->qty;
            $detail->save();
        }
       
        Cart::destroy();
        echo "<script>
          alert('Bạn đã đặt mua sản phẩm thành công!');
          window.location = '".url('/')."';</script>";
    }

    public function postComment(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->name = $request->txtName;
        $comment->email = $request->txtEmail;
        $comment->content = $request->txtContent;
        $comment->status = 0;
        $comment->product_id = $request->txtID;
        $comment->save();
         echo "<script>
          alert('Cảm ơn bạn đã góp ý!');
          window.location = '".url('/')."';</script>";
    }

    public function getFind()
    {

        return view('frontend.pages.product');
    }

    public function postFind(Request $request)
    {
        $keyword = $request->txtSearch;
        $slug = Str::slug($keyword);

        $product = DB::table('products')
            ->where('name','like', '%'.$keyword.'%')
            ->join('consignments', 'products.id', '=', 'consignments.product_id')
            ->select(DB::raw('max(consignments.id) as lomoi'),'products.id','products.name','products.slug','products.is_promotion','products.image', 'consignments.qty','consignments.current_qty','consignments.sale_price')
            ->groupBy('products.id')
            ->paginate(15);
        $total = $product->total();
        return view('frontend.pages.product',compact('product', 'keyword', 'total'));
    }
}
