@extends('backend.master')
@section('title')
<h3 class="page-header ">
    <a href="{!! URL::route('admin.statistic.index') !!}" style="color:green;"><i class="fa fa-product-hunt" style="color:green;">Kho hàng</i></a>
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
                <th>Nhập vào</th>
                <th>Đã bán</th>
                <th>Hiện tại</th>
                <th>Nhập hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr class="odd gradeX" align="left">
            <?php  
                $product = DB::table('products')->where('id',$item->product_id)->first();
            ?>
                <td>{!! $product->name !!}</td>
                <td>
                    <?php $category = DB::table('categories')->where('id',$product->category_id)->first(); ?>
                    @if (!empty($category->name))
                        {!! $category->name !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>
                    <?php $unit = DB::table('units')->where('id',$product->unit_id)->first(); ?>
                    @if (!empty($unit->name))
                        {!! $unit->name !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td>{!! $item->nhap !!}</td>
                <td>{!! $item->ban !!}</td>
                <td>{!! $item->ton !!}</td>
                <td class="center">
                <a href="{!! URL::route('admin.consignment.getNhaphang', [$item->product_id] ) !!}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <!-- /.row -->
</div>
</div>

@stop
