@extends('frontend.master')
@section('content')
<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <div>
        <div class="top-bn">
            <div class="overlay">
                <h2 style="color: #fff; text-align: center; font-size: 4rem; line-height: 300px ">{!! $group->name !!}
                </h2>
            </div>
        </div>
    </div>
</section>
<!-- / catg header banner section -->
<!-- product category -->
<section id="aa-product-category">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                <div class="aa-product-catg-content">
                    @include('frontend.blocks.head')
                    <div class="aa-product-catg-body">
                        <ul class="aa-product-catg">
                            <!-- start single product item -->
                            @foreach ($product as $item)

                            <li>
                                <figure>
                                    <a class="aa-product-img" href="{!! url('san-pham',$item->slug) !!}"><img
                                            src="{!! asset('images/products/'.$item->image) !!}"
                                            style="width: 250px; height: 300px;"></a>
                                    <a class="aa-add-card-btn"
                                        href="{!! url('mua-hang',[$item->id,$item->slug]) !!}"><span
                                            class="fa fa-shopping-cart"></span>Mua ngay</a>
                                    <figcaption>
                                        <h4 class="aa-product-title"><a href="{!! url('san-pham',$item->slug) !!}">{!!
                                                $item->name !!}</a></h4>
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
                                        <span class="aa-badge aa-sold-out">Khuyến mại {!! $x !!}%</span>
                                        <span class="aa-product-price">

                                            {!! number_format($gia_km,0,",",".") !!} vnđ
                                        </span>
                                        <span class="aa-product-price">
                                            <del>{!! number_format("$item->sale_price",0,",",".") !!} vnđ</del>
                                        </span>
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
                    <!-- pagination -->

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span>{!! $product->links() !!}</span>
                        </div>
                    </div>

                    <!-- /pagination -->
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                <aside class="aa-sidebar">
                    <!-- sidebar  1 -->

                    @include('frontend.blocks.hot_product')
                    <!-- sidebar 2 -->

                </aside>
            </div>

        </div>
    </div>
</section>
<!-- / product category -->
<!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@endsection