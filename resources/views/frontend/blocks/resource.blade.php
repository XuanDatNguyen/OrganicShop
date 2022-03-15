<div class="aa-sidebar-widget">
            <h3>Nguyên liệu có sẵn tại cửa hàng</h3>
            <div class="aa-recently-views">
            <ul>
              @foreach ($resource as $item)
                <?php $product = DB::table('products')->where('products.id',$item->product_id)->join('consignments', 'products.id', '=', 'consignments.product_id')->join('units','products.unit_id', '=', 'units.id' )->join('categories','products.category_id' , '=', 'categories.id')->select('products.*', 'consignments.*','units.name as unit','categories.name')->first(); ?>
                <li>
                <a href="{!! url('san-pham',$product->slug) !!}" class="aa-cartbox-img"><img src="{!! asset('images/products/'.$product->image) !!}"  style="width: 100px; height: 100px;"></a>
                <div class="aa-cartbox-info">
                  <h4><a href="{!! url('san-pham',$product->slug) !!}">{!! $product->name !!}</a></h4>
                  <p>{!! number_format("$product->sale_price",0,",",".") !!} vnđ/{!! $product->unit !!}</p>
                </div>                
                </li>
              @endforeach                                     
            </ul>
            </div>                            
          </div>