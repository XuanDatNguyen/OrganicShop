@extends('backend.master')
@section('title')
<h3 class="page-header ">
    <a href="{!! URL::route('admin.statistic.index') !!}" style="color:blue;"><i class="fa fa-product-hunt" style="color:green;">Kho hàng</i></a>
    /{{ $title}}
    </h3>
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    Danh sách sản phẩm
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>Tên</th>
                <th>Loại</th>
                <th>ĐVT</th>
                <th>Giá mua vào</th>
                <th>Giá bán ra</th>
                <th>Nhập vào</th>
                <th>Đã bán</th>
                <th>Hiện tại</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr class="odd gradeX" align="left">
                <td>{!! $item->name !!}</td>
                <td>
                    <?php $category = DB::table('categories')->where('id',$item->category_id)->first(); ?>
                    @if (!empty($category->name))
                        {!! $category->name !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>
                    <?php $unit = DB::table('units')->where('id',$item->unit_id)->first(); ?>
                    @if (!empty($unit->name))
                        {!! $unit->name !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>{!! $item->purchase_price !!}</td>
                <td>{!! $item->sale_price !!}</td>
                <td>{!! $item->qty !!}</td>
                <td>{!! $item->sold_qty !!}</td>
                <td>{!! $item->current_qty !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <!-- /.row -->
</div>
</div>

@stop
