<?php

namespace App\Http\Controllers;

use App\Http\Requests;
//use Illuminate\Http\Request;
use DB,Cart,Request,Mail;
use App\Donhang;
use App\Binhluan;
use App\Chitietdonhang;
use App\Http\Requests\ThanhtoanRequest;
use App\Http\Requests\BinhluanRequest;
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
    public function demo()
    {
        $data = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','lohang.lohang_gia_ban_ra')
                ->groupBy('sanpham.id')
            ->get();
        // $idLHM = Db::table('lohang')->where('sanpham_id',$val->sanpham_id)->max('id');
            print_r($data);
    }



    public function index()
    {
        $loaisp =  DB::table('loaisanpham')->get();
        $sanpham = DB::table('sanpham')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','lohang.lohang_gia_ban_ra')
                ->groupBy('sanpham.id')
                ->orderBy('id','DESC')
            ->paginate(16);
        // print_r($loaisp);
        return view ('frontend.pages.home',compact('loaisp','sanpham'));
    }
    public function group($url)
    {
        $id = DB::table('nhom')->select('id')->where('nhom_url',$url)->first();
        $i = $id->id;
        $id = DB::table('loaisanpham')->select('id')->where('nhom_id',$i)->get();
        foreach ($id as $key => $val) {
            $ids[] = $val->id;
        }
        $nhom = DB::table('nhom')->where('id',$i)->first();
        $sanpham = DB::table('sanpham')
            ->whereIn('sanpham.loaisanpham_id',$ids)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','lohang.lohang_gia_ban_ra')
            ->groupBy('sanpham.id')
            ->paginate(4);
        return view('frontend.pages.group',compact('sanpham','nhom'));
    }

    public function cates($url)
    {
        $idLSP = DB::table('loaisanpham')->select('id')->where('loaisanpham_url',$url)->first();
        $i = $idLSP->id;
        $loaisanpham = DB::table('loaisanpham')->where('id',$i)->first();
        $sanpham = DB::table('sanpham')
            ->where('sanpham.loaisanpham_id',$i)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','lohang.lohang_gia_ban_ra')
                ->groupBy('sanpham.id')
            ->paginate(15);
        $nhom = DB::table('nhom')->where('id',$loaisanpham->nhom_id)->first();
        return view('frontend.pages.cates',compact('sanpham','loaisanpham','nhom'));
    }

    public function article()
    {
        $bai_viet = DB::table('monngon')->paginate(9);
        return view ('frontend.pages.baiviet',compact('bai_viet'));
    }

    public function detailArticle($url)
    {
        $bai_viet = DB::table('monngon')->where('monngon_url',$url)->first();
        $id = DB::table('monngon')->select('id')->where('monngon_url',$url)->first();
        $id = $id->id;
        // print_r($i);
        $nguyen_lieu = DB::table('nguyenlieu')->where('monngon_id',$id)->get();
        // print_r($nglieu);
        return view ('frontend.pages.chitietbaiviet',compact('bai_viet','nguyen_lieu'));
    }

    public function getContact()
    {
        return view ('frontend.pages.contact');
    }

    public function postContact(Request $request)
    {
        $data = ['mail'=>Request::input('txtMail'),'name'=>Request::input('txtName'),'content'=>Request::input('txtContent')];
        $f_data = ['mail'=>'test@gmail.com', 'name'=>'test', 'content'=>'content'];
        Mail::send('auth.emails.layoutmail', $f_data, function ($message) {
            $message->from('0rganicshop.cskh@gmail.com', 'Kh??ch h??ng');
        
            $message->to('nguyenxuandat.bqp@gmail.com', 'Admin');
        
            $message->subject('Mail li??n h???!!!');
        });

        echo "<script>
         alert('C???m ??n b???n ???? g??p ??! Ch??ng t??i s??? li??n h??? v???i b???n trong th???i gian s???m nh???t');
         window.location='".url('/')."'
        </script>";
    }

    public function testSendEmail() {

        Mail::send('auth.emails.layoutmail', ['name' => 'test'], function($message) {
            $message->from('0rganicshop.cskh@gmail.com');
        
            $message->to('nguyenxuandat.bqp@gmail.com');
        
            $message->subject('Mail li??n h???!!!');
        });
    }

    public function promotions()
    {
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_tinh_trang',1)->first();
        if (!is_null($khuyenmai)) {
            $spham = DB::table('sanphamkhuyenmai')
            ->where('khuyenmai_id',$khuyenmai->id)
            ->get();
        } else {
            $spham = Null;
        }
        // print_r($km_old);
        return view ('frontend.pages.promotion',compact('khuyenmai','spham'));
    }

    public function detailpromotions($url)
    {
        $khuyenmai = DB::table('khuyenmai')->where('khuyenmai_url',$url)->first();
        $id = DB::table('khuyenmai')->select('id')->where('khuyenmai_url',$url)->first();
        $id = $id->id;
        // print_r($i);
        $spham = DB::table('sanphamkhuyenmai')
            ->where('khuyenmai_id',$id)
            ->get();
        //$spham = DB::table('sanpham')->whereIn('id',$sphamid)->get();
        //print_r($spham);
        return view ('frontend.pages.detailpromotion',compact('khuyenmai','spham'));
    }

    public function career()
    {
        $tuyendung = DB::table('tuyendung')->where('tuyendung_tinh_trang',1)->first();
        // print_r($tuyendung);
        return view('frontend.pages.career',compact('tuyendung'));
    }

    public function product($url)
    {
        $idLSP = DB::table('sanpham')->select('id')->where('sanpham_url',$url)->first();
        $id = $idLSP->id;
        $sanpham = DB::table('sanpham')
            ->where('sanpham.id',$id)
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->join('donvitinh','sanpham.donvitinh_id', '=', 'donvitinh.id' )
            ->join('loaisanpham','sanpham.loaisanpham_id' , '=', 'loaisanpham.id')
            ->select(DB::raw('max(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','lohang.lohang_gia_ban_ra','donvitinh.donvitinh_ten','loaisanpham.loaisanpham_ten','sanpham.loaisanpham_id','sanpham.sanpham_anh','sanpham.sanpham_mo_ta')
            ->groupBy('sanpham.id')
            ->first();
        
        $hinhsanpham = DB::table('hinhsanpham')->where('sanpham_id',$id)->get();
        $loaisanpham = DB::table('loaisanpham')->where('id',$sanpham->loaisanpham_id)->first();
        $nhom = DB::table('nhom')->where('id',$loaisanpham->nhom_id)->first();
        $binhluan = DB::table('binhluan')->where([['sanpham_id',$id],['binhluan_trang_thai',1],])->get();
        return view('frontend.pages.detailpro',compact('sanpham','hinhsanpham','loaisanpham','nhom','binhluan'));
        // print_r($loaisanpham);
    }

    public function buyding(Request $request,$id)
    {
        // print_r($id);
        $sanpham = DB::select('select * from sanpham where id = ?',[$id]);
        // print_r($sanpham);
        if ($sanpham[0]->sanpham_khuyenmai == 1) {
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten,lh.lohang_ky_hieu, lh.lohang_gia_ban_ra, sp.id, km.khuyenmai_phan_tram from sanpham as sp, lohang as lh, nhacungcap as ncc, sanphamkhuyenmai as spkm, khuyenmai as km  where km.khuyenmai_tinh_trang = 1 and sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and sp.id = ?', [$id]);
            $giakm = $muasanpham[0]->lohang_gia_ban_ra - $muasanpham[0]->lohang_gia_ban_ra*$muasanpham[0]->khuyenmai_phan_tram*0.01;
            print_r($giakm);
            Cart::add(array( 'id' => $muasanpham[0]->id, 'name' => $muasanpham[0]->sanpham_ten, 'qty' => 1, 'price' => $giakm));
        } else {
            $muasanpham = DB::select('select sp.id,sp.sanpham_ten,lh.lohang_ky_hieu, lh.lohang_gia_ban_ra from sanpham as sp, lohang as lh, nhacungcap as ncc  where ncc.id = lh.nhacungcap_id and lh.sanpham_id = sp.id and sp.id = ?',[$id]);
            $gia = $muasanpham[0]->lohang_gia_ban_ra;
            Cart::add(array( 'id' => $muasanpham[0]->id, 'name' => $muasanpham[0]->sanpham_ten, 'qty' => 1, 'price' => $gia));
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
            die($qty);
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

    public function postCheckin(ThanhtoanRequest $request)
    {
        $content = Cart::content();
        $total = Cart::total();

        $donhang = new Donhang;
        $donhang->donhang_nguoi_nhan = $request->txtNNName;
        $donhang->donhang_nguoi_nhan_email = $request->txtNNEmail;
        $donhang->donhang_nguoi_nhan_sdt = $request->txtNNPhone;
        $donhang->donhang_nguoi_nhan_dia_chi = $request->txtNNAddr;
        $donhang->donhang_ghi_chu = $request->txtNNNote;
        $donhang->donhang_tong_tien = $total;
        $donhang->khachhang_id = $request->txtKHID;
        $donhang->tinhtranghd_id = 1;
        $donhang->save();

        foreach ($content as $item) {
            $detail = new Chitietdonhang;
            $detail->sanpham_id = $item->id;
            $detail->donhang_id = $donhang->id;
            $detail->chitietdonhang_so_luong = $item->qty;
            $detail->chitietdonhang_thanh_tien = $item->price*$item->qty;
            $detail->save();
        }
       
        Cart::destroy();
        echo "<script>
          alert('B???n ???? ?????t mua s???n ph???m th??nh c??ng!');
          window.location = '".url('/')."';</script>";
    }

    public function postComment(BinhluanRequest $request)
    {
        $binhluan = new Binhluan;
        $binhluan->binhluan_ten = $request->txtName;
        $binhluan->binhluan_email = $request->txtEmail;
        $binhluan->binhluan_noi_dung = $request->txtContent;
        $binhluan->binhluan_trang_thai = 0;
        $binhluan->sanpham_id = $request->txtID;
        $binhluan->save();
         echo "<script>
          alert('C???m ??n b???n ???? g??p ??!');
          window.location = '".url('/')."';</script>";
    }

    public function getFind()
    {

        return view('frontend.pages.product');
    }

    public function postFind()
    {
        $keyword = Request::input('txtSearch');
        $slug = Replace_TiengViet($keyword);
        // $keyword = Request::input('txtSearch');
        $sanpham = DB::table('sanpham')
            ->where('sanpham_ten','like', '%'.$keyword.'%')
            ->join('lohang', 'sanpham.id', '=', 'lohang.sanpham_id')
            ->select(DB::raw('max(lohang.id) as lomoi'),'sanpham.id','sanpham.sanpham_ten','sanpham.sanpham_url','sanpham.sanpham_khuyenmai','sanpham.sanpham_anh', 'lohang.lohang_so_luong_nhap','lohang.lohang_so_luong_hien_tai','lohang.lohang_gia_ban_ra')
                ->groupBy('sanpham.id')
            ->paginate(15);
        $so_luong = $sanpham->total();
        return view('frontend.pages.product',compact('sanpham', 'keyword', 'so_luong'));
    }
}
