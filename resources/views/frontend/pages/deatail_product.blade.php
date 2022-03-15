@extends('frontend.master')
@section('content')

  <!-- catg header banner section -->
 
  <!-- <section id="aa-catg-head-banner" >
   <div class="aa-catg-head-banner-area">
     <div class="container top-bn">
      <div class="aa-catg-head-banner-content">
        <h2>{!! $products->name !!}</h2>
      </div>
     </div>
   </div>
  </section> -->
  <section id="aa-catg-head-banner">
    <div>
      <div class="top-bn">
        <div class="overlay">
          <h2 style="color: #fff; text-align: center; font-size: 4rem; line-height: 300px ">{!! $products->name !!}</h2>
        </div>
      </div>
    </div>
  </section>
  <!-- / catg header banner section -->
  <!-- product category -->
<section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        <div class="aa-product-details-area">
        <div class="aa-product-details-content">
          <div class="row">
          <!-- Modal view slider -->
          <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="aa-product-view-slider">
            <a href="{!! asset('images/products/'.$products->image) !!}" class="MagicZoom" id="jeans" data-options="selectorTrigger: hover; transitionEffect: false;">
            <img src="{!! asset('images/products/'.$products->image) !!}" style="width: 250px; height: 300px;"></a> 
             <!-- @foreach ($hinhsanpham as $hinh)
                <a data-zoom-id="jeans" href="{!! asset('images/chitietsanpham/'.$hinh->hinhname) !!}" data-image="{!! asset('resources/upload/chitietsanpham/'.$hinh->hinhname) !!}">
                <img src="{!! asset('images/chitietsanpham/'.$hinh->hinhname) !!}" style="width: 45px; height: 55px;">
                </a>
              @endforeach                               -->
          </div>
          </div>
          <!-- Modal view content -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="aa-product-view-content">
            <h1>{!! $products->name !!}</h1>
            <div class="aa-price-block">
              <h3>
              Giá: 
              <span class="aa-product-view-price">{!! number_format("$products->sale_price",0,",",".") !!}vnđ</span>
              <p class="aa-product-avilability">Đơn vị tính: <span>{!! $products->donvitinh_ten !!}</span></p>
              </h3>
            </div>
            
            <div class="aa-prod-quantity">
              <p class="aa-prod-category">
              Loại sản phẩm: <a href="{!! url('loai-san-pham',$category->slug) !!}">{!! $products->loainame !!}</a>
              </p>
            </div>
            <div class="aa-prod-view-bottom">
              <a class="aa-add-to-cart-btn" href="{!! url('mua-hang',[$products->id,$products->slug]) !!}"><span class="fa fa-shopping-cart">Mua hàng</a>
            </div>
            </div>
          </div>
          
        </div>
        <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Mô tả sản phẩm</a></li>
                <li><a href="#review" data-toggle="tab">Nhận xét</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p>{!! $products->description !!}</p>
                  
                </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4> Nhận xét</h4> 
                   <ul class="aa-review-nav">
                    @if ($comment != null)
                      @foreach ($comment as $item)
                        <li>
                          <div class="media">
                            <div class="media-left">
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><strong>{!! $item->name !!}</strong> - <span>{!! date("d-m-Y",strtotime($item->created_at)) !!}</span></h4>
                              ************************************
                              <p>{!! $item->content !!}</p>
                            </div>
                          </div>
                        </li>
                      @endforeach
                    @endif
                   </ul>


                   <h4>Thêm bình luận</h4>

                   <!-- review form -->
                   <form action="{!! url('binh-luan') !!}"  class="aa-review-form" method="POST">
                   <p class="comment-notes">
                        Địa chỉ mail của các bạn sẽ không hiện lên và nội dung bình luận sẽ được kiểm tra trước khi phát hành <span class="required">*</span>
                      </p>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    <input type="hidden" name="txtID" value="{!! $products->id !!}" />
                      <div class="form-group">
                        <label for="message">Nội dung<span class="required">*</span></label>
                        <textarea class="form-control" name="txtContent" rows="3" id="message" required="required"></textarea>
                        <div>
                            {!! $errors->first('txtContent') !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name">Tên<span class="required">*</span></label>
                        <input type="text" class="form-control" name="txtName"  id="name" required="required" placeholder="Name" />
                        <div>
                            {!! $errors->first('txtName') !!}
                        </div>
                      </div>  
                      <div class="form-group">
                        <label for="email">Email<span class="required">*</span></label>
                        <input type="email" class="form-control"  name="txtEmail" id="email" placeholder="example@gmail.com" required="required" />
                        <div>
                            {!! $errors->first('txtEmail') !!}
                        </div>
                      </div>
                      <button type="submit" class="btn btn-default aa-review-submit">Gửi</button>
                   </form>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <!-- <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                                                                                  
              </ul>
            </div> -->
          </div>
         </div>   
    </div>
        </div>
        </div>
  </section>
  <!-- / product category -->
  <!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@stop