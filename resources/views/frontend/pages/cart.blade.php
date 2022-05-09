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
            <div class="cart-view-area">
                <div class="cart-view-table">
                    <form action="">
                        <div class="table-responsive" id="my-cart">

                           @include('frontend.pages.cart-table')
                        </div>
                    </form>
                    <!-- Cart Total view -->
                    <div class="cart-view-total">
                        <!-- <h4>Tổng tiền</h4> -->
                        <table class="aa-totals-table">
                            <tbody>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <td> {!! number_format("$total",0,",",".") !!}vnđ</td>
                                </tr>
                            </tbody>
                        </table>
                        @if (Auth::check())
                        <a href="{!! url('/') !!}" class="aa-cart-view-btn"> Mua tiếp</a>
                        <a href="{!! URL::route('getThanhtoan') !!}" class="aa-cart-view-btn">Thanh Toán</a>

                        @else
                        <a href="{!! url('/') !!}" class="aa-cart-view-btn">Mua tiếp</a>
                        <a href="{!! url('login') !!}" class="aa-cart-view-btn">Thanh Toán</a>
                        @endif

                    </div>
                </div>
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
