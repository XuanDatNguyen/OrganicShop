<?php

// Route::get('/', function () {
//     return view('frontend.master');
// });

Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);


// Authentication Routes...
$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

// Registration Routes...
$this->get('register', 'Auth\AuthController@showRegistrationForm');
$this->post('register', 'Auth\AuthController@register');

// Password Reset Routes...
$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
$this->post('password/reset', 'Auth\PasswordController@reset');



// Route::get('/demo', 'HomeController@demo');

Route::get('hien-san-pham/{id}','HomeController@hiensanpham');

Route::get('/', 'HomeController@index');

Route::get('nhom-thuc-pham/{url}', 'HomeController@group');

Route::get('loai-san-pham/{url}', 'HomeController@cates');

Route::get('bai-viet', 'HomeController@article');

Route::get('tuyen-dung', 'HomeController@career');

Route::get('lien-he', 'HomeController@getContact');

Route::post('lien-he-test', 'HomeController@postContact');

Route::get('khuyen-mai', 'HomeController@promotions');

Route::get('khuyen-mai/{url}', 'HomeController@detailpromotions');

Route::get('bai-viet/{url}', 'HomeController@detailArticle');

Route::get('san-pham/{url}', 'HomeController@product');

Route::get('mua-hang/{id}/{ten}',['as'=>'muahang','uses'=>'HomeController@buyding']);

Route::get('gio-hang',['as'=>'giohang','uses'=>'HomeController@cart']);

Route::get('xoa-san-pham/{id}',['as'=>'xoasanpham','uses'=>'HomeController@deleteProduct']);

Route::get('cap-nhat-san-pham/{id}/{qty}',['as'=>'capnhat','uses'=>'HomeController@updateProduct']);

Route::get('thanh-toan',['as'=>'getThanhtoan','uses'=>'HomeController@getCheckin']);

Route::post('thanh-toan',['as'=>'postThanhtoan','uses'=>'HomeController@postCheckin']);

Route::post('binh-luan',['as'=>'postBinhluan','uses'=>'HomeController@postComment']);

Route::get('ket-qua-tim-kiem',['as'=>'getTimkiem','uses'=>'HomeController@getFind']);

Route::post('ket-qua-tim-kiem',['as'=>'postTimkiem','uses'=>'HomeController@postFind']);
// Route::post('khach-hang',['as'=>'postKhachhang','uses'=>'AuthController@postCustomer']);

// Route Backend
Route::group(['prefix' => 'admin'], function() {
    Route::get('tong-quan', ['as'=>'admin.index','uses'=>'AdminController@index']);
    Route::group(['prefix' => 'loaisanpham'], function() {
    	Route::get('danhsach',['as'=>'admin.category.index','uses'=>'CategoryController@getList']);
        Route::get('them',['as'=>'admin.category.getAdd','uses'=>'CategoryController@getAdd']);
        Route::post('them',['as'=>'admin.category.postAdd','uses'=>'CategoryController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.category.getDelete','uses'=>'CategoryController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.category.getEdit','uses'=>'CategoryController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.category.postEdit','uses'=>'CategoryController@postEdit']);
    });

    Route::group(['prefix' => 'nhom'], function() {
        Route::get('danhsach',['as'=>'admin.group.index','uses'=>'GroupController@getList']);
        Route::get('them',['as'=>'admin.nhom.getAdd','uses'=>'GroupController@getAdd']);
        Route::post('them',['as'=>'admin.nhom.postAdd','uses'=>'GroupController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.nhom.getDelete','uses'=>'GroupController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.nhom.getEdit','uses'=>'GroupController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.nhom.postEdit','uses'=>'GroupController@postEdit']);
    });

    Route::group(['prefix' => 'donvi'], function() {
        Route::get('danhsach',['as'=>'admin.unit.index','uses'=>'UnitController@getList']);
        Route::get('them',['as'=>'admin.unit.getAdd','uses'=>'UnitController@getAdd']);
        Route::post('them',['as'=>'admin.unit.postAdd','uses'=>'UnitController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.unit.getDelete','uses'=>'UnitController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.unit.getEdit','uses'=>'UnitController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.unit.postEdit','uses'=>'UnitController@postEdit']);
    });

    Route::group(['prefix' => 'lohang'], function() {
        Route::get('danhsach',['as'=>'admin.consignment.index','uses'=>'ConsignmentController@getList']);
        Route::get('them',['as'=>'admin.consignment.getAdd','uses'=>'ConsignmentController@getAdd']);
        Route::post('them',['as'=>'admin.consignment.postAdd','uses'=>'ConsignmentController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.consignment.getDelete','uses'=>'ConsignmentController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.consignment.getEdit','uses'=>'ConsignmentController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.consignment.postEdit','uses'=>'ConsignmentController@postEdit']);
        Route::get('nhap-hang/{id}',['as'=>'admin.consignment.getNhaphang','uses'=>'ConsignmentController@getNhaphang']);
        Route::post('nhap-hang/{id}',['as'=>'admin.consignment.postNhaphang','uses'=>'ConsignmentController@postNhaphang']);
    });

    Route::group(['prefix' => 'nhacungcap'], function() {
    	Route::get('danhsach',['as'=>'admin.vendor.index','uses'=>'VendorController@getList']);
        Route::get('them',['as'=>'admin.vendor.getAdd','uses'=>'VendorController@getAdd']);
        Route::post('them',['as'=>'admin.vendor.postAdd','uses'=>'VendorController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.vendor.getDelete','uses'=>'VendorController@getDelete']);
        Route::post('xoa/{id}',['as'=>'admin.vendor.postDelete','uses'=>'VendorController@postDelete']);
        Route::get('sua/{id}',['as'=>'admin.vendor.getEdit','uses'=>'VendorController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.vendor.postEdit','uses'=>'VendorController@postEdit']);
    });


    Route::group(['prefix' => 'khachhang'], function() {
        Route::get('danhsach',['as'=>'admin.customer.index','uses'=>'CustomerController@getList']);
        Route::get('them',['as'=>'admin.customer.getAdd','uses'=>'CustomerController@getAdd']);
        Route::post('them',['as'=>'admin.customer.postAdd','uses'=>'CustomerController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.customer.getDelete','uses'=>'CustomerController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.customer.getEdit','uses'=>'CustomerController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.customer.postEdit','uses'=>'CustomerController@postEdit']);
        Route::get('xem-lich-su-mua-hang/{id}',['as'=>'admin.customer.getHistory','uses'=>'CustomerController@getHistory']);
    });

    Route::group(['prefix' => 'baiviet'], function() {
        Route::get('danhsach',['as'=>'admin.article.index','uses'=>'ArticleController@getList']);
        Route::get('them',['as'=>'admin.article.getAdd','uses'=>'ArticleController@getAdd']);
        Route::post('them',['as'=>'admin.article.postAdd','uses'=>'ArticleController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.article.getDelete','uses'=>'ArticleController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.article.getEdit','uses'=>'ArticleController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.article.postEdit','uses'=>'ArticleController@postEdit']);
        Route::get('them-nguyen-lieu',['as'=>'admin.article.getAddMaterial','uses'=>'ArticleController@getAddMaterial']);
        Route::post('them-nguyen-lieu',['as'=>'admin.article.postAddMaterial','uses'=>'ArticleController@postAddMaterial']);
        Route::get('sua-nguyen-lieu/{id}',['as'=>'admin.article.getEditMaterial','uses'=>'ArticleController@getEditMaterial']);
        Route::post('sua-nguyen-lieu/{id}',['as'=>'admin.article.postEditMaterial','uses'=>'ArticleController@postEditMaterial']);
        Route::post('ds-nguyen-lieu/{id}',['as'=>'admin.article.listMat','uses'=>'ArticleController@listMat']);
    });

    Route::group(['prefix' => 'nhanvien'], function() {
        Route::get('danhsach',['as'=>'admin.nhanvien.list','uses'=>'NhanvienController@getList']);
        Route::get('them',['as'=>'admin.nhanvien.getAdd','uses'=>'NhanvienController@getAdd']);
        Route::post('them',['as'=>'admin.nhanvien.postAdd','uses'=>'NhanvienController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.nhanvien.getDelete','uses'=>'NhanvienController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.nhanvien.getEdit','uses'=>'NhanvienController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.nhanvien.postEdit','uses'=>'NhanvienController@postEdit']);
    });

    Route::group(['prefix' => 'sanpham'], function() {
        Route::get('danhsach',['as'=>'admin.product.index','uses'=>'ProductController@getList']);
        Route::get('them',['as'=>'admin.product.getAdd','uses'=>'ProductController@getAdd']);
        Route::post('them',['as'=>'admin.product.postAdd','uses'=>'ProductController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.product.getDelete','uses'=>'ProductController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.product.getEdit','uses'=>'ProductController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.product.postEdit','uses'=>'ProductController@postEdit']);
        Route::get('xoahinh/{id}',['as'=>'admin.product.delImage','uses'=>'ProductController@delImage']);
    });

    Route::group(['prefix' => 'khuyenmai'], function() {
        Route::get('danhsach',['as'=>'admin.khuyenmai.list','uses'=>'KhuyenmaiController@getList']);
        Route::get('them',['as'=>'admin.khuyenmai.getAdd','uses'=>'KhuyenmaiController@getAdd']);
        Route::post('them',['as'=>'admin.khuyenmai.postAdd','uses'=>'KhuyenmaiController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.khuyenmai.getDelete','uses'=>'KhuyenmaiController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.khuyenmai.getEdit','uses'=>'KhuyenmaiController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.khuyenmai.postEdit','uses'=>'KhuyenmaiController@postEdit']);
        Route::get('them-san-pham-km',['as'=>'admin.khuyenmai.getAddPromotion','uses'=>'KhuyenmaiController@getAddPromotion']);
        Route::post('them-san-pham-km',['as'=>'admin.khuyenmai.postAddPromotion','uses'=>'KhuyenmaiController@postAddPromotion']);
        Route::get('sua-san-pham-km/{id}',['as'=>'admin.khuyenmai.getEditPromotion','uses'=>'KhuyenmaiController@getEditPromotion']);
        Route::post('sua-san-pham-km/{id}',['as'=>'admin.khuyenmai.postEditPromotion','uses'=>'KhuyenmaiController@postEditPromotion']);
    });

    Route::group(['prefix' => 'binhluan'], function() {
        Route::get('danhsach',['as'=>'admin.binhluan.list','uses'=>'BinhluanController@getList']);
        Route::get('xoa/{id}',['as'=>'admin.binhluan.getDelete','uses'=>'BinhluanController@getDelete']);
        Route::get('chap-nhan/{id}',['as'=>'admin.binhluan.getEdit','uses'=>'BinhluanController@getEdit']);
        Route::get('khong-chap-nhan/{id}',['as'=>'admin.binhluan.getEdit1','uses'=>'BinhluanController@getEdit1']);
    });

    Route::group(['prefix' => 'donhang'], function() {
        Route::get('danhsach',['as'=>'admin.donhang.list','uses'=>'DonhangController@getList']);
        Route::get('xem-don-hang/{id}',['as'=>'admin.donhang.getEdit','uses'=>'DonhangController@getEdit']);
        Route::post('xem-don-hang/{id}',['as'=>'admin.donhang.postEdit','uses'=>'DonhangController@postEdit']);
        Route::get('sua-thong-tin-giao-hang/{id}',['as'=>'admin.donhang.getEdit1','uses'=>'DonhangController@getEdit1']);
        Route::post('sua-thong-tin-giao-hang/{id}',['as'=>'admin.donhang.postEdit1','uses'=>'DonhangController@postEdit1']);
        Route::get('sua-thong-tin-thanh-toan/{id}',['as'=>'admin.donhang.getEdit2','uses'=>'DonhangController@getEdit2']);
        Route::post('sua-thong-tin-thanh-toan/{id}',['as'=>'admin.donhang.postEdit2','uses'=>'DonhangController@postEdit2']);
        Route::get('in-hoa-don/{id}',['as'=>'admin.donhang.pdf','uses'=>'DonhangController@pdf']);
    });

    Route::group(['prefix' => 'thongke'], function() {
        Route::get('tong-quan',['as'=>'admin.thongke.list','uses'=>'ThongkeController@getList']);
        Route::get('san-pham-nhap-vao',['as'=>'admin.thongke.nhapvao','uses'=>'ThongkeController@getNhapvao']);
        Route::get('san-pham-ban-ra',['as'=>'admin.thongke.banra','uses'=>'ThongkeController@getBanra']);
        Route::get('san-pham-hien-co',['as'=>'admin.thongke.hienco','uses'=>'ThongkeController@getHienco']);
        Route::get('san-pham-doi-tra',['as'=>'admin.thongke.doitra','uses'=>'ThongkeController@getDoitra']);
        Route::get('san-pham-ban-chay',['as'=>'admin.thongke.banchay','uses'=>'ThongkeController@getBanchay']);
        Route::get('san-pham-ton-nhieu',['as'=>'admin.thongke.tonnhieu','uses'=>'ThongkeController@getTonnhieu']);
        Route::get('san-pham-het-han',['as'=>'admin.thongke.hethan','uses'=>'ThongkeController@getHethan']);
        Route::get('san-pham-con-han',['as'=>'admin.thongke.conhan','uses'=>'ThongkeController@getConhan']);
    });

    Route::group(['prefix' => 'quangcao'], function() {
        Route::get('danhsach',['as'=>'admin.banner.index','uses'=>'BannerController@getList']);
        Route::get('them',['as'=>'admin.banner.getAdd','uses'=>'BannerController@getAdd']);
        Route::post('them',['as'=>'admin.banner.postAdd','uses'=>'BannerController@postAdd']);
        Route::get('xoa/{id}',['as'=>'admin.banner.getDelete','uses'=>'BannerController@getDelete']);
        Route::get('sua/{id}',['as'=>'admin.banner.getEdit','uses'=>'BannerController@getEdit']);
        Route::post('sua/{id}',['as'=>'admin.banner.postEdit','uses'=>'BannerController@postEdit']);
        Route::get('cap-nhat/{id}/{status}',['as'=>'admin.banner.getChange','uses'=>'BannerController@getChange']);
    });
});

// Password reset link request routes...
Route::get('admin/login',['as'=>'admin.login.getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('admin/login',['as'=>'admin.login.postLogin','uses'=>'Auth\AuthController@postLogin']);
Route::get('admin/logout',['as'=>'admin.login.getLogout','uses'=>'Auth\AuthController@logout']);

