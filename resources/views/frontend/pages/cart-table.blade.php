<div class="cart-view-table">
    <form action="">
        <div class="table-responsive">
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>

                <tbody>
                    <form action="" method="POST" accept-charset="utf-8">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        @foreach ($content as $item)
                        <?php 
                            $product = DB::table('products')->where('id',$item->id)->first();
                        ?>
                        <tr>
                            <td><a class="remove" href='{!! URL::route("xoasanpham", ["id" => $item["rowid"]] ) !!}'>
                                    <fa class="fa fa-close"></fa>
                                </a></td>
                            <td><a href="{!! url('san-pham',$product->slug) !!}"><img
                                        src="{!! asset('images/products/'.$product->image) !!}"
                                        style="width: 45px; height: 50px;"></a></td>
                            <td><a class="aa-cart-title" href="{!! url('san-pham',$product->slug) !!}">{!! $item->name
                                    !!} </a></td>
                            <td>{!! number_format("$item->price",0,",",".") !!}vnđ</td>
                            <td>
                                <!-- <a class="update-cart" row-id="{!! $item['rowid'] !!}" id="{!! $item->id !!}" href='#'>
                                    <fa class=" fa fa-edit"></fa> Cập nhật
                                </a> -->
                                <input class="qty aa-cart-quantity" row-id="{!! $item['rowid'] !!}" id="{!! $item->id !!}" type="number" value="{!! $item->qty !!}">
                            </td>
                            <td>{!! number_format($item->price*$item->qty,0,",",".") !!}vnđ</td>
                        </tr>
                        @endforeach
                    </form>
                </tbody>

            </table>
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

@section('my_javascript')
<script type="text/javascript">
$(function() {
    // $(document).on("click", '.update-cart', function(e) {
    $(document).on("blur", '.qty', function(e) {
        console.log("ok")
        var rowId = $(this).attr('row-id');
        var id = $(this).attr('id');
        var qty = $(this).val();

        $.ajax({
            url: '/cap-nhat-so-luong-san-pham/' + id,
            type: 'GET',
            data: {
                rowid: rowId,
                qty: qty,
            }, // dữ liệu truyền sang nếu có
            dataType: "HTML", // kiểu dữ liệu trả về
            success: function(response) {
                if (response != false) {
                    console.log(response)
                    $('#cart-view-render').html(response);
                }
            },
            error: function(e) {
                console.log(e.message);
            }
        });
    });
})
</script>
@endsection