@extends('backend.master')
@section('title')
    <h3 class="page-header ">
        Loại sản phẩm /
        <a href="{!! URL::route('admin.category.getAdd') !!}" class="btn btn-success" style="margin-top:-8px;">Thêm mới</a>
    </h3>
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    <b><i>Danh sách loại sản phẩm</i></b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>ID</th>
                <th>Loại sản phẩm</th>
                <th>Nhóm</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($data as $item)
            <tr class="odd gradeX">
                <td>{!! $item->id !!}</td>
                <td>{!! $item->name !!}</td>
                <td>
                    <?php $group = DB::table('groups')->where('id',$item->group_id)->first(); ?>
                    @if (!empty($group->name))
                        {!! $group->name !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
                <td class="center">
                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.category.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                    <a href="{!! URL::route('admin.category.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
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
