@extends('backend.master')
@section('title')
        <h3 class="page-header ">
        Sản phẩm / 
            <a href="{!! URL::route('admin.product.getAdd') !!}"  style="margin-top:-8px;" class="btn btn-success">Thêm mới</a>
        </h3>
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    <b><i>Danh sách sản phẩm</i></b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>Đơn vị</th>
                <th>Chức năng</th>
                <th>Nhập hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr class="odd gradeX" align="left">

                <td>
                <img src="{!! asset('images/products/'.$item->image) !!}" class="img-responsive img-rounded" alt="Image" style="width: 70px; height: 40px;">
                </td>
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
                <td class="center">
                    <a href="{!! URL::route('admin.product.getDelete', $item->id ) !!}" onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                    <a href="{!! URL::route('admin.product.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                </td>
                <td class="center">
                    <a href="{!! URL::route('admin.consignment.getNhaphang', [$item->id] ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
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



