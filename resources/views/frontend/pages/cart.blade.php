@extends('frontend.master')
@section('content')
<!-- catg header banner section -->
<section id="aa-catg-head-banner">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
                <h2>Giỏ hàng</h2>
            </div>
        </div>
    </div>
</section>

@include('frontend.blocks.trans')

<!-- / product category -->

<!-- Support section -->
<!-- / Support section -->

<!-- Cart view section -->
<section id="cart-view">
    <div class="container">
        <div class="col-md-12">
            <div class="cart-view-area" id="cart-view-render">
                @include('frontend.pages.cart-table')
            </div>
        </div>
    </div>
    </div>
</section>
<!-- / Cart view section -->


<!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@endsection