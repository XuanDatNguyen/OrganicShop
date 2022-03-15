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
                            @foreach ($product as $item)
                              
                              <li>
                                <figure>
                                  <a class="aa-product-img" href="{!! url('san-pham',$item->slug) !!}"><img src="{!! asset('images/products/' . $item->image) !!}" style="width: 250px; heigh: 300px" ></a>
                                  <a class="aa-add-card-btn" href="{!! url('mua-hang',[$item->id,$item->slug]) !!}"><span class="fa fa-shopping-cart"></span>Mua ngay</a>
                                  <figcaption>
                                    <h4 class="aa-product-title"><a href="{!! url('san-pham',$item->slug) !!}">{!! $item->name !!}</a></h4>
                                    <input type="hidden" name="txtqty" value="1" />
                                    @if ($item->is_promotion == 1) 
                                    <!-- product badge -->
                                    <?php 
                                      $ty_le_gia = DB::select('SELECT products.id, promotions.percent 
                                                            FROM `promotional_products` 
                                                            INNER JOIN products 
                                                              ON products.id = promotional_products.product_id 
                                                            INNER JOIN promotions 
                                                              ON promotions.id = promotional_products.promotion_id 
                                                            WHERE products.is_promotion = 1 AND promotions.status = 1');
                                        foreach($ty_le_gia as $phan_tram) {
                                          if($item->id == $phan_tram->id) {
                                            $gia_km = ($item->sale_price - ($item->sale_price*$phan_tram->percent*0.01));
                                            $x = $phan_tram->percent;
                                          }
                                        } 
                                      ?> 
                                    <span class="aa-badge aa-sold-out" >Giảm {!! $x  !!}%!</span>
                                    <span class="aa-product-price">
                                    
                                      {!! number_format($gia_km,0,",",".") !!} vnđ
                                  </span>
                                  <span class="aa-product-price">
                                  <del>{!! number_format("$item->sale_price",0,",",".") !!} vnđ</del>
                                  </span> 
                                  <input type="hidden" name="txtopt" value="" /> 
                                  @else
                                      <span class="aa-product-price">
                                      {!! number_format("$item->sale_price",0,",",".") !!} vnđ
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

