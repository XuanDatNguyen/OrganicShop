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
            {!! $item !!}
            <tr>
                <td><a class="remove" href='{!! URL::route("xoasanpham", ["id" => $item["rowid"]] ) !!}'>
                        <fa class="fa fa-close"></fa>
                    </a></td>
                <td><a href="{!! url('san-pham',$product->slug) !!}"><img
                            src="{!! asset('images/products/'.$product->image) !!}"
                            style="width: 45px; height: 50px;"></a></td>
                <td><a class="aa-cart-title" href="{!! url('san-pham',$product->slug) !!}">{!! $item->name
                        !!}</a></td>
                <td>{!! number_format("$item->price",0,",",".") !!}vnđ</td>
                <td>
                    <a class="update-cart" data-id="{!! $item['rowid'] !!}" href='#'>
                        <fa class=" fa fa-edit"></fa> Cập nhật
                    </a>
                    <input class="qty aa-cart-quantity" type="number" value="{!! $item->qty !!}">
                </td>
                <td>{!! number_format($item->price*$item->qty,0,",",".") !!}vnđ</td>
            </tr>
            @endforeach
        </form>
    </tbody>

</table>

@section('my_javascript')
<script type="text/javascript">
$(function() {
    // cập nhật số lượng của từng sản phẩm trong giỏ hàng
    $(document).on("click", '.update-cart', function(e) {
        var rowId = $(this).attr('data-id');
        var qty = $(this).next().val();
        // console.log(qty)


        $.ajax({
            url: '/cap-nhat-so-luong-san-pham',
            type: 'GET',
            data: {
                rowid: rowId,
                qty: qty
            }, // dữ liệu truyền sang nếu có
            dataType: "HTML", // kiểu dữ liệu trả về
            success: function(response) {
                if (response != false) {
                    console.log(response)
                    $('#my-cart').html(response);
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