<div class="aa-sidebar-widget">
    <h3>Sản phẩm bán chạy</h3>
    <div class="aa-recently-views">
        <ul>
            <?php
              $product = DB::table('products')
                ->join('consignments', 'products.id', '=', 'consignments.product_id')
                ->join('order_details', 'products.id', '=', 'order_details.product_id')
                // ->join('orders', 'orders.id', '=', 'order_details.product_id')
                ->select(DB::raw('sum(consignments.sold_qty) as daban'),'products.id','products.name','products.slug','products.is_promotion','products.image', 'consignments.qty','consignments.current_qty','consignments.sale_price')
              ->groupBy('products.id')
              ->orderBy('daban','desc')
              ->take(4)
              ->get(); 
            ?>
            @foreach ($product as $item)
            <li>
                <a href="{!! url('san-pham',$item->slug) !!}" class="aa-cartbox-img"><img alt="img"
                        src="{!! asset('images/products/'.$item->image) !!}"></a>
                <div class="aa-cartbox-info">
                    <h3 style="font: 20px arial, sans-serif;"><a href="{!! url('san-pham',$item->slug) !!}">{!!
                            $item->name !!}</a></h3>
                    <p style="color:rgb(230, 0, 0); font:20px arial;">{!! number_format("$item->sale_price",0,",",".")
                        !!} vnđ</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>