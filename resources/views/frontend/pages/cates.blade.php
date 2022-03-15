@extends('frontend.master')
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <div>
      <div class="top-bn">
        <div class="overlay">
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
                    <a class="aa-product-img" href="{!! url('san-pham',$item->slug) !!}"><img src="{!! asset('images/products/'.$item->image) !!}"  style="width: 250px; height: 300px;"></a>
                    <a class="aa-add-card-btn" href="{!! url('mua-hang',[$item->id,$item->slug]) !!}"><span class="fa fa-shopping-cart"></span>Mua ngay</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="{!! url('san-pham',$item->slug) !!}">{!! $item->name !!}</a></h4>
                      <input type="hidden" name="txtqty" value="1" />
                      @if ($item->is_promotion == 1) 
                       <!-- product badge -->
                       

                    <span class="aa-badge aa-sold-out" >Khuyến mãi!</span>
                    <span class="aa-product-price">
                     <?php 
                        $tylegia = DB::select('select percent from products as sp, promotional_products as spkm, promotions as km where sp.id = spkm.product_id and spkm.promotion_id = km.id and sp.is_promotion = 1 and km.status = 1 ');
                       $giakm = ($item->sale_price - ($tylegia[0]->percent*$item->sale_price * 0.01));
                       $tyle = $tylegia[0]->percent*0.01;
                      ?> 
                      
                        {!! number_format($giakm,0,",",".") !!} vnđ
                    </span>
                    <span class="aa-product-price">
                    <del>{!! number_format("$item->sale_price",0,",",".") !!} vnđ</del>
                    </span> 
                     <input type="hidden" name="txtopt" value="{!! $tyle !!}" /> 
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
            @include('frontend.blocks.pagination')
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
@stop