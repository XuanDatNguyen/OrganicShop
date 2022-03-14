@extends('backend.master')
@section('title')
    <h3 class="page-header ">
        Khuyến mãi / 
        <a href="{!! URL::route('admin.promotion.getAdd') !!}" class="btn btn-success" style="margin-top:-8px;" >Thêm mới</a>
    </h3>
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    <b><i>Danh sách tin khuyến mãi</i></b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>Status</th>
                <th>ID</th>
                <th>Chủ đề</th>
                <th>Tỷ lệ</th>
                <th>Thời gian (ngày)</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
           <tr class="odd gradeX">
                <td>
                    <?php 
                        if ( $item->status == 1 )
                        {
                            print_r('Còn KM');
                        } else{
                            print_r('Hết KM');
                        }   
                     ?> 
                </td>
                <td>{!! $item->id !!}</td>
                <td>{!! $item->title !!}</td>
                <td>{!! $item->percent !!}%</td>
                <td>{!! $item->estimate !!}</td>
                <td>
                    <a href="{!! URL::route('admin.promotion.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.promotion.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                </td>

            </tr>

           @endforeach
        </tbody>
    </table>
</div>
    <!-- /.row -->

@stop
