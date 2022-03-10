@extends('frontend.master')
@section('content')
<!-- Start slider -->
@include('frontend.blocks.slide')
<!-- / slider -->
  <!-- Products section -->
  <div class="row" style="margin-top: 30px" ">
    <div class="col-12">
      <section id="aa-product">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="aa-product-area">
                  <div class="aa-product-inner">
                    <ul class="nav nav-tabs aa-products-tab">
                          <h2>Sản phẩm mới</h2>
                        </ul>
                      <div class="tab-content">
                        <!-- Start men product category -->
                        <div class="tab-pane fade in active" >
                          <ul class="aa-product-catg">
                            <!-- start single product item -->
                            @foreach ($sanpham as $item)
                              <?php 
                                $sanphamkhuyenmai = DB::select('select* from sanpham as sp, sanphamkhuyenmai as spkm, khuyenmai as km where sp.id = spkm.sanpham_id and spkm.khuyenmai_id = km.id and sp.sanpham_khuyenmai = 1 and km.khuyenmai_tinh_trang = 1');
                              ?>
                              <li>
                                <figure>
                                  <a class="aa-product-img" href="{!! url('san-pham',$item->sanpham_url) !!}"><img src="{!! asset('images/sanpham/' . $item->sanpham_anh) !!}" style="width: 250px; heigh: 300px" ></a>
                                  <a class="aa-add-card-btn" href="{!! url('mua-hang',[$item->id,$item->sanpham_url]) !!}"><span class="fa fa-shopping-cart"></span>Mua ngay</a>
                                  <figcaption>
                                    <h4 class="aa-product-title"><a href="{!! url('san-pham',$item->sanpham_url) !!}">{!! $item->sanpham_ten !!}</a></h4>
                                    <input type="hidden" name="txtqty" value="1" />
                                    @if ($item->sanpham_khuyenmai == 1) 
                                    <!-- product badge -->
                                    <?php 
                                      $ty_le_gia = DB::select('SELECT sanpham.id, khuyenmai.khuyenmai_phan_tram 
                                                            FROM `sanphamkhuyenmai` 
                                                            INNER JOIN sanpham 
                                                              ON sanpham.id = sanphamkhuyenmai.sanpham_id 
                                                            INNER JOIN khuyenmai 
                                                              ON khuyenmai.id = sanphamkhuyenmai.khuyenmai_id 
                                                            WHERE sanpham.sanpham_khuyenmai = 1 AND khuyenmai.khuyenmai_tinh_trang = 1');
                                        foreach($ty_le_gia as $phan_tram) {
                                          if($item->id == $phan_tram->id) {
                                            $gia_km = ($item->lohang_gia_ban_ra - ($item->lohang_gia_ban_ra*$phan_tram->khuyenmai_phan_tram*0.01));
                                            $x = $phan_tram->khuyenmai_phan_tram;
                                          }
                                        } 
                                      ?> 
                                    <span class="aa-badge aa-sold-out" >Giảm {!! $x  !!}%!</span>
                                    <span class="aa-product-price">
                                    
                                      {!! number_format($gia_km,0,",",".") !!} vnđ
                                  </span>
                                  <span class="aa-product-price">
                                  <del>{!! number_format("$item->lohang_gia_ban_ra",0,",",".") !!} vnđ</del>
                                  </span> 
                                  <input type="hidden" name="txtopt" value="" /> 
                                  @else
                                      <span class="aa-product-price">
                                      {!! number_format("$item->lohang_gia_ban_ra",0,",",".") !!} vnđ
                                      </span>
                                      <input type="hidden" name="txtopt" value="1" /> 
                                  @endif
                                    </figcaption>
                                </figure>
                              </li>
                               
                            @endforeach
                          </ul>
                        </div>
                        <!-- / men product category -->
                      </div>            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- / Products section -->
<!-- Support section -->
@include('frontend.blocks.trans')
<!-- / Support section -->
<!-- Latest Blog -->
@include('frontend.blocks.news')
<!-- / Latest Blog -->
<!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@stop

